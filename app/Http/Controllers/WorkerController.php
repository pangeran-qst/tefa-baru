<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\ProgressPesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{

    public function index()
    {
        $workerId = Auth::id();

        // Project yang sedang dikerjakan worker
        $projectAktif = Pesanan::where('id_user_worker', $workerId)
            ->where('status', 'pengerjaan')
            ->count();

        // Project yang sudah selesai
        $projectSelesai = Pesanan::where('id_user_worker', $workerId)
            ->where('status', 'selesai')
            ->count();

        return view('worker.dashboard', compact(
            'projectAktif',
            'projectSelesai'
        ));
    }

    public function tugasku()
    {
        $workerId = Auth::id();

        $newProject = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'ditugaskan')
            ->latest('tanggal_pesan')
            ->get();

        $projectSaya = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'pengerjaan')
            ->latest('tanggal_pesan')
            ->get();

        $projectSelesai = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'selesai')
            ->latest('tanggal_pesan')
            ->get();

        return view('worker.tugasku.index', compact(
            'newProject',
            'projectSaya',
            'projectSelesai'
        ));
    }


    public function portofolio()
    {
        $workerId = Auth::id();

        $portofolio = Pesanan::with(['tefa', 'user'])
            ->where('id_user_worker', $workerId)
            ->where('status', 'selesai')
            ->latest('tanggal_pesan')
            ->get();

        return view('worker.portofolio.index', compact('portofolio'));
    }


    public function terima($id)
    {
        $workerId = Auth::id();

        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_user_worker', $workerId)
            ->where('status', 'ditugaskan')
            ->firstOrFail();

        $pesanan->status = 'pengerjaan';
        $pesanan->save();

                ProgressPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $workerId,
            'progress' => 0,
            'tahap' => 'Masuk Tahap Pengerjaan',
            'catatan' => 'Pesanan sudah masuk ke tahap pengerjaan.',
            'tanggal_progress' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Project berhasil diterima dan masuk ke Project Saya.');
    }


    public function tolak($id)
    {
        $workerId = Auth::id();

        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_user_worker', $workerId)
            ->where('status', 'ditugaskan')
            ->firstOrFail();

        $pesanan->id_user_worker = null;
        $pesanan->status = 'diproses';
        $pesanan->save();

        return redirect()
            ->back()
            ->with('success', 'Project ditolak dan dikembalikan ke Admin Jurusan.');
    }


    public function updateProgress(Request $request, $id)
    {
        $request->validate([
            'progress' => 'required|integer|min:0|max:100',
            'tahap' => 'required|string|max:100',
            'catatan' => 'nullable|string',
        ]);

        $workerId = Auth::id();

        $pesanan = Pesanan::where('id_pesanan', $id)
            //agar worker bisa update sesuai tugas yg dikasih
            ->where('id_user_worker', $workerId)
            ->where('status', 'pengerjaan')
            ->firstOrFail();

            ProgressPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $workerId,
            'progress' => $request->progress,
            'tahap' => $request->tahap,
            'catatan' => $request->catatan,
            'tanggal_progress' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Progress project berhasil diperbarui.');
    }


    public function selesai($id)
    {
        $workerId = Auth::id();

        $pesanan = Pesanan::where('id_pesanan', $id)
            ->where('id_user_worker', $workerId)
            ->where('status', 'pengerjaan')
            ->firstOrFail();

        $pesanan->status = 'review';
        $pesanan->save();

                ProgressPesanan::create([
            'id_pesanan' => $pesanan->id_pesanan,
            'id_user' => $workerId,
            'progress' => 100,
            'tahap' => 'Menunggu QC',
            'catatan' => 'Project telah selesai dikerjakan dan sedang menunggu pemeriksaan QC.',
            'tanggal_progress' => now(),
        ]);

        return redirect()
            ->back()
            ->with('success', 'Project berhasil diajukan untuk QC.');
    }
}