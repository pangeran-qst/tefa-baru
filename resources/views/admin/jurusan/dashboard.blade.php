@extends('admin.jurusan.layouts.app')

@section('title', 'Dashboard Admin Jurusan')

@section('content')

    <!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Jurusan RPL - TeFA Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>
<body class="bg-slate-100 text-slate-700 flex min-h-screen">

  

  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-800">Dashboard Jurusan</h1>
      <p class="text-xs text-slate-500 mt-0.5">Selamat datang kembali — Ringkasan kinerja Jurusan RPL per 25 Agustus 2024</p>
    </div>

    <!-- 4 KARTU STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
      
      <!-- Card 1 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-lg mb-3">
          📁
        </div>
        <div>
          <div class="text-3xl font-extrabold text-slate-800">84</div>
          <p class="text-xs text-slate-500 font-medium mt-1">Total Project Jurusan</p>
          <span class="inline-block text-[11px] font-semibold text-indigo-600 mt-2">+12 bulan ini</span>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-lg mb-3">
          ⚡
        </div>
        <div>
          <div class="text-3xl font-extrabold text-slate-800">17</div>
          <p class="text-xs text-slate-500 font-medium mt-1">Project Aktif Diproses</p>
          <span class="inline-block text-[11px] font-semibold text-sky-500 mt-2">Sedang berjalan</span>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg mb-3">
          👷
        </div>
        <div>
          <div class="text-3xl font-extrabold text-slate-800">32</div>
          <p class="text-xs text-slate-500 font-medium mt-1">Total Worker Aktif</p>
          <span class="inline-block text-[11px] font-semibold text-emerald-600 mt-2">Dari 3 kelas</span>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg mb-3">
          ✅
        </div>
        <div>
          <div class="text-3xl font-extrabold text-slate-800">61</div>
          <p class="text-xs text-slate-500 font-medium mt-1">Project Selesai</p>
          <span class="inline-block text-[11px] font-semibold text-amber-500 mt-2">Lolos QC</span>
        </div>
      </div>

    </div>

    <!-- GRAFIK SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
      
      <!-- Bar Chart -->
      <div class="lg:col-span-7 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <h2 class="text-base font-bold text-slate-800">Produk/Jasa Terlaris</h2>
        <p class="text-xs text-slate-400 mb-4">Total order per kategori layanan</p>
        <div class="h-60">
          <canvas id="barChart"></canvas>
        </div>
      </div>

      <!-- Line Chart -->
      <div class="lg:col-span-5 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <h2 class="text-base font-bold text-slate-800">Rata-rata Kecepatan Pengerjaan</h2>
        <p class="text-xs text-slate-400 mb-4">Dalam hari per project</p>
        <div class="h-60">
          <canvas id="lineChart"></canvas>
        </div>
      </div>

    </div>

    <!-- TABLE ORDER TERBARU -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-6">
      <div class="flex items-center justify-between mb-5">
        <div>
          <h2 class="text-base font-bold text-slate-800">Order Terbaru</h2>
          <p class="text-xs text-slate-400 mt-0.5">Aktivitas pesanan terkini</p>
        </div>
        <a href="#" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800 transition flex items-center gap-1">
          Lihat Semua &rarr;
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[10px] tracking-wider">
            <tr>
              <th class="pb-3 px-3">ID Order</th>
              <th class="pb-3 px-3">Klien</th>
              <th class="pb-3 px-3">Produk/Jasa</th>
              <th class="pb-3 px-3">Worker</th>
              <th class="pb-3 px-3">Deadline</th>
              <th class="pb-3 px-3">Status</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <!-- Row 1 -->
            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-3.5 px-3 font-semibold text-slate-500">ORD-2024-081</td>
              <td class="py-3.5 px-3 font-bold text-slate-800">PT Maju Bersama</td>
              <td class="py-3.5 px-3 text-slate-600">Web Company Profile</td>
              <td class="py-3.5 px-3 text-slate-700 font-medium">Rizky A.</td>
              <td class="py-3.5 px-3 text-slate-500">30 Agu 2024</td>
              <td class="py-3.5 px-3">
                <span class="bg-blue-50 text-blue-600 text-[11px] font-semibold px-3 py-1 rounded-full">Dalam Pengerjaan</span>
              </td>
            </tr>

            <!-- Row 2 -->
            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-3.5 px-3 font-semibold text-slate-500">ORD-2024-079</td>
              <td class="py-3.5 px-3 font-bold text-slate-800">CV Teknindo Jaya</td>
              <td class="py-3.5 px-3 text-slate-600">Sistem Inventori</td>
              <td class="py-3.5 px-3 text-slate-700 font-medium">Siti N.</td>
              <td class="py-3.5 px-3 text-slate-500">28 Agu 2024</td>
              <td class="py-3.5 px-3">
                <span class="bg-amber-50 text-amber-600 text-[11px] font-semibold px-3 py-1 rounded-full">Peninjauan QC</span>
              </td>
            </tr>

            <!-- Row 3 -->
            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-3.5 px-3 font-semibold text-slate-500">ORD-2024-076</td>
              <td class="py-3.5 px-3 font-bold text-slate-800">Apotek Sehat</td>
              <td class="py-3.5 px-3 text-slate-600">Aplikasi Kasir</td>
              <td class="py-3.5 px-3 text-slate-400 italic">-</td>
              <td class="py-3.5 px-3 text-slate-500">05 Sep 2024</td>
              <td class="py-3.5 px-3">
                <span class="bg-purple-50 text-purple-600 text-[11px] font-semibold px-3 py-1 rounded-full">Pesanan Masuk</span>
              </td>
            </tr>

            <!-- Row 4 -->
            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-3.5 px-3 font-semibold text-slate-500">ORD-2024-074</td>
              <td class="py-3.5 px-3 font-bold text-slate-800">UD Serba Ada</td>
              <td class="py-3.5 px-3 text-slate-600">Landing Page</td>
              <td class="py-3.5 px-3 text-slate-700 font-medium">Dian P.</td>
              <td class="py-3.5 px-3 text-slate-500">22 Agu 2024</td>
              <td class="py-3.5 px-3">
                <span class="bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">Selesai</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <!-- JAVASCRIPT UNTUK INSIALISASI CHART -->
  <script>
    // Bar Chart Config
    const ctxBar = document.getElementById('barChart').getContext('2d');
    new Chart(ctxBar, {
      type: 'bar',
      data: {
        labels: ['UI/UX Design', 'Web Dev', 'Mobile App', 'Sistem Info', 'API Service', 'QA Testing'],
        datasets: [{
          data: [25, 18, 13, 11, 7, 5],
          backgroundColor: '#5850ec',
          borderRadius: 6,
          barThickness: 34
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: {
            beginAtZero: true,
            max: 24,
            ticks: { stepSize: 6, color: '#94a3b8', font: { size: 10 } },
            grid: { color: '#f1f5f9' }
          },
          x: {
            ticks: { color: '#94a3b8', font: { size: 10 } },
            grid: { display: false }
          }
        }
      }
    });

    // Line Chart Config
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
      type: 'line',
      data: {
        labels: ['Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu'],
        datasets: [{
          data: [6.3, 5.9, 7.1, 6.4, 4.9, 5.6],
          borderColor: '#10b981',
          backgroundColor: 'rgba(16, 185, 129, 0.08)',
          fill: true,
          tension: 0.4,
          pointBackgroundColor: '#10b981',
          pointRadius: 4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          y: {
            min: 4,
            max: 8,
            ticks: { stepSize: 1, color: '#94a3b8', font: { size: 10 } },
            grid: { color: '#f1f5f9' }
          },
          x: {
            ticks: { color: '#94a3b8', font: { size: 10 } },
            grid: { display: false }
          }
        }
      }
    });
  </script>

</body>
</html>

@endsection
