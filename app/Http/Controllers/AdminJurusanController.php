<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
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

        $workerQuery = User::where('role', 'worker');

        if ($jurusanUser) {
            $workerQuery->where('jurusan', $jurusanUser);
        }

        $workers = $workerQuery->get();


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
}