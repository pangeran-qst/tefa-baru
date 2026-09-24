@extends('worker.layouts.app')

@section('title', 'Dashboard Worker')

@section('content')


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Digital - TeFA Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
  
    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8 overflow-y-auto">
    
        <!-- Header Title & User Status -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Portofolio Digital</h1>
            <p class="text-xs text-slate-500 mt-0.5">Arsip project yang telah lolos Quality Control</p>
        </div>
        <div class="flex items-center gap-3 self-start sm:self-auto">
            <span class="text-xs text-slate-400 font-medium">Minggu, 30 Agustus 2026</span>
            <div class="w-8 h-8 rounded-full bg-indigo-600 text-white text-xs font-bold flex items-center justify-center shadow">
            AJ
            </div>
        </div>
        </div>

        <!-- Alert Information Banner -->
        <div class="bg-emerald-50/80 border border-emerald-200 text-indigo-950 p-4 rounded-2xl flex items-center gap-2 text-xs font-medium mb-6">
        <span>🎉</span>
        <span>Ini adalah portofolio digital kamu. Semua project yang telah lolos QC tersimpan di sini.</span>
        </div>

        <!-- LIST PORTOFOLIO PROJECT -->
        <div class="space-y-4">

        <!-- Item 1: Website Portfolio Sekolah -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-slate-300 transition">
            <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-600">Web Dev</span>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-600">Sangat Baik</span>
            </div>
            <h3 class="text-sm font-bold text-slate-800">Website Portfolio Sekolah</h3>
            <p class="text-xs text-slate-400 mt-1">Selesai: 2026-07-20</p>
            </div>
            <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-md shadow-indigo-600/20 transition self-start md:self-auto">
            🔗 Lihat Hasil
            </button>
        </div>

        <!-- Item 2: Sistem Informasi Perpustakaan -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-slate-300 transition">
            <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-600">Sistem Info</span>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-600">Baik</span>
            </div>
            <h3 class="text-sm font-bold text-slate-800">Sistem Informasi Perpustakaan</h3>
            <p class="text-xs text-slate-400 mt-1">Selesai: 2026-06-15</p>
            </div>
            <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-md shadow-indigo-600/20 transition self-start md:self-auto">
            🔗 Lihat Hasil
            </button>
        </div>

        <!-- Item 3: Desain UI Aplikasi Absensi -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4 hover:border-slate-300 transition">
            <div>
            <div class="flex items-center gap-2 mb-2">
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-600">UI/UX Design</span>
                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-600">Sangat Baik</span>
            </div>
            <h3 class="text-sm font-bold text-slate-800">Desain UI Aplikasi Absensi</h3>
            <p class="text-xs text-slate-400 mt-1">Selesai: 2026-05-30</p>
            </div>
            <button class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold flex items-center justify-center gap-2 shadow-md shadow-indigo-600/20 transition self-start md:self-auto">
            🔗 Lihat Hasil
            </button>
        </div>

        </div>
    </main>
  

@endsection