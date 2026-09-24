<?php $__env->startSection('title', 'Produk / Layanan'); ?>

<?php $__env->startSection('content'); ?>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- SIDEBAR -->


  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title Section -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-900 mb-1">Analitik &amp; Market Insights</h1>
      <p class="text-xs text-slate-500">Data intelijen pasar untuk pengambilan keputusan strategis TeFA</p>
    </div>

    <!-- ROW 1: TERPOPULER & SEARCH KEYWORD -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 mb-6">
      
      <!-- Produk & Jasa Terpopuler -->
      <div class="lg:col-span-7 bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80">
        <div class="mb-5">
          <h3 class="text-sm font-semibold text-slate-900">Produk &amp; Jasa Terpopuler</h3>
          <p class="text-xs text-slate-400">Most Viewed vs Best Seller dari seluruh jurusan</p>
        </div>
        <div class="relative h-[250px] w-full">
          <canvas id="chartPopular"></canvas>
        </div>
      </div>

      <!-- Search Keyword Analytics -->
      <div class="lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80">
        <div class="mb-5">
          <h3 class="text-sm font-semibold text-slate-900">Search Keyword Analytics</h3>
          <p class="text-xs text-slate-400">Kata kunci pengunjung publik</p>
        </div>
        
        <div class="flex flex-col gap-3">
          
          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">1</span>
              <span class="text-xs text-slate-700 font-medium">website sekolah</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">48×</span>
              <span class="bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">2</span>
              <span class="text-xs text-slate-700 font-medium">desain logo murah</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">31×</span>
              <span class="bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">3</span>
              <span class="text-xs text-slate-700 font-medium">aplikasi absensi</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">27×</span>
              <span class="bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">4</span>
              <span class="text-xs text-slate-700 font-medium">edit video</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">21×</span>
              <span class="bg-red-100 text-red-500 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Tidak ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">5</span>
              <span class="text-xs text-slate-700 font-medium">animasi explainer</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">18×</span>
              <span class="bg-red-100 text-red-500 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Tidak ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">6</span>
              <span class="text-xs text-slate-700 font-medium">sistem kasir</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">15×</span>
              <span class="bg-red-100 text-red-500 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Tidak ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5 border-b border-dashed border-slate-100">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">7</span>
              <span class="text-xs text-slate-700 font-medium">mobile app android</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">14×</span>
              <span class="bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Ada</span>
            </div>
          </div>

          <div class="flex items-center justify-between py-1.5">
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-400 w-4">8</span>
              <span class="text-xs text-slate-700 font-medium">ui ux figma</span>
            </div>
            <div class="flex items-center gap-3">
              <span class="text-xs text-slate-500 font-semibold">11×</span>
              <span class="bg-emerald-100 text-emerald-600 px-2.5 py-0.5 rounded-full text-[11px] font-semibold">Ada</span>
            </div>
          </div>

        </div>
      </div>

    </div>

    <!-- ROW 2: PERFORMA JURUSAN & MARKET FEEDBACK -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      
      <!-- Performa Antar Jurusan -->
      <div class="lg:col-span-7 bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80">
        <div class="mb-5">
          <h3 class="text-sm font-semibold text-slate-900">Performa Antar Jurusan</h3>
          <p class="text-xs text-slate-400">Pendapatan (juta Rp) vs Kecepatan Pengerjaan (hari)</p>
        </div>
        <div class="relative h-[250px] w-full">
          <canvas id="chartJurusan"></canvas>
        </div>
      </div>

      <!-- Market Feedback & Rating -->
      <div class="lg:col-span-5 bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 flex flex-col justify-between">
        <div>
          <div class="mb-5">
            <h3 class="text-sm font-semibold text-slate-900">Market Feedback &amp; Rating</h3>
            <p class="text-xs text-slate-400">Tingkat kepuasan klien — Total 70 ulasan</p>
          </div>

          <div class="flex flex-col gap-3.5 mb-6">
            
            <div class="flex flex-col gap-1">
              <div class="flex justify-between text-xs">
                <span class="text-slate-700 font-semibold">Sangat Puas</span>
                <span class="text-slate-500">38 (54%)</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-emerald-500 rounded-full" style="width: 54%;"></div>
              </div>
            </div>

            <div class="flex flex-col gap-1">
              <div class="flex justify-between text-xs">
                <span class="text-slate-700 font-semibold">Puas</span>
                <span class="text-slate-500">21 (30%)</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-indigo-600 rounded-full" style="width: 30%;"></div>
              </div>
            </div>

            <div class="flex flex-col gap-1">
              <div class="flex justify-between text-xs">
                <span class="text-slate-700 font-semibold">Cukup Puas</span>
                <span class="text-slate-500">9 (13%)</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-amber-500 rounded-full" style="width: 13%;"></div>
              </div>
            </div>

            <div class="flex flex-col gap-1">
              <div class="flex justify-between text-xs">
                <span class="text-slate-700 font-semibold">Tidak Puas</span>
                <span class="text-slate-500">2 (3%)</span>
              </div>
              <div class="w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full bg-red-500 rounded-full" style="width: 3%;"></div>
              </div>
            </div>

          </div>
        </div>

        <!-- Rating Summary Footer -->
        <div class="flex items-center gap-3 pt-4 border-t border-slate-100">
          <div class="text-3xl font-bold text-slate-900">4.7</div>
          <div>
            <div class="text-amber-500 text-base tracking-widest">★★★★★</div>
            <div class="text-[11px] text-slate-400">Rating rata-rata</div>
          </div>
        </div>
      </div>

    </div>

  </main>

  <!-- SCRIPT CHART.JS -->
  <script>
    // 1. Chart Produk & Jasa Terpopuler
    const ctxPopular = document.getElementById('chartPopular').getContext('2d');
    new Chart(ctxPopular, {
      type: 'bar',
      data: {
        labels: ['UI/UX Design', 'Web Dev', 'Mobile App', 'API Service', 'QA Testing', 'Desain Logo'],
        datasets: [
          {
            label: 'Dilihat',
            data: [142, 118, 90, 54, 38, 60],
            backgroundColor: '#c7d2fe',
            borderRadius: 4
          },
          {
            label: 'Dipesan',
            data: [24, 18, 13, 7, 5, 8],
            backgroundColor: '#4f46e5',
            borderRadius: 4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
          x: { grid: { display: false } }
        }
      }
    });

    // 2. Chart Performa Antar Jurusan
    const ctxJurusan = document.getElementById('chartJurusan').getContext('2d');
    new Chart(ctxJurusan, {
      type: 'bar',
      data: {
        labels: ['RPL', 'DKV', 'PSPT', 'TKJ', 'GIM', 'ANIMASI'],
        datasets: [
          {
            label: 'Pendapatan (Jt)',
            data: [19, 12, 4.5, 3.8, 2.5, 2],
            backgroundColor: '#4f46e5',
            borderRadius: 4
          },
          {
            label: 'Kecepatan (Hari)',
            data: [6.5, 6, 7, 6.5, 7.5, 8],
            backgroundColor: '#10b981',
            borderRadius: 4
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { position: 'bottom' }
        },
        scales: {
          y: { beginAtZero: true, grid: { color: '#f1f5f9' } },
          x: { grid: { display: false } }
        }
      }
    });
  </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.tefa.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa/resources/views/admin/tefa/analitik.blade.php ENDPATH**/ ?>