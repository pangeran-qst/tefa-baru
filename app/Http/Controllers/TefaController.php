<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tefa;
use App\Models\Pesanan;
use App\Models\Portofolio;
use Illuminate\Http\Request;

class TefaController extends Controller
{
   public function katalog()
    {
        $tefas = Tefa::where('status_aktif', true)->get();

        return view('public.katalog.index', compact('tefas'));
    }

    public function semua()
    {
        $tefas = Tefa::where('status_aktif', true)
            ->orderBy('id_produk', 'asc')
            ->paginate(12); 

        return view('public.katalog.jurusan.semua', compact('tefas'));
    }

    public function tkj()
    {
        $tefas = Tefa::where('jurusan', 'TKJ') ->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.tkj', compact('tefas'));
    }

    public function gim()
    {
        $tefas = Tefa::where('jurusan', 'GIM') ->where('status_aktif', true) ->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.gim', compact('tefas'));
    }

    public function animasi()
    {
        $tefas = Tefa::where('jurusan', 'ANIMASI') ->where('status_aktif', true) ->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.animasi', compact('tefas'));
    }

    public function rpl()
    {
        $tefas = Tefa::where('jurusan', 'RPL') ->where('status_aktif', true) ->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.rpl', compact('tefas'));
    }

    public function dkv()
    {
        $tefas = Tefa::where('jurusan', 'DKV') ->where('status_aktif', true) ->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.dkv', compact('tefas'));
    }

    public function pspt()
    {
        $tefas = Tefa::where('jurusan', 'PSPT') ->where('status_aktif', true) ->orderBy('id_produk', 'asc')->paginate(12);

        return view('public.katalog.jurusan.pspt', compact('tefas'));
    }

    public function detail($id_produk)
    {
        $tefa = Tefa::where('id_produk', $id_produk)
            ->where('status_aktif', true)
            ->firstOrFail();

        return view('public.katalog.jurusan.detail-produk', compact('tefa'));
    }

    public function storePesanan(Request $request)
    {
        $request->validate([
            'id_produk' => 'required|exists:tefas,id_produk',
            'nama_pemesan' => 'required|string|max:255',
            'email_pemesan' => 'required|email|max:255',
            'no_hp_pemesan' => 'required|string|max:30',
            'catatan_pesanan' => 'nullable|string',
        ]);

        $tefa = Tefa::findOrFail($request->id_produk);

        Pesanan::create([
           'id_user' => Auth::id(),
            'id_produk' => $tefa->id_produk,
            'id_user_worker' => null,
            'tanggal_pesan' => now(),
            'nama_pemesan' => $request->nama_pemesan,
            'email_pemesan' => $request->email_pemesan,
            'no_hp_pemesan' => $request->no_hp_pemesan,
            'catatan_pesanan' => $request->catatan_pesanan,
            'total_harga' => $tefa->harga,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil disimpan.',
        ]);
    }

    public function pesananSaya()
{
    $userId = Auth::id();

    $pesanans = Pesanan::with('tefa')
        ->where('id_user', $userId)
        ->latest('tanggal_pesan')
        ->get();

    $totalPesanan = $pesanans->count();

    $sedangDiproses = $pesanans
        ->where('status', 'in_progress')
        ->count();

    $pesananSelesai = $pesanans
        ->where('status', 'completed')
        ->count();

    return view('client.pesanan.index', compact(
        'pesanans',
        'totalPesanan',
        'sedangDiproses',
        'pesananSelesai'
    ));
}


    public function cekTicket(Request $request)
    {
        $pesanan = null;

        if ($request->filled('ticket')) {

            $ticket = strtoupper(trim($request->ticket));

            // Contoh: TF-0001
            $idPesanan = (int) str_replace('TF-', '', $ticket);

            $pesanan = Pesanan::with([
                'tefa',
                'riwayat'
            ])
                ->where('id_pesanan', $idPesanan)
                ->first();
        }

        return view('public.katalog.cek-ticket', compact('pesanan'));
    }

    // Halaman Katalog Utama Portofolio (Semua Jurusan)
    public function portofolio()
    {
        $tefas = Tefa::where('status_aktif', true)->get();

        return view('public.katalog.portofolio', compact('tefas'));
    }

    public function portofolioSemua()
    {
        // Ambil SEMUA karya tefa tanpa filter jurusan
        $tefas = Tefa::where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12); 

        return view('public.katalog.jurusanp.semua', compact('tefas'));
    }

    // Portofolio Per Jurusan
    public function portofolioTkj()
    {
        $tefas = Tefa::where('jurusan', 'TKJ') ->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.tkj', compact('tefas'));
    }

    public function portofolioGim()
    {
        $tefas = Tefa::where('jurusan', 'GIM')->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.gim', compact('tefas'));
    }

    public function portofolioAnimasi()
    {
        $tefas = Tefa::where('jurusan', 'ANIMASI')->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.animasi', compact('tefas'));
    }

    public function portofolioRpl()
    {
        $tefas = Tefa::where('jurusan', 'RPL')->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.rpl', compact('tefas'));
    }

    public function portofolioDkv()
    {
        $tefas = Tefa::where('jurusan', 'DKV')->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.dkv', compact('tefas'));
    }

    public function portofolioPspt()
    {
        $tefas = Tefa::where('jurusan', 'PSPT')->where('status_aktif', true)->orderBy('id_produk', 'asc')->paginate(12);
        return view('public.katalog.jurusanp.pspt', compact('tefas'));
    }

    public function portofolioProduk($id_produk)
    {
        // 1. Ambil produk TeFA berdasarkan 'id_produk' dan pastikan berstatus aktif
        $produk = Tefa::where('id_produk', $id_produk)
            ->where('status_aktif', true)
            ->firstOrFail();

        // 2. Ambil semua karya portofolio yang terikat dengan 'id_produk' tersebut
        $karyas = Portofolio::where('id_produk', $id_produk)
            ->where('status_aktif', true)
            ->orderBy('id_produk', 'asc')
            ->paginate(12);

        return view('public.katalog.jurusanp.karya', compact('produk', 'karyas'));
    }

    public function detailKarya($id_portofolio)
    {
        // Mengambil data portofolio berdasarkan 'id_portofolio' beserta relasi produk TeFA-nya
        $karya = Portofolio::with('tefa')
            ->where('id_portofolio', $id_portofolio)
            ->where('status_aktif', true)
            ->firstOrFail();

        return view('public.katalog.jurusanp.detail-karya', compact('karya'));
    }

}
