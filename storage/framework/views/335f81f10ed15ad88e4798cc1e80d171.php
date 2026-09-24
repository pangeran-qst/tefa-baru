<?php $__env->startSection('title', 'Produk / Layanan'); ?>

<?php $__env->startSection('content'); ?>

  
  

  
  <title>Data Worker - Admin Jurusan RPL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  


  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title & Action Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">CMS Katalog Jurusan</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola produk & jasa yang tersedia di katalog TeFA</p>
      </div>
      <button class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-md shadow-indigo-600/20 transition flex items-center justify-center gap-1.5 self-start sm:self-auto">
        <span>+</span> Tambah Produk/Jasa
      </button>
    </div>

    <!-- CATEGORY FILTER BUTTONS -->
    <div class="flex items-center gap-2 overflow-x-auto pb-2 mb-8">
      <button onclick="filterCategory('all', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-indigo-600 text-white shadow-sm transition whitespace-nowrap">
        Semua
      </button>
      <button onclick="filterCategory('frontend', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap">
        Frontend Development
      </button>
      <button onclick="filterCategory('fullstack', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap">
        Fullstack Development
      </button>
      <button onclick="filterCategory('uiux', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap">
        UI/UX Design
      </button>
      <button onclick="filterCategory('mobile', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap">
        Mobile Development
      </button>
      <button onclick="filterCategory('graphic', this)" class="category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap">
        Graphic Design
      </button>
    </div>

    <!-- PRODUCTS GRID -->
    <div id="productGrid" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      
      <!-- Product 1: Frontend Development -->
      <div class="product-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between" data-category="frontend">
        <div>
          <!-- Thumbnail & Tag Header -->
          <div class="relative h-48 bg-slate-900 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=800&q=80" alt="Web Company Profile" class="w-full h-full object-cover opacity-80">
            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] px-3 py-1 rounded-md font-medium">
              Frontend Development
            </span>
            <span class="absolute top-3 right-3 bg-emerald-100 text-emerald-700 text-[11px] font-semibold px-3 py-1 rounded-full shadow-sm">
              Aktif
            </span>
          </div>

          <!-- Content Body -->
          <div class="p-5">
            <div class="flex items-start justify-between gap-2 mb-1">
              <h3 class="font-bold text-slate-800 text-base">Web Company Profile</h3>
              <span class="font-bold text-indigo-600 text-sm whitespace-nowrap">Rp 1.500.000</span>
            </div>
            <p class="text-[11px] text-slate-400 font-mono mb-3">PRD-001</p>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
              Website profil perusahaan modern, responsif, dengan CMS sederhana dan animasi profesional.
            </p>
            
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium cursor-pointer hover:text-slate-700">
              <span>📋</span>
              <span>5 Milestone Checklist</span>
              <span class="text-[10px]">▼</span>
            </div>
          </div>
        </div>

        <!-- Card Footer / Actions -->
        <div class="px-5 pb-5 pt-2 grid grid-cols-3 gap-2 border-t border-slate-50">
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>🔲</span> Portofolio
          </button>
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>✏️</span> Edit
          </button>
          <button class="py-2 px-3 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-semibold transition">
            Nonaktifkan
          </button>
        </div>
      </div>

      <!-- Product 2: Fullstack Development -->
      <div class="product-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between" data-category="fullstack">
        <div>
          <!-- Thumbnail & Tag Header -->
          <div class="relative h-48 bg-slate-900 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=800&q=80" alt="Sistem Manajemen Inventori" class="w-full h-full object-cover opacity-80">
            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] px-3 py-1 rounded-md font-medium">
              Fullstack Development
            </span>
            <span class="absolute top-3 right-3 bg-emerald-100 text-emerald-700 text-[11px] font-semibold px-3 py-1 rounded-full shadow-sm">
              Aktif
            </span>
          </div>

          <!-- Content Body -->
          <div class="p-5">
            <div class="flex items-start justify-between gap-2 mb-1">
              <h3 class="font-bold text-slate-800 text-base">Sistem Manajemen Inventori</h3>
              <span class="font-bold text-indigo-600 text-sm whitespace-nowrap">Rp 3.500.000</span>
            </div>
            <p class="text-[11px] text-slate-400 font-mono mb-3">PRD-002</p>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
              Aplikasi manajemen stok barang dengan laporan real-time, barcode scan, dan multi-user.
            </p>
            
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium cursor-pointer hover:text-slate-700">
              <span>📋</span>
              <span>5 Milestone Checklist</span>
              <span class="text-[10px]">▼</span>
            </div>
          </div>
        </div>

        <!-- Card Footer / Actions -->
        <div class="px-5 pb-5 pt-2 grid grid-cols-3 gap-2 border-t border-slate-50">
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>🔲</span> Portofolio
          </button>
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>✏️</span> Edit
          </button>
          <button class="py-2 px-3 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-semibold transition">
            Nonaktifkan
          </button>
        </div>
      </div>

      <!-- Product 3: UI/UX Design -->
      <div class="product-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between" data-category="uiux">
        <div>
          <!-- Thumbnail & Tag Header -->
          <div class="relative h-48 bg-slate-900 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1581291518633-83b4ebd1d83e?auto=format&fit=crop&w=800&q=80" alt="Desain UI/UX Aplikasi" class="w-full h-full object-cover opacity-80">
            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] px-3 py-1 rounded-md font-medium">
              UI/UX Design
            </span>
            <span class="absolute top-3 right-3 bg-emerald-100 text-emerald-700 text-[11px] font-semibold px-3 py-1 rounded-full shadow-sm">
              Aktif
            </span>
          </div>

          <!-- Content Body -->
          <div class="p-5">
            <div class="flex items-start justify-between gap-2 mb-1">
              <h3 class="font-bold text-slate-800 text-base">Desain UI/UX Aplikasi</h3>
              <span class="font-bold text-indigo-600 text-sm whitespace-nowrap">Rp 800.000</span>
            </div>
            <p class="text-[11px] text-slate-400 font-mono mb-3">PRD-003</p>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
              Paket desain lengkap meliputi research, wireframe, prototype interaktif di Figma.
            </p>
            
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium cursor-pointer hover:text-slate-700">
              <span>📋</span>
              <span>5 Milestone Checklist</span>
              <span class="text-[10px]">▼</span>
            </div>
          </div>
        </div>

        <!-- Card Footer / Actions -->
        <div class="px-5 pb-5 pt-2 grid grid-cols-3 gap-2 border-t border-slate-50">
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>🔲</span> Portofolio
          </button>
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>✏️</span> Edit
          </button>
          <button class="py-2 px-3 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-semibold transition">
            Nonaktifkan
          </button>
        </div>
      </div>

      <!-- Product 4: Mobile Development (Non-aktif Status) -->
      <div class="product-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between" data-category="mobile">
        <div>
          <!-- Thumbnail & Tag Header -->
          <div class="relative h-48 bg-slate-900 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80" alt="Aplikasi Mobile Flutter" class="w-full h-full object-cover opacity-80">
            <span class="absolute top-3 left-3 bg-slate-900/80 backdrop-blur-md text-white text-[11px] px-3 py-1 rounded-md font-medium">
              Mobile Development
            </span>
            <span class="absolute top-3 right-3 bg-rose-100 text-rose-700 text-[11px] font-semibold px-3 py-1 rounded-full shadow-sm">
              Non-aktif
            </span>
          </div>

          <!-- Content Body -->
          <div class="p-5">
            <div class="flex items-start justify-between gap-2 mb-1">
              <h3 class="font-bold text-slate-800 text-base">Aplikasi Mobile Flutter</h3>
              <span class="font-bold text-indigo-600 text-sm whitespace-nowrap">Rp 5.000.000</span>
            </div>
            <p class="text-[11px] text-slate-400 font-mono mb-3">PRD-004</p>
            <p class="text-xs text-slate-500 leading-relaxed mb-4">
              Pengembangan aplikasi Android/iOS menggunakan Flutter dengan integrasi Firebase.
            </p>
            
            <div class="flex items-center gap-1.5 text-xs text-slate-500 font-medium cursor-pointer hover:text-slate-700">
              <span>📋</span>
              <span>5 Milestone Checklist</span>
              <span class="text-[10px]">▼</span>
            </div>
          </div>
        </div>

        <!-- Card Footer / Actions -->
        <div class="px-5 pb-5 pt-2 grid grid-cols-3 gap-2 border-t border-slate-50">
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>🔲</span> Portofolio
          </button>
          <button class="py-2 px-3 border border-slate-200 text-slate-600 hover:bg-slate-50 rounded-xl text-xs font-semibold flex items-center justify-center gap-1 transition">
            <span>✏️</span> Edit
          </button>
          <button class="py-2 px-3 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-xl text-xs font-semibold transition">
            Aktifkan
          </button>
        </div>
      </div>

    </div>

    <!-- EMPTY STATE -->
    <div id="emptyState" class="hidden text-center py-16 bg-white rounded-2xl border border-slate-200/80 shadow-sm">
      <div class="text-4xl mb-3">📁</div>
      <h3 class="text-slate-700 font-bold text-sm">Belum Ada Produk</h3>
      <p class="text-slate-400 text-xs mt-1">Belum ada layanan yang ditambahkan pada kategori ini.</p>
    </div>

  </main>

  <!-- JAVASCRIPT FILTER KATEGORI -->
  <script>
    function filterCategory(category, element) {
      const buttons = document.querySelectorAll('.category-btn');
      buttons.forEach(btn => {
        btn.className = 'category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-white text-slate-600 border border-slate-200 hover:bg-slate-50 transition whitespace-nowrap';
      });

      element.className = 'category-btn px-5 py-2 rounded-xl text-xs font-semibold bg-indigo-600 text-white shadow-sm transition whitespace-nowrap';

      const cards = document.querySelectorAll('.product-card');
      let visibleCount = 0;

      cards.forEach(card => {
        const cardCategory = card.getAttribute('data-category');
        if (category === 'all' || cardCategory === category) {
          card.style.display = 'flex';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });

      const emptyState = document.getElementById('emptyState');
      if (visibleCount === 0) {
        emptyState.classList.remove('hidden');
      } else {
        emptyState.classList.add('hidden');
      }
    }
  </script>

  

  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.jurusan.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/jurusan/katalog/index.blade.php ENDPATH**/ ?>