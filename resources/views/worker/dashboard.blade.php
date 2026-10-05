@extends('worker.layouts.app')

@section('title', 'Dashboard Worker')

@section('content')






    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Worker - TeFA Platform</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
      body { font-family: 'Inter', sans-serif; }
    </style>
  

  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Header Title & User Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
        <p class="text-xs text-slate-500 mt-0.5">
          Selamat datang kembali, {{ Auth::user()->nama }} 👋
        </p>
      </div>
      <div class="flex items-center gap-3 self-start sm:self-auto">
          <span class="text-xs text-slate-400 font-medium">
              {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
          </span>

          @php
              $nama = Auth::user()->nama ?? 'Worker';

              $inisial = collect(explode(' ', trim($nama)))
                  ->filter()
                  ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                  ->take(2)
                  ->implode('');
          @endphp

          <div class="w-8 h-8 rounded-full bg-indigo-600 text-white text-xs font-bold flex items-center justify-center shadow">
              {{ $inisial }}
          </div>
      </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      
      <!-- Card 1: Project Aktif -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <div class="w-10 h-10 rounded-xl bg-amber-50 flex items-center justify-center text-amber-500 text-lg">
            ⚡
          </div>
        </div>
        <div>
          <h2 class="text-4xl font-extrabold text-slate-800 mb-1">2</h2>
          <p class="text-xs text-slate-500 font-medium mb-3">Project Aktif</p>
          <span class="text-xs font-semibold text-indigo-600">Sedang berjalan</span>
        </div>
      </div>

      <!-- Card 2: Deadline Terdekat -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <div class="w-10 h-10 rounded-xl bg-rose-50 flex items-center justify-center text-rose-500 text-lg">
            ⏰
          </div>
        </div>
        <div>
          <h2 class="text-3xl font-extrabold text-slate-800 mb-1">16 Hari Lagi</h2>
          <p class="text-xs text-slate-500 font-medium mb-3">Deadline Terdekat</p>
          <span class="text-xs font-semibold text-amber-500">Aplikasi Kasir Mobile</span>
        </div>
      </div>

      <!-- Card 3: Total Selesai -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="flex items-center justify-between mb-4">
          <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-500 text-lg">
            ✅
          </div>
        </div>
        <div>
          <h2 class="text-4xl font-extrabold text-slate-800 mb-1">3</h2>
          <p class="text-xs text-slate-500 font-medium mb-3">Total Selesai</p>
          <span class="text-xs font-semibold text-emerald-600">Lolos QC</span>
        </div>
      </div>

    </div>

    <!-- QUICK ACCESS: PROJECT MENDEKATI DEADLINE -->
    <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm mb-8">
      <div class="mb-4">
        <h2 class="text-sm font-bold text-slate-800">Quick Access — Project Mendekati Deadline</h2>
        <p class="text-xs text-slate-400 mt-0.5">Akses cepat ke project aktif yang paling mendekati tenggat</p>
      </div>

      <div class="space-y-3">
        <!-- Item 1 -->
        <div class="bg-slate-50/70 hover:bg-slate-50 rounded-xl p-4 border border-slate-100 flex items-center justify-between transition">
          <div>
            <h3 class="text-xs font-bold text-slate-800">Aplikasi Kasir Mobile</h3>
            <p class="text-[11px] text-slate-400 mt-0.5">Mobile App</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-right">
              <span class="text-xs font-bold text-amber-500 block">16 hari lagi</span>
              <span class="text-[10px] text-slate-400">2026-09-15</span>
            </div>
            <div class="flex items-center gap-2">
              <div class="w-12 bg-slate-200 rounded-full h-1.5 overflow-hidden">
                <div class="bg-indigo-600 h-full rounded-full" style="width: 75%"></div>
              </div>
              <span class="text-xs font-semibold text-slate-500 w-8 text-right">75%</span>
            </div>
          </div>
        </div>

        <!-- Item 2 -->
        <div class="bg-slate-50/70 hover:bg-slate-50 rounded-xl p-4 border border-slate-100 flex items-center justify-between transition">
          <div>
            <h3 class="text-xs font-bold text-slate-800">Dashboard Analytics Web</h3>
            <p class="text-[11px] text-slate-400 mt-0.5">Web Dev</p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-right">
              <span class="text-xs font-bold text-amber-500 block">21 hari lagi</span>
              <span class="text-[10px] text-slate-400">2026-09-20</span>
            </div>
            <div class="flex items-center gap-2">
              <div class="w-12 bg-slate-200 rounded-full h-1.5 overflow-hidden">
                <div class="bg-indigo-600 h-full rounded-full" style="width: 40%"></div>
              </div>
              <span class="text-xs font-semibold text-slate-500 w-8 text-right">40%</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CHARTS SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      
      <!-- Bar Chart Card -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
        <div class="mb-4">
          <h2 class="text-sm font-bold text-slate-800">Jasa Paling Banyak Dikerjakan</h2>
          <p class="text-xs text-slate-400 mt-0.5">Total project per kategori layanan di platform</p>
        </div>
        <div class="h-64">
          <canvas id="barChart"></canvas>
        </div>
      </div>

      <!-- Line Chart Card -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
        <div class="mb-4">
          <h2 class="text-sm font-bold text-slate-800">Rata-rata Kecepatan</h2>
          <p class="text-xs text-slate-400 mt-0.5">Dalam hari per project selesai</p>
        </div>
        <div class="h-64">
          <canvas id="lineChart"></canvas>
        </div>
      </div>

    </div>

  </main>

  <!-- SCRIPT UNTUK MEMBUAT CHART -->
  <script>
    // Bar Chart Configuration
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['UI/UX Design', 'Web Dev', 'Mobile App', 'Sistem Info', 'API Service', 'QA Testing'],
        datasets: [{
          data: [12, 9, 7, 5, 4, 3],
          backgroundColor: '#4f46e5',
          borderRadius: 6,
          barThickness: 28
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            beginAtZero: true,
            max: 12,
            ticks: { stepSize: 3, font: { size: 10 } },
            grid: { color: '#f1f5f9' }
          },
          x: {
            ticks: { font: { size: 10 } },
            grid: { display: false }
          }
        }
      }
    });

    // Line Chart Configuration
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: ['Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
        datasets: [{
          data: [6, 5.5, 7.2, 6.2, 5.1, 5.5],
          borderColor: '#10b981',
          backgroundColor: '#10b981',
          pointBackgroundColor: '#10b981',
          pointRadius: 4,
          tension: 0.3
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          y: {
            min: 4,
            max: 8,
            ticks: { stepSize: 1, font: { size: 10 } },
            grid: { color: '#f1f5f9' }
          },
          x: {
            ticks: { font: { size: 10 } },
            grid: { display: false }
          }
        }
      }
    });
  </script>

</body>
</html>

@endsection