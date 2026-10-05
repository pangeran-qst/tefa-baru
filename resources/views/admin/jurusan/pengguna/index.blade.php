@extends('admin.jurusan.layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

  
  

  
  <title>Data Worker - Admin Jurusan RPL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  


  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title & Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Data Worker</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola siswa eksekutor di Jurusan RPL</p>
      </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
      
      <!-- Total Worker -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-indigo-600 mb-1">{{ $totalWorker }}</div> <!-- Fungsinya menghitung datanya sesuai akun tsb -->
        <div class="text-xs font-medium text-slate-500">Total Worker</div>
      </div>

      <!-- Available -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-emerald-500 mb-1">{{ $workerAvailable }}</div>
        <div class="text-xs font-medium text-slate-500">Tersedia</div>
      </div>

      <!-- Busy -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-rose-500 mb-1">{{ $workerBusy }}</div>
        <div class="text-xs font-medium text-slate-500">Mengerjakan</div>
      </div>

    </div>

    <!-- SEARCH & FILTER BAR -->
    <div class="flex flex-col md:flex-row items-center justify-between gap-4 mb-6">
      
      <!-- Search Box -->
      <div class="relative w-full md:w-96">
        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 text-sm">
          🔍
        </span>
        <input type="text" id="searchInput" onkeyup="filterWorkers()" placeholder="Cari nama, spesialisasi, kelas..." class="w-full pl-10 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition shadow-sm">
      </div>

      <!-- Filter Buttons -->
      <div class="flex items-center gap-2 w-full md:w-auto overflow-x-auto pb-1 md:pb-0">
        <button onclick="filterStatus('all')" id="btn-all" class="filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-indigo-600 text-white shadow-sm transition">
          Semua
        </button>
        <button onclick="filterStatus('available')" id="btn-available" class="filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
          Tersedia
        </button>
        <button onclick="filterStatus('busy')" id="btn-busy" class="filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
          Mengerjakan
        </button>
      </div>

    </div>

    <!-- WORKER TABLE CARD -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-slate-100 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-50/50">
              <th class="py-4 px-6">WORKER</th>
              <th class="py-4 px-4">KELAS</th>
              <th class="py-4 px-4 text-center">STATUS</th>
              <th class="py-4 px-4 text-center">PROJECT</th>
            </tr>
          </thead>
          <tbody id="workerTableBody" class="divide-y divide-slate-100 text-xs">

            @forelse ($workers as $worker)

                @php
                    $isBusy = $worker->project_aktif > 0;
                @endphp

                <tr class="worker-row hover:bg-slate-50/80 transition"
                    data-status="{{ $isBusy ? 'busy' : 'available' }}"
                    data-name="{{ strtolower($worker->nama) }}">

                    {{-- WORKER --}}
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">

                            <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center">
                                {{ strtoupper(substr($worker->nama, 0, 2)) }}
                            </div>

                            <div>
                                <div class="font-bold text-slate-800">
                                    {{ $worker->nama }}
                                </div>

                                <div class="text-[10px] text-slate-400">
                                    {{ $worker->email }}
                                </div>
                            </div>

                        </div>
                    </td>


                    {{-- KELAS --}}
                    <td class="py-4 px-4">
                        <div class="font-medium text-slate-700">
                            {{ $worker->kelas ?? 'Belum diisi' }}
                        </div>
                    </td>


                    {{-- STATUS --}}
                    <td class="py-4 px-4 text-center">

                        @if ($isBusy)

                            <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                Mengerjakan
                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Tersedia
                            </span>

                        @endif

                    </td>


                    {{-- PROJECT --}}
                    <td class="py-4 px-4 text-center">

                        <div class="font-bold text-slate-800">
                            {{ $worker->project_aktif }}
                            <span class="text-[10px] font-normal text-slate-400">
                                aktif
                            </span>
                        </div>

                        <div class="text-[10px] text-slate-400">
                            {{ $worker->project_selesai }} selesai
                        </div>

                    </td>


                    {{-- AKSI --}}
                    <!-- <td class="py-4 px-6 text-center">
                        <button
                            type="button"
                            class="text-indigo-600 hover:text-indigo-800 font-semibold">
                            Detail
                        </button>
                    </td> -->

                </tr>

            @empty

                <tr>
                    <td colspan="6" class="py-10 text-center text-slate-400">
                        Belum ada Worker di jurusan ini.
                    </td>
                </tr>

            @endforelse

        </tbody>
        </table>
      </div>
    </div>

  </main>

  <!-- JAVASCRIPT UNTUK SEARCH & FILTER STATUS -->
  <script>
    let currentStatusFilter = 'all';

    function filterStatus(status) {
      currentStatusFilter = status;

      // Update Tampilan Button Filter Active
      const buttons = document.querySelectorAll('.filter-btn');
      buttons.forEach(btn => {
        btn.className = 'filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition';
      });

      const activeBtn = document.getElementById(`btn-${status}`);
      if (activeBtn) {
        activeBtn.className = 'filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-indigo-600 text-white shadow-sm transition';
      }

      applyFilters();
    }

    function filterWorkers() {
      applyFilters();
    }

    function applyFilters() {
      const searchInputValue = document.getElementById('searchInput').value.toLowerCase();
      const rows = document.querySelectorAll('.worker-row');

      rows.forEach(row => {
        const rowStatus = row.getAttribute('data-status');
        const name = row.querySelector('.worker-name').textContent.toLowerCase();
        const workerClass = row.querySelector('.worker-class').textContent.toLowerCase();
        const spec = row.querySelector('.worker-spec').textContent.toLowerCase();

        // Check Match Status
        const matchesStatus = (currentStatusFilter === 'all') || (rowStatus === currentStatusFilter);
        
        // Check Match Search Input
        const matchesSearch = name.includes(searchInputValue) || 
                              workerClass.includes(searchInputValue) || 
                              spec.includes(searchInputValue);

        if (matchesStatus && matchesSearch) {
          row.style.display = '';
        } else {
          row.style.display = 'none';
        }
      });
    }
  </script>

  

  
@endsection