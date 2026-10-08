<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TransaksiJurusanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class AdminJurusanController extends Controller
{
    /**
     * Dashboard Pesanan Admin Jurusan
     */
    public function index()
    {
        // ==========================================
        // 1. Ambil admin jurusan yang sedang login
        // ==========================================

        $userLogin = Auth::user();

        // Contoh: RPL, TKJ, DKV, GIM, PSPT, ANIMASI
        $jurusanUser = $userLogin->jurusan;


        // ==========================================
        // 2. Query dasar pesanan sesuai jurusan
        // ==========================================

        $baseQuery = Pesanan::with(['tefa', 'worker', 'user'])
            ->whereHas('tefa', function ($q) use ($jurusanUser) {

                if ($jurusanUser) {
                    $q->where('jurusan', $jurusanUser);
                }

            });


        // ==========================================
        // 3. PESANAN MASUK
        // Status: diproses
        // ==========================================

        $pesananMasuk = (clone $baseQuery)
            ->where('status', 'diproses')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // 4. DALAM PENGERJAAN
        // Status: pengerjaan
        // ==========================================

        $dalamPengerjaan = (clone $baseQuery)
            ->with('progress')
            ->where('status', 'pengerjaan')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // 5. PENINJAUAN & QC
        // Status: review
        // ==========================================

        $peninjauanQC = (clone $baseQuery)
            ->where('status', 'review')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // 6. PESANAN SELESAI
        // Status: selesai
        // ==========================================

        $pesananSelesai = (clone $baseQuery)
            ->where('status', 'selesai')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // 7. AMBIL DATA WORKER / SISWA
        // Sesuai jurusan admin yang login 
        // ==========================================

        $workerQuery = User::where('role', 'worker')
            ->withCount([
                'pesananSebagaiWorker as project_aktif' => function ($query) {
                    $query->whereIn('status', [
                        'ditugaskan',
                        'pengerjaan',
                        'review',
                    ]);
                },
                'pesananSebagaiWorker as project_selesai' => function ($query) {
                    $query->where('status', 'selesai');
                },
            ]);

        if ($jurusanUser) {
            $workerQuery->where('jurusan', $jurusanUser);
        }

        $workers = $workerQuery
            ->orderBy('nama')
            ->get();


        // ==========================================
        // 8. Kirim data ke Blade
        // ==========================================

        return view('admin.jurusan.pesanan.index', compact(
            'pesananMasuk',
            'dalamPengerjaan',
            'peninjauanQC',
            'pesananSelesai',
            'workers'
        ));
    }


    /**
     * Update status pesanan
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,pengerjaan,review,selesai,ditolak',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()
            ->back()
            ->with('success', 'Status pesanan berhasil diperbarui!');
    }


    /**
     * Assign pesanan ke Worker
     */
    public function assignWorker(Request $request, $id)
    {
        $request->validate([
            'id_user_worker' => 'required|integer|exists:users,id_user',
            'catatan_worker' => 'nullable|string',
        ]);


        // Ambil pesanan
        $pesanan = Pesanan::findOrFail($id);


        // ==========================================
        // Simpan worker yang ditugaskan
        // ==========================================

        $pesanan->id_user_worker = $request->id_user_worker;


        // Setelah ditugaskan → status pengerjaan
        $pesanan->status = 'ditugaskan';


        // ==========================================
        // Simpan catatan worker jika ada
        // ==========================================

        if ($request->filled('catatan_worker')) {
            $pesanan->catatan_pesanan = $request->catatan_worker;
        }


        $pesanan->save();


        return redirect()
            ->back()
            ->with('success', 'Pesanan berhasil ditugaskan ke Worker!');
    }


    public function detailPesanan($id_pesanan)
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $pesanan = Pesanan::with([
            'tefa',
            'worker',
            'user',
            'progress'
        ])
        ->where('id_pesanan', $id_pesanan)
        ->whereHas('tefa', function ($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        })
        ->firstOrFail();

        $workers = User::where('role', 'worker')
            ->where('jurusan', $jurusanUser)
            ->orderBy('nama')
            ->get();

        return view('admin.jurusan.pesanan.detail', compact(
            'pesanan',
            'workers'
        ));
    }


    public function updatePembayaran(Request $request, $id_pesanan)
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $pesanan = Pesanan::where('id_pesanan', $id_pesanan)
            ->whereHas('tefa', function ($q) use ($jurusanUser) {
                if ($jurusanUser) {
                    $q->where('jurusan', $jurusanUser);
                }
            })
            ->firstOrFail();

        $request->validate([
            'harga_final' => 'required|integer|min:0',
            'pembayaran_sekarang' => 'required|integer|min:0',
            'metode_pembayaran' => 'nullable|string|max:100',
            'tanggal_pembayaran' => 'nullable|date',
            'catatan_pembayaran' => 'nullable|string',
        ]);

        $hargaFinal = (int) $request->harga_final;

        $sudahDibayar = (int) ($pesanan->nominal_dibayar ?? 0);

        $pembayaranSekarang = (int) $request->pembayaran_sekarang;

        // Pastikan harga kesepakatan tidak lebih kecil
        // dari jumlah yang sudah pernah dibayar.
        if ($hargaFinal < $sudahDibayar) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'harga_final' => 'Harga kesepakatan tidak boleh lebih kecil dari jumlah yang sudah dibayar.'
                ]);
        }

        $sisaPembayaran = $hargaFinal - $sudahDibayar;

        // Pembayaran baru tidak boleh melebihi sisa pembayaran.
        if ($pembayaranSekarang > $sisaPembayaran) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'pembayaran_sekarang' => 'Pembayaran sekarang tidak boleh melebihi sisa pembayaran.'
                ]);
        }

        // Tambahkan pembayaran sekarang ke total pembayaran sebelumnya.
        $totalDibayar = $sudahDibayar + $pembayaranSekarang;

        // Tentukan status berdasarkan total pembayaran.
        if ($totalDibayar === 0) {
            $statusPembayaran = 'belum_bayar';
        } elseif ($totalDibayar < $hargaFinal) {
            $statusPembayaran = 'dp';
        } else {
            $statusPembayaran = 'lunas';
        }

        $pesanan->update([
            'harga_final' => $hargaFinal,
            'nominal_dibayar' => $totalDibayar,
            'status_pembayaran' => $statusPembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'tanggal_pembayaran' => $request->tanggal_pembayaran,
            'catatan_pembayaran' => $request->catatan_pembayaran,
        ]);

        return redirect()
            ->route(
                'admin.jurusan.pesanan.detail',
                $pesanan->id_pesanan
            )
            ->with('success', 'Pembayaran berhasil diperbarui.');
    }


    public function pengguna()
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $workerQuery = User::where('role', 'worker')
            ->withCount([
                'pesananSebagaiWorker as project_aktif' => function ($query) {
                    $query->whereIn('status', [
                        'ditugaskan',
                        'pengerjaan',
                        'review',
                    ]);
                },

                'pesananSebagaiWorker as project_selesai' => function ($query) {
                    $query->where('status', 'selesai');
                },
            ]);

        if ($jurusanUser) {
            $workerQuery->where('jurusan', $jurusanUser);
        }

        $workers = $workerQuery
            ->orderBy('nama')
            ->get();

        // Statistik Worker
        $totalWorker = $workers->count();

        $workerBusy = $workers->where('project_aktif', '>', 0)->count();

        $workerAvailable = $workers->where('project_aktif', 0)->count();

        return view('admin.jurusan.pengguna.index', compact(
            'workers',
            'totalWorker',
            'workerAvailable',
            'workerBusy'
        ));
    }

    public function transaksi()
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $transaksi = Pesanan::with([
            'tefa',
            'user',
            'worker',
        ])
        ->whereHas('tefa', function ($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        })
        ->latest('tanggal_pesan')
        ->get();

        $totalTransaksi = $transaksi->sum('harga_final');

        $transaksiLunas = $transaksi
            ->where('status_pembayaran', 'lunas')
            ->count();

        $pendingPelunasan = $transaksi
            ->whereIn('status_pembayaran', ['belum_bayar', 'dp'])
            ->count();

        $omset = $transaksi->sum('nominal_dibayar');

        return view('admin.jurusan.transaksi.index', compact(
            'transaksi',
            'totalTransaksi',
            'transaksiLunas',
            'pendingPelunasan',
            'omset'
        ));
    }

    // UNTUK MENCETAK PDF TRANSAKSI OLEH ADMIN JURUSAN
    public function transaksiPdf()
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $transaksi = Pesanan::with([
            'tefa',
            'user',
            'worker',
        ])
        ->whereHas('tefa', function ($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        })
        ->latest('tanggal_pesan')
        ->get();

        $totalTransaksi = $transaksi->sum('harga_final');
        $omset = $transaksi->sum('nominal_dibayar');

        return Pdf::loadView(
            'pdf.transaksi-jurusan',
            compact(
                'transaksi',
                'jurusanUser',
                'totalTransaksi',
                'omset'
            )
        )
        ->setPaper('a4', 'landscape')
        ->stream('transaksi-' . strtolower($jurusanUser) . '.pdf');
    }

    public function transaksiPdfSatuan($id_pesanan)
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $pesanan = Pesanan::with([
            'tefa',
            'user',
            'worker',
        ])
        ->where('id_pesanan', $id_pesanan)
        ->whereHas('tefa', function ($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        })
        ->firstOrFail();

        return Pdf::loadView(
            'pdf.transaksi-jurusan',
            [
                'transaksi' => collect([$pesanan]),
                'jurusanUser' => $jurusanUser,
                'totalTransaksi' => $pesanan->harga_final ?? 0,
                'omset' => $pesanan->nominal_dibayar ?? 0,
            ]
        )
        ->setPaper('a4', 'landscape')
        ->stream(
            'transaksi-' . $pesanan->id_pesanan . '.pdf'
        );
    }

    public function transaksiExcel()
    {
        $userLogin = Auth::user();
        $jurusanUser = $userLogin->jurusan;

        $transaksi = Pesanan::with([
            'tefa',
            'user',
            'worker',
        ])
        ->whereHas('tefa', function ($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        })
        ->latest('tanggal_pesan')
        ->get();

        return Excel::download(
            new TransaksiJurusanExport($transaksi),
            'transaksi-' . strtolower($jurusanUser) . '.xlsx'
        );
    }
}