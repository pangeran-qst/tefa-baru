<?php

namespace App\Http\Controllers;

use App\Models\Tefa;
use App\Models\Pesanan;
use Illuminate\Http\Request;

class TefaController extends Controller
{
   public function katalog()
    {
        $tefas = Tefa::where('status_aktif', true)->get();

        return view('public.katalog.index', compact('tefas'));
    }

    public function tkj()
    {
        $tefas = Tefa::where('jurusan', 'TKJ') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.tkj', compact('tefas'));
    }

    public function gim()
    {
        $tefas = Tefa::where('jurusan', 'GIM') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.gim', compact('tefas'));
    }

    public function animasi()
    {
        $tefas = Tefa::where('jurusan', 'ANIMASI') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.animasi', compact('tefas'));
    }

    public function rpl()
    {
        $tefas = Tefa::where('jurusan', 'RPL') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.rpl', compact('tefas'));
    }

    public function dkv()
    {
        $tefas = Tefa::where('jurusan', 'DKV') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.dkv', compact('tefas'));
    }

    public function pspt()
    {
        $tefas = Tefa::where('jurusan', 'PSPT') ->where('status_aktif', true) ->get();

        return view('public.katalog.jurusan.pspt', compact('tefas'));
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
            'id_user' => null,
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

}
