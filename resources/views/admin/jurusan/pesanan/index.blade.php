@extends('admin.jurusan.layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

  
  

  
  <title>Management Order - Admin Jurusan RPL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  


  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-800">Management Order</h1>
      <p class="text-xs text-slate-500 mt-0.5">Kelola alur pesanan masuk hingga penyelesaian</p>
    </div>

    <!-- TAB NAVIGATION -->
    <div class="flex flex-wrap items-center gap-3 mb-6">
      
      <!-- Tab 1: Pesanan Masuk -->
      <button onclick="switchTab('pesanan-masuk')" id="tab-pesanan-masuk" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-indigo-600 text-white shadow-md shadow-indigo-600/20 transition">
        <span>📮</span> Pesanan Masuk
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full">3</span>
      </button>

      <!-- Tab 2: Dalam Pengerjaan -->
      <button onclick="switchTab('dalam-pengerjaan')" id="tab-dalam-pengerjaan" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span>🔧</span> Dalam Pengerjaan
        <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full">2</span>
      </button>

      <!-- Tab 3: Peninjauan & QC -->
      <button onclick="switchTab('peninjauan-qc')" id="tab-peninjauan-qc" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span>🔍</span> Peninjauan & QC
        <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full">1</span>
      </button>

      <!-- Tab 4: Pesanan Selesai -->
      <button onclick="switchTab('pesanan-selesai')" id="tab-pesanan-selesai" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span>🎉</span> Pesanan Selesai
        <span class="bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full">3</span>
      </button>

    </div>

    <!-- TAB CONTENTS -->

    <!-- CONTENT 1: PESANAN MASUK -->
    <div id="content-pesanan-masuk" class="tab-content space-y-4">
      
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-083</span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-md">Baru</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Sistem Manajemen Aset</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <span class="text-slate-700 font-semibold">PT Bangun Nusantara</span></p>
          <p class="text-xs text-slate-500 mt-2 max-w-2xl leading-relaxed">
            Aplikasi web untuk mengelola aset perusahaan termasuk inventarisasi, pelacakan, dan pelaporan.
          </p>
          <div class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-3">
            <span>⏰</span> Deadline: <strong class="text-slate-700">10 Sep 2024</strong>
          </div>
        </div>

        <div class="flex flex-col gap-2 min-w-[160px] w-full md:w-auto">
          <button class="w-full text-center px-4 py-2 border border-rose-200 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
            ✕ Tolak
          </button>
          <button class="w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
            ✓ Terima & Assign
          </button>
          <button class="w-full text-center px-4 py-2 border border-emerald-200 text-emerald-600 hover:bg-emerald-50 rounded-xl text-xs font-semibold transition flex items-center justify-center gap-1">
            <span>📲</span> Kirim Resi WA
          </button>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-082</span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-md">Baru</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Aplikasi Antrian Digital</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <span class="text-slate-700 font-semibold">Klinik Medika Sehat</span></p>
          <p class="text-xs text-slate-500 mt-2 max-w-2xl leading-relaxed">
            Sistem antrian berbasis web dan display layar untuk klinik dengan fitur notifikasi pasien.
          </p>
          <div class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-3">
            <span>⏰</span> Deadline: <strong class="text-slate-700">08 Sep 2024</strong>
          </div>
        </div>

        <div class="flex flex-col gap-2 min-w-[160px] w-full md:w-auto">
          <button class="w-full text-center px-4 py-2 border border-rose-200 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
            ✕ Tolak
          </button>
          <button class="w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
            ✓ Terima & Assign
          </button>
          <button class="w-full text-center px-4 py-2 border border-emerald-200 text-emerald-600 hover:bg-emerald-50 rounded-xl text-xs font-semibold transition flex items-center justify-center gap-1">
            <span>📲</span> Kirim Resi WA
          </button>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-080</span>
            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
            <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-md">Baru</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">E-commerce Toko Online</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <span class="text-slate-700 font-semibold">Toko Elektronik Surya</span></p>
          <p class="text-xs text-slate-500 mt-2 max-w-2xl leading-relaxed">
            Platform belanja online lengkap dengan katalog produk, keranjang, dan integrasi payment gateway.
          </p>
          <div class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-3">
            <span>⏰</span> Deadline: <strong class="text-slate-700">15 Sep 2024</strong>
          </div>
        </div>

        <div class="flex flex-col gap-2 min-w-[160px] w-full md:w-auto">
          <button class="w-full text-center px-4 py-2 border border-rose-200 text-rose-500 hover:bg-rose-50 rounded-xl text-xs font-semibold transition">
            ✕ Tolak
          </button>
          <button class="w-full text-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold transition shadow-sm">
            ✓ Terima & Assign
          </button>
          <button class="w-full text-center px-4 py-2 border border-emerald-200 text-emerald-600 hover:bg-emerald-50 rounded-xl text-xs font-semibold transition flex items-center justify-center gap-1">
            <span>📲</span> Kirim Resi WA
          </button>
        </div>
      </div>

    </div>

    <!-- CONTENT 2: DALAM PENGERJAAN -->
    <div id="content-dalam-pengerjaan" class="tab-content hidden space-y-4">
      
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">ORD-2024-081</span>
              <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-md">In Progress</span>
            </div>
            <h3 class="text-base font-bold text-slate-800">Web Company Profile</h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <span class="text-slate-700 font-semibold">PT Maju Bersama</span></p>
          </div>
          <div class="text-left md:text-right mt-2 md:mt-0">
            <span class="text-[11px] text-slate-400">Worker</span>
            <p class="text-xs font-bold text-slate-800">Rizky Aditya (XI RPL 2)</p>
            <p class="text-[11px] text-slate-500">Deadline: 30 Agu 2024</p>
          </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-4">
          <div class="flex justify-between items-center text-xs font-semibold mb-1.5">
            <span class="text-slate-500">Progress</span>
            <span class="text-indigo-600 font-bold">65%</span>
          </div>
          <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-600 h-2 rounded-full" style="width: 65%"></div>
          </div>
        </div>

        <!-- Checklist Badges -->
        <div class="flex flex-wrap gap-2 pt-2">
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Riset & Wireframe</span>
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Desain UI (Figma)</span>
          <span class="bg-slate-50 text-slate-400 text-xs px-3 py-1.5 rounded-xl font-medium border border-slate-200">○ Pengembangan Frontend</span>
          <span class="bg-slate-50 text-slate-400 text-xs px-3 py-1.5 rounded-xl font-medium border border-slate-200">○ Integrasi CMS</span>
          <span class="bg-slate-50 text-slate-400 text-xs px-3 py-1.5 rounded-xl font-medium border border-slate-200">○ Testing & Review</span>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">ORD-2024-078</span>
              <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2.5 py-0.5 rounded-md">In Progress</span>
            </div>
            <h3 class="text-base font-bold text-slate-800">Sistem Absensi Siswa</h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <span class="text-slate-700 font-semibold">SMK Karya Bangsa</span></p>
          </div>
          <div class="text-left md:text-right mt-2 md:mt-0">
            <span class="text-[11px] text-slate-400">Worker</span>
            <p class="text-xs font-bold text-slate-800">Fajar Nugroho (XII RPL 1)</p>
            <p class="text-[11px] text-slate-500">Deadline: 02 Sep 2024</p>
          </div>
        </div>

        <!-- Progress Bar -->
        <div class="mb-4">
          <div class="flex justify-between items-center text-xs font-semibold mb-1.5">
            <span class="text-slate-500">Progress</span>
            <span class="text-indigo-600 font-bold">82%</span>
          </div>
          <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
            <div class="bg-indigo-600 h-2 rounded-full" style="width: 82%"></div>
          </div>
        </div>

        <!-- Checklist Badges -->
        <div class="flex flex-wrap gap-2 pt-2">
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Database Design</span>
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Backend API</span>
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Frontend Dashboard</span>
          <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1.5 rounded-xl font-medium border border-emerald-200">✓ Fitur QR Code</span>
          <span class="bg-slate-50 text-slate-400 text-xs px-3 py-1.5 rounded-xl font-medium border border-slate-200">○ Laporan & Export</span>
        </div>
      </div>

    </div>

    <!-- CONTENT 3: PENINJAUAN & QC -->
    <div id="content-peninjauan-qc" class="tab-content hidden space-y-4">
      
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start gap-6">
        <div class="flex-1">
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-079</span>
            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2.5 py-0.5 rounded-md">Menunggu QC</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Sistem Inventori</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">
            Klien: <span class="text-slate-700 font-semibold">CV Teknindo Jaya</span>
          </p>
          <p class="text-xs text-slate-500 font-medium mt-0.5">
            Worker: <span class="text-slate-800 font-semibold">Siti Nurhaliza (XII RPL 2)</span>
          </p>
          
          <p class="text-xs text-slate-500 mt-3 leading-relaxed">
            Aplikasi manajemen stok barang gudang dengan laporan real-time.
          </p>

          <div class="flex flex-wrap gap-2 mt-4">
            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-xl font-medium border border-emerald-200">✓ Analisis Kebutuhan</span>
            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-xl font-medium border border-emerald-200">✓ Desain Database</span>
            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-xl font-medium border border-emerald-200">✓ Pengembangan</span>
            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-xl font-medium border border-emerald-200">✓ Testing Internal</span>
            <span class="bg-emerald-100 text-emerald-700 text-xs px-3 py-1 rounded-xl font-medium border border-emerald-200">✓ Dokumentasi</span>
          </div>

          <a href="#" class="inline-flex items-center gap-1.5 text-xs text-indigo-600 hover:text-indigo-800 font-semibold mt-4">
            📎 Lihat Lampiran Hasil Kerja
          </a>
        </div>

        <div class="flex flex-col gap-2 min-w-[160px] w-full md:w-auto shrink-0">
          <button class="w-full text-center px-4 py-2.5 border border-amber-300 text-amber-600 hover:bg-amber-50 rounded-xl text-xs font-semibold transition flex items-center justify-center gap-1">
            <span>🔄</span> Revisi
          </button>
          <button class="w-full text-center px-4 py-2.5 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-semibold transition shadow-sm flex items-center justify-center gap-1">
            <span>✓</span> Approve QC
          </button>
        </div>
      </div>

    </div>

    <!-- CONTENT 4: PESANAN SELESAI -->
    <div id="content-pesanan-selesai" class="tab-content hidden space-y-4">
      
      <!-- Card 1 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-074</span>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-md">✓ Selesai & Lolos QC</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Landing Page Promosi</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">
            Klien: <span class="text-slate-700 font-semibold">UD Serba Ada</span> · Worker: <span class="text-slate-700 font-semibold">Dian Pratama (XI RPL 1)</span>
          </p>
        </div>
        <div class="text-left md:text-right">
          <p class="text-xs text-slate-400">Deadline: 22 Agu 2024</p>
          <p class="text-xs font-semibold text-emerald-600 mt-0.5">Selesai: 21 Agu 2024</p>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-070</span>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-md">✓ Selesai & Lolos QC</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Menu Digital QR</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">
            Klien: <span class="text-slate-700 font-semibold">Restoran Dapur Nusantara</span> · Worker: <span class="text-slate-700 font-semibold">Mega Putri (XII RPL 1)</span>
          </p>
        </div>
        <div class="text-left md:text-right">
          <p class="text-xs text-slate-400">Deadline: 15 Agu 2024</p>
          <p class="text-xs font-semibold text-emerald-600 mt-0.5">Selesai: 14 Agu 2024</p>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
          <div class="flex items-center gap-2 mb-1">
            <span class="text-xs font-semibold text-slate-400">ORD-2024-065</span>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-md">✓ Selesai & Lolos QC</span>
          </div>
          <h3 class="text-base font-bold text-slate-800">Website Event</h3>
          <p class="text-xs text-slate-500 font-medium mt-0.5">
            Klien: <span class="text-slate-700 font-semibold">Event Organizer Gemilang</span> · Worker: <span class="text-slate-700 font-semibold">Budi Santoso (XII RPL 2)</span>
          </p>
        </div>
        <div class="text-left md:text-right">
          <p class="text-xs text-slate-400">Deadline: 05 Agu 2024</p>
          <p class="text-xs font-semibold text-emerald-600 mt-0.5">Selesai: 04 Agu 2024</p>
        </div>
      </div>

    </div>

  </main>

  <!-- JAVASCRIPT UNTUK SWITCH TAB -->
  <script>
    function switchTab(tabId) {
      // Sembunyikan semua konten
      const contents = document.querySelectorAll('.tab-content');
      contents.forEach(content => content.classList.add('hidden'));

      // Tampilkan konten yang dipilih
      const activeContent = document.getElementById(`content-${tabId}`);
      if (activeContent) {
        activeContent.classList.remove('hidden');
      }

      // Reset gaya tombol semua tab
      const buttons = document.querySelectorAll('.tab-btn');
      buttons.forEach(btn => {
        btn.className = 'tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition';
        const badge = btn.querySelector('span:last-child');
        if(badge) {
          badge.className = 'bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full';
        }
      });

      // Set gaya tombol tab aktif
      const activeBtn = document.getElementById(`tab-${tabId}`);
      if (activeBtn) {
        activeBtn.className = 'tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-indigo-600 text-white shadow-md shadow-indigo-600/20 transition';
        const badge = activeBtn.querySelector('span:last-child');
        if(badge) {
          badge.className = 'bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full';
        }
      }
    }
  </script>

  

  
@endsection