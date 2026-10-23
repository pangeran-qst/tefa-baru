<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Tefa;
use App\Models\Pesanan;
use App\Models\Portofolio;
use App\Models\User;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class TefaController extends Controller
{

public function index()
{
    $tefas = Tefa::where('status_aktif', true)->get();

    // Statistik beranda
    $proyekSelesai = Pesanan::where('status', 'selesai')->count();

    $jurusanAktif = Jurusan::where('status', true)->count();

    $jumlahPekerja = User::where('role', 'worker')->count();

    return view('welcome', compact(
        'tefas',
        'proyekSelesai',
        'jurusanAktif',
        'jumlahPekerja'
    ));
}

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


public function ajukanPembatalan(Request $request, $id)
{
    $request->validate([
        'alasan_pembatalan' => 'required|string|max:1000',
    ]);

    $pesanan = Pesanan::where('id_pesanan', $id)
        ->where('id_user', Auth::id())
        ->firstOrFail();

    if (in_array($pesanan->status, [
        'selesai', 'ditolak', 'cancelled', 'completed'
    ])) {
        return back()->with('error', 'Pesanan ini tidak bisa dibatalkan.');
    }

    if ($pesanan->status_pembatalan !== 'tidak_ada') {
        return back()->with('error', 'Pengajuan pembatalan sudah pernah dilakukan.');
    }

    if (in_array($pesanan->status, [
        'pending', 'diproses', 'ditugaskan'
    ])) {
        $pesanan->status_sebelum_pembatalan = $pesanan->status;
        $pesanan->status = 'cancelled';
        $pesanan->status_pembatalan = 'disetujui';
        $pesanan->tanggal_dibatalkan = now();
        $pesanan->dibatalkan_oleh = Auth::id();
        $pesanan->alasan_pembatalan = $request->alasan_pembatalan;
        $pesanan->save();

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    if (in_array($pesanan->status, [
        'pengerjaan', 'review', 'in_progress'
    ])) {
        $pesanan->status_sebelum_pembatalan = $pesanan->status;
        $pesanan->status_pembatalan = 'diajukan';
        $pesanan->alasan_pembatalan = $request->alasan_pembatalan;
        $pesanan->save();

        return back()->with(
            'success',
            'Permintaan pembatalan diajukan dan menunggu keputusan admin.'
        );
    }

    return back()->with(
        'error',
        'Status pesanan belum mendukung pembatalan.'
    );
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
            'riwayat',
            'progress'
                ])
            ->where('id_pesanan', $idPesanan)
            ->first();

        if ($pesanan) {

            // Riwayat dari tabel riwayat_pesanans
            $riwayat = $pesanan->riwayat->map(function ($item) {
                return (object) [
                    'status' => $item->status,
                    'tanggal_tracking' => $item->tanggal_tracking,
                    'keterangan' => $item->keterangan,
                    'lokasi' => $item->lokasi,
                ];
            });

            // Progress dari worker
            $progress = $pesanan->progress->map(function ($item) {
                return (object) [
                    'status' => $item->tahap,
                    'tanggal_tracking' => $item->tanggal_progress,
                    'keterangan' => $item->catatan,
                    'lokasi' => null,
                ];
            });

            // Gabungkan riwayat + progress
            $pesanan->timeline = $riwayat
                ->concat($progress)
                ->sortBy('tanggal_tracking')
                ->values();
        }
    }

    return view('public.katalog.cek-ticket', compact('pesanan'));
}

    
    // Halaman utama Portofolio
    public function portofolio()
    {
        return view('public.katalog.portofolio');
    }

    // Portofolio Semua Jurusan
    public function portofolioSemua()
    {
        $karyas = Portofolio::where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.semua', compact('karyas'));
    }

    // Portofolio TKJ
    public function portofolioTkj()
    {
        $karyas = Portofolio::where('jurusan', 'TKJ')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.tkj', compact('karyas'));
    }

    // Portofolio GIM
    public function portofolioGim()
    {
        $karyas = Portofolio::where('jurusan', 'GIM')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.gim', compact('karyas'));
    }

    // Portofolio ANIMASI
    public function portofolioAnimasi()
    {
        $karyas = Portofolio::where('jurusan', 'ANIMASI')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.animasi', compact('karyas'));
    }

    // Portofolio RPL
    public function portofolioRpl()
    {
        $karyas = Portofolio::where('jurusan', 'RPL')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.rpl', compact('karyas'));
    }

    // Portofolio DKV
    public function portofolioDkv()
    {
        $karyas = Portofolio::where('jurusan', 'DKV')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.dkv', compact('karyas'));
    }

    // Portofolio PSPT
    public function portofolioPspt()
    {
        $karyas = Portofolio::where('jurusan', 'PSPT')
            ->where('status_aktif', true)
            ->orderByDesc('id_portofolio')
            ->paginate(12);

        return view('public.katalog.jurusanp.pspt', compact('karyas'));
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
