@extends('admin.jurusan.layouts.app')

@section('title', 'Dashboard')

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
      <h1 class="text-2xl font-bold text-slate-800">
        Selamat datang kembali, {{ Auth::user()->nama }} 👋
      </h1>

          <h2> 
            Ringkasan kinerja Jurusan {{ Auth::user()->jurusan }}
            / {{ now()->translatedFormat('d F Y') }}
          </h2>
    </div>

    <!-- 4 KARTU STATISTIK -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5 mb-6">
      
      <!-- Card 1 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-lg mb-3">
          📁
        </div>
        <div>
            <div class="text-3xl font-extrabold text-slate-800">
              {{ $totalPesanan }}
            </div>
          <p class="text-xs text-slate-500 font-medium mt-1">Total Project Jurusan</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-500 flex items-center justify-center text-lg mb-3">
          ⚡
        </div>
        <div>
            <div class="text-3xl font-extrabold text-slate-800">
              {{ $projectAktif }}
            </div>
          <p class="text-xs text-slate-500 font-medium mt-1">Project Aktif Diproses</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg mb-3">
          👷
        </div>
        <div>
            <div class="text-3xl font-extrabold text-slate-800">
               {{ $totalWorkerAktif }}
            </div>
          <p class="text-xs text-slate-500 font-medium mt-1">Total Worker Aktif</p>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm flex flex-col justify-between">
        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-lg mb-3">
          ✅
        </div>
        <div>
          <div class="text-3xl font-extrabold text-slate-800">
            {{ $projectSelesai }}
          </div>
          <p class="text-xs text-slate-500 font-medium mt-1">Project Selesai</p>
        </div>
      </div>

    </div>

    <!-- GRAFIK SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
      
      <!-- Bar Chart -->
      <div class="lg:col-span-12 bg-white p-6 rounded-2xl border border-slate-200/80 shadow-sm">
        <h2 class="text-base font-bold text-slate-800">Produk/Jasa Terlaris</h2>
        <p class="text-xs text-slate-400 mb-4">Total order per kategori layanan</p>
        <div class="h-60">
          <canvas id="barChart"></canvas>
        </div>
      </div>

    </div>

  
{{-- ==========================================
     ANALISIS SELURUH PRODUK/JASA
========================================== --}}
<div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden p-6">

    {{-- HEADER --}}
    <div class="mb-5">
        <h2 class="text-base font-bold text-slate-800">
            Analisis Seluruh Produk/Jasa
        </h2>

        <p class="text-xs text-slate-400 mt-0.5">
            Statistik jumlah pesanan seluruh produk jurusan
        </p>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto">

        <table class="w-full text-left text-xs">

            <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[10px] tracking-wider">

                <tr>
                    <th class="pb-3 px-3">No</th>
                    <th class="pb-3 px-3">Produk/Jasa</th>
                    <th class="pb-3 px-3">Harga</th>
                    <th class="pb-3 px-3">Total Pesanan</th>
                    <th class="pb-3 px-3">Status</th>
                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse ($produkAnalisis as $index => $produk)

                    <tr class="hover:bg-slate-50/50 transition">

                        {{-- NOMOR --}}
                        <td class="py-3.5 px-3 font-semibold text-slate-500">
                            {{ $index + 1 }}
                        </td>

                        {{-- NAMA PRODUK --}}
                        <td class="py-3.5 px-3 font-bold text-slate-800">
                            {{ $produk->nama_produk }}
                        </td>

                        {{-- HARGA --}}
                        <td class="py-3.5 px-3 text-slate-600">
                            Rp {{ number_format($produk->harga ?? 0, 0, ',', '.') }}
                        </td>

                        {{-- TOTAL PESANAN --}}
                        <td class="py-3.5 px-3">

                            <span class="font-bold text-indigo-600">
                                {{ $produk->total_pesanan }}
                            </span>

                            <span class="text-slate-400">
                                Pesanan
                            </span>

                        </td>

                        {{-- STATUS PRODUK --}}
                        <td class="py-3.5 px-3">

                            @if ($produk->status_aktif)

                                <span class="bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                                    Aktif
                                </span>

                            @else

                                <span class="bg-slate-100 text-slate-500 text-[11px] font-semibold px-3 py-1 rounded-full">
                                    Nonaktif
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="5" class="py-8 text-center text-slate-400">
                            Belum ada produk atau jasa pada jurusan ini.
                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


  </main>

  <!-- JAVASCRIPT UNTUK INSIALISASI CHART -->
  <script>

    // ==========================================
// GRAFIK PRODUK/JASA TERLARIS
// ==========================================

const ctxBar = document.getElementById('barChart');

if (ctxBar) {
    new Chart(ctxBar, {

        type: 'bar',

        data: {
            labels: @json($produkTerlaris->pluck('nama_produk')),

            datasets: [{
                label: 'Jumlah Pesanan',

                data: @json($produkTerlaris->pluck('total_pesanan')),

                backgroundColor: '#5850ec',

                borderRadius: 6,

                barThickness: 34
            }]
        },

        options: {
            responsive: true,

            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                },

                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' Pesanan';
                        }
                    }
                }
            },

            scales: {
                y: {
                    beginAtZero: true,

                    ticks: {
                        precision: 0,
                        stepSize: 1,
                        color: '#94a3b8',
                        font: {
                            size: 10
                        }
                    },

                    grid: {
                        color: '#f1f5f9'
                    }
                },

                x: {
                    ticks: {
                        color: '#94a3b8',
                        font: {
                            size: 10
                        }
                    },

                    grid: {
                        display: false
                    }
                }
            }
        }
    });
}

  </script>

</body>
</html>

@endsection
