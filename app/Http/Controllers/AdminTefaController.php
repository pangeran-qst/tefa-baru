<?php

namespace App\Http\Controllers;

use App\Models\Tefa;
use App\Models\Jurusan;
use Illuminate\Http\Request;
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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


    public function pesanan()
    {
        $pesanans = \App\Models\Pesanan::with([
            'user',
            'tefa',
            'worker'
        ])
        ->latest('tanggal_pesan')
        ->get();

        return view(
            'admin.tefa.pesanan.index',
            compact('pesanans')
        );
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
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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
}