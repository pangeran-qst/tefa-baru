<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminJurusanController extends Controller
{
    public function index()
    {
        // 1. Ambil data user admin yang sedang login
        $userLogin = Auth::user();
        
        // Ambil kode/nama jurusan (misal: 'RPL', 'TKJ', 'DKV', 'GIM', 'PSPT')
        $jurusanUser = $userLogin->jurusan;

        // 2. Query Base: Filter ke tabel 'tefas' menggunakan kolom 'jurusan'
        $baseQuery = Pesanan::whereHas('tefa', function($q) use ($jurusanUser) {
            if ($jurusanUser) {
                $q->where('jurusan', $jurusanUser);
            }
        });

        // 3. Ambil Pesanan Masuk (yang diteruskan dari Admin TEFA)
        $pesananMasuk = (clone $baseQuery)
            ->whereIn('status', ['diproses', 'proses'])
            ->latest()
            ->get();

        // 4. Dalam Pengerjaan
        $dalamPengerjaan = (clone $baseQuery)
            ->whereIn('status', ['pengerjaan', 'in_progress'])
            ->latest()
            ->get();

        // 5. Peninjauan & QC
        $peninjauanQC = (clone $baseQuery)
            ->whereIn('status', ['review', 'qc'])
            ->latest()
            ->get();

        // 6. Pesanan Selesai
        $pesananSelesai = (clone $baseQuery)
            ->whereIn('status', ['selesai', 'completed'])
            ->latest()
            ->get();

        // 7. Ambil Worker / Siswa (Hanya menggunakan kolom 'jurusan' yang ada di DB)
        $workerQuery = User::whereIn('role', ['worker', 'siswa', 'User Worker']);
        if ($jurusanUser) {
            $workerQuery->where('jurusan', $jurusanUser);
        }
        $workers = $workerQuery->get();

        return view('admin.jurusan.pesanan.index', compact(
            'pesananMasuk',
            'dalamPengerjaan',
            'peninjauanQC',
            'pesananSelesai',
            'workers'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        $pesanan->status = $request->status;
        $pesanan->save();

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function assignWorker(Request $request, $id)
    {
        $request->validate([
            'id_user_worker' => 'required',
        ]);

        $pesanan = Pesanan::findOrFail($id);
        
        // Set worker yang ditugaskan dan ubah status ke pengerjaan
        $pesanan->id_user_worker = $request->id_user_worker;
        $pesanan->status = 'pengerjaan';
        $pesanan->save();

        return redirect()->back()->with('success', 'Pesanan berhasil ditugaskan ke Worker/Siswa!');
    }
}