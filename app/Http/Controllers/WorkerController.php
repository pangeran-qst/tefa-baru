<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function tugasku()
    {
        // ID user yang sedang login
        $workerId = Auth::id();

        // ==========================================
        // PROJECT SAYA
        // Pesanan yang sudah ditugaskan ke worker
        // ==========================================

        $projectSaya = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'pengerjaan')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // PROJECT SELESAI
        // Pesanan yang sudah selesai
        // ==========================================

        $projectSelesai = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'selesai')
            ->latest('tanggal_pesan')
            ->get();


        // ==========================================
        // NEW PROJECT
        // Untuk sementara kosong.
        //
        // Kita belum punya status khusus
        // "menunggu diterima worker".
        // ==========================================

        $newProject = collect();


        return view('worker.tugasku.index', compact(
            'newProject',
            'projectSaya',
            'projectSelesai'
        ));
    }
}