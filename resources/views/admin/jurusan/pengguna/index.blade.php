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
      <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-indigo-600/20 transition flex items-center justify-center gap-1.5 self-start sm:self-auto">
        <span>+</span> Tambah Worker
      </button>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
      
      <!-- Total Worker -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-indigo-600 mb-1">8</div>
        <div class="text-xs font-medium text-slate-500">Total Worker</div>
      </div>

      <!-- Available -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-emerald-500 mb-1">5</div>
        <div class="text-xs font-medium text-slate-500">Available</div>
      </div>

      <!-- Busy -->
      <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-sm text-center">
        <div class="text-2xl font-bold text-rose-500 mb-1">3</div>
        <div class="text-xs font-medium text-slate-500">Busy</div>
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
          Available
        </button>
        <button onclick="filterStatus('busy')" id="btn-busy" class="filter-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition">
          Busy
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
              <th class="py-4 px-4">KELAS / NISN</th>
              <th class="py-4 px-4">SPESIALISASI</th>
              <th class="py-4 px-4">SKILLS</th>
              <th class="py-4 px-4 text-center">STATUS</th>
              <th class="py-4 px-4 text-center">PROJECT</th>
              <th class="py-4 px-6 text-center">AKSI</th>
            </tr>
          </thead>
          <tbody id="workerTableBody" class="divide-y divide-slate-100 text-xs">
            
            <!-- Worker 1 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="busy">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    RA
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Rizky Aditya Pratama</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-001</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XI RPL 2</div>
                <div class="text-[10px] text-slate-400 font-mono">0074238910</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Frontend Development
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">React</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Vue.js</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Figma</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Busy
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">1 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">8 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 2 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="available">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    SN
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Siti Nurhaliza Dewi</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-002</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XII RPL 2</div>
                <div class="text-[10px] text-slate-400 font-mono">0063127845</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Fullstack Development
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Laravel</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">MySQL</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">React</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">0 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">14 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 3 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="busy">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    FN
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Fajar Nugroho Santoso</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-003</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XII RPL 1</div>
                <div class="text-[10px] text-slate-400 font-mono">0061938274</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Backend Development
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Node.js</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Express</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">PostgreSQL</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Busy
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">1 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">11 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 4 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="available">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    MP
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Mega Putri Rahayu</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-004</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XII RPL 1</div>
                <div class="text-[10px] text-slate-400 font-mono">0062847193</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                UI/UX Design
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Figma</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Adobe XD</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Prototyping</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">0 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">9 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 5 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="available">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    DP
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Dian Pratama Wijaya</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-005</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XI RPL 1</div>
                <div class="text-[10px] text-slate-400 font-mono">0073916482</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Frontend Development
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">HTML/CSS</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">JavaScript</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Bootstrap</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">0 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">6 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 6 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="busy">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    BS
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Budi Santoso Hariadi</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-006</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XII RPL 2</div>
                <div class="text-[10px] text-slate-400 font-mono">0062018374</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Mobile Development
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Flutter</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Dart</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Firebase</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-rose-50 text-rose-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Busy
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">2 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">7 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 7 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="available">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    AP
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Anisa Permata Sari</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-007</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XI RPL 2</div>
                <div class="text-[10px] text-slate-400 font-mono">0073849201</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                Graphic Design
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Illustrator</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Photoshop</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">CorelDraw</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">0 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">5 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

            <!-- Worker 8 -->
            <tr class="worker-row hover:bg-slate-50/80 transition" data-status="available">
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-indigo-600 text-white font-bold text-xs flex items-center justify-center shrink-0">
                    WT
                  </div>
                  <div>
                    <div class="font-bold text-slate-800 worker-name">Wahyu Tri Utomo</div>
                    <div class="text-[10px] text-slate-400 font-mono">W-008</div>
                  </div>
                </div>
              </td>
              <td class="py-4 px-4">
                <div class="font-medium text-slate-700 worker-class">XI RPL 1</div>
                <div class="text-[10px] text-slate-400 font-mono">0074920183</div>
              </td>
              <td class="py-4 px-4 font-medium text-slate-600 worker-spec">
                QA Testing
              </td>
              <td class="py-4 px-4">
                <div class="flex flex-wrap gap-1 max-w-[180px]">
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Postman</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Selenium</span>
                  <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-md font-medium">Manual Testing</span>
                  <span class="bg-slate-100 text-slate-500 text-[10px] px-1.5 py-0.5 rounded-md font-medium">+1</span>
                </div>
              </td>
              <td class="py-4 px-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-emerald-50 text-emerald-600 text-[11px] font-semibold px-3 py-1 rounded-full">
                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Available
                </span>
              </td>
              <td class="py-4 px-4 text-center">
                <div class="font-bold text-slate-800">0 <span class="text-[10px] font-normal text-slate-400">aktif</span></div>
                <div class="text-[10px] text-slate-400">4 selesai</div>
              </td>
              <td class="py-4 px-6 text-center">
                <div class="flex items-center justify-center gap-2">
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Detail</button>
                  <button class="px-3 py-1.5 border border-slate-200 text-slate-600 hover:bg-slate-100 rounded-lg text-xs font-semibold transition">Edit</button>
                </div>
              </td>
            </tr>

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