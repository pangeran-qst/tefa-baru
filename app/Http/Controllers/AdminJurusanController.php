<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class AdminJurusanController extends Controller
{
    public function index()
    {
        // Ambil jurusan_id milik user admin jurusan yang sedang login
        $jurusanId = Auth::user()->jurusan_id;

        // Ambil pesanan yang dilempar khusus ke jurusan ini
        $pesananMasuk = Pesanan::where('jurusan_id', $jurusanId)
            ->where('status', 'diproses') // Pesanan yang dilempar dari Admin TeFa
            ->latest()
            ->get();

        return view('admin.jurusan.pesanan.index', compact('pesananMasuk'));
    }
}