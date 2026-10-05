<?php

namespace App\Http\Controllers;

use App\Models\Tefa;
use App\Models\Jurusan;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminTefaController extends Controller
{
    public function dashboard()
    {
        return view('admin.tefa.dashboard');
    }


    public function produk()
    {
        $tefas = Tefa::all();
        $jurusans = Jurusan::all();

        return view(
            'admin.tefa.produk.index',
            compact('tefas', 'jurusans')
        );
    }


    public function createProduk()
    {
        return view('admin.tefa.produk.create');
    }


    // SIMPAN DATA PRODUK
    public function storeProduk(Request $request)
    {
        $request->validate([
            'jurusan' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'status_aktif' => 'required|boolean',
        ]);

        $data = [
            'jurusan' => $request->jurusan,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status_aktif' => $request->status_aktif,
        ];


        // SIMPAN GAMBAR KE public/gambar/tefa
        if ($request->hasFile('gambar')) {

            $gambar = $request->file('gambar');

            $namaGambar = time() . '_' . $gambar->getClientOriginalName();

            $folder = public_path('gambar/tefa');

            // Buat folder kalau belum ada
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $gambar->move($folder, $namaGambar);

            $data['gambar'] = $namaGambar;
        }


        Tefa::create($data);

        return redirect()
            ->route('admin.tefa.produk')
            ->with('success', 'Produk berhasil ditambahkan.');
    }


    // SIMPAN DATA JURUSAN
    public function storeJurusan(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:20|unique:jurusans,kode',
            'nama_jurusan' => 'required|string|max:255',
            'ketua_kajur' => 'required|string|max:255',
            'worker' => 'required|integer|min:0',
            'produk' => 'required|integer|min:0',
            'status' => 'required|boolean',
        ]);

        Jurusan::create([
            'kode' => $request->kode,
            'nama_jurusan' => $request->nama_jurusan,
            'ketua_kajur' => $request->ketua_kajur,
            'worker' => $request->worker,
            'produk' => $request->produk,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.tefa.produk')
            ->with('success', 'Jurusan berhasil ditambahkan.');
    }


    public function pesanan(Request $request)
    {
        $status = $request->query('status');

        $statusValid = [
            'pending',
            'diproses',
            'ditugaskan',
            'pengerjaan',
            'review',
            'selesai',
            'ditolak',
        ];

        $query = Pesanan::with('tefa')
            ->latest('tanggal_pesan');

        if ($status && in_array($status, $statusValid)) {
            $query->where('status', $status);
        }

        $pesanans = $query->get();

        // Jumlah masing-masing status
        $jumlahPending = Pesanan::where('status', 'pending')->count();

        $jumlahWaitingResponse = Pesanan::where(
            'status',
            'diproses'
        )->count();

        $jumlahInProgress = Pesanan::where(
            'status',
            'pengerjaan'
        )->count();

        $jumlahCompleted = Pesanan::where(
            'status',
            'selesai'
        )->count();

        $jumlahCancelled = Pesanan::where(
            'status',
            'ditolak'
        )->count();

        return view('admin.tefa.pesanan.index', compact(
            'pesanans',
            'status',
            'jumlahPending',
            'jumlahWaitingResponse',
            'jumlahInProgress',
            'jumlahCompleted',
            'jumlahCancelled'
        ));
    }


    public function detailPesanan($id_pesanan)
    {
        $pesanan = Pesanan::findOrFail($id_pesanan);
        
        // 2. Ambil data semua jurusan agar modal bisa nampil list dropdown jurusan
        $listJurusan = Jurusan::all(); 

        return view('admin.tefa.pesanan.detail', compact('pesanan', 'listJurusan'));
    }



    public function prosesPesanan(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);

        $pesanan->status = 'diproses';

        if ($request->filled('catatan')) {
            $pesanan->catatan_pesanan = $request->catatan;
        }

        $pesanan->save();

        return redirect()
            ->route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)
            ->with('success', 'Pesanan berhasil diteruskan ke Admin Jurusan!');
    }




    // HALAMAN EDIT PRODUK
    public function editProduk($id_produk)
    {
        $tefa = Tefa::findOrFail($id_produk);

        return view(
            'admin.tefa.produk.edit',
            compact('tefa')
        );
    }


    // UPDATE PRODUK
    public function updateProduk(Request $request, $id_produk)
    {
        $tefa = Tefa::findOrFail($id_produk);

        $request->validate([
            'jurusan' => 'required',
            'nama_produk' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,|max:2048',
            'status_aktif' => 'required|boolean',
        ]);

        $data = [
            'jurusan' => $request->jurusan,
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'status_aktif' => $request->status_aktif,
        ];


        // KALAU USER UPLOAD GAMBAR BARU
        if ($request->hasFile('gambar')) {

            // 1. HAPUS GAMBAR LAMA
            if ($tefa->gambar) {

                $gambarLama = public_path(
                    'gambar/tefa/' . $tefa->gambar
                );

                if (file_exists($gambarLama)) {
                    unlink($gambarLama);
                }
            }


            // 2. SIMPAN GAMBAR BARU
            $gambar = $request->file('gambar');

            $namaGambar = time() . '_' . $gambar->getClientOriginalName();

            $folder = public_path('gambar/tefa');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $gambar->move($folder, $namaGambar);

            $data['gambar'] = $namaGambar;
        }


        $tefa->update($data);

        return redirect()
            ->route('admin.tefa.produk')
            ->with('success', 'Produk berhasil diperbarui.');
    }


    



    //UNTUK MENCETAK PDF KATALOG OLEH ADMIN
    public function cetakKatalog()
    {
        $tefas = Tefa::where('status_aktif', true)->get();

        return Pdf::loadView('pdf.katalog-tefa', compact('tefas'))
            ->setPaper('a4', 'portrait')
            ->stream('katalog-tefa.pdf');
    }


    // HAPUS PRODUK
    public function destroyProduk($id_produk)
    {
        $tefa = Tefa::findOrFail($id_produk);


        // HAPUS GAMBAR DARI FOLDER
        if ($tefa->gambar) {

            $path = public_path(
                'gambar/tefa/' . $tefa->gambar
            );

            if (file_exists($path)) {
                unlink($path);
            }
        }


        // HAPUS DATA DARI DATABASE
        $tefa->delete();

        return redirect()
            ->route('admin.tefa.produk')
            ->with('success', 'Produk berhasil dihapus.');
    }

    // HALAMAN MANAJEMEN PENGGUNA
    public function pengguna(Request $request)
    {
        $role = $request->query('role');

        $query = User::whereIn('role', [
            'admin_tefa',
            'admin_jurusan',
            'worker',
        ]);

        if ($role && in_array($role, [
            'admin_tefa',
            'admin_jurusan',
            'worker',
        ])) {
            $query->where('role', $role);
        }

        $users = $query
            ->orderBy('nama')
            ->get();

        return view('admin.tefa.pengguna.index', compact(
            'users',
            'role'
        ));
    }

    // SIMPAN AKUN PENGGUNA
    public function storePengguna(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:5',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'role' => 'required|in:admin_jurusan,worker',
            'jurusan' => 'required|string|max:100',
            'kelas' => 'required|string|max:100',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
        ]);

        return redirect()
            ->route('admin.tefa.pengguna')
            ->with('success', 'Akun berhasil ditambahkan.');
    }

    public function editPengguna($id)
    {
        $user = User::findOrFail($id);

        return view('admin.tefa.pengguna.edit', compact('user'));
    }

    public function updatePengguna(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id_user . ',id_user',
            'no_hp' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'role' => 'required|in:admin_jurusan,worker',
            'jurusan' => 'required|string|max:100',
            'kelas' => 'required|string|max:100',
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'role' => $request->role,
            'jurusan' => $request->jurusan,
            'kelas' => $request->kelas,
        ]);

        return redirect()
            ->route('admin.tefa.pengguna')
            ->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroyPengguna($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()
            ->route('admin.tefa.pengguna')
            ->with('success', 'Akun pengguna berhasil dihapus.');
    }
}