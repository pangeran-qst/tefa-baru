<?php $__env->startSection('title', 'Dashboard Admin TEFA'); ?>

<?php $__env->startSection('content'); ?>
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    <!-- Header Area -->
    <div class="flex justify-between items-start mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola akun dan lihat bagan organisasi TeFA</p>
      </div>
      <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition">
        + Tambah Pengguna
      </button>
    </div>

    <!-- Main Navigation Tabs -->
    <div class="flex items-center bg-slate-200/60 p-1 rounded-xl w-fit mb-6 text-xs font-semibold text-slate-600">
      <button id="tab-kelola" onclick="switchTab('kelola')" class="px-5 py-2 rounded-lg bg-indigo-600 text-white shadow-sm transition">
        Kelola Akun
      </button>
      <button id="tab-bagan" onclick="switchTab('bagan')" class="px-5 py-2 rounded-lg hover:text-slate-900 transition">
        Bagan Organisasi
      </button>
    </div>

    <!-- VIEW 1: KELOLA AKUN -->
    <div id="view-kelola-akun" class="space-y-6">
      <!-- Sub-filter Role -->
      <div class="flex gap-2 text-xs font-semibold">
        <button onclick="filterRole('all')" class="filter-btn bg-indigo-600 text-white px-4 py-2 rounded-xl transition shadow-sm">Semua</button>
        <button onclick="filterRole('Admin TeFA')" class="filter-btn bg-white hover:bg-slate-100 text-slate-600 px-4 py-2 rounded-xl border border-slate-200 transition">Admin TeFA</button>
        <button onclick="filterRole('Admin Jurusan')" class="filter-btn bg-white hover:bg-slate-100 text-slate-600 px-4 py-2 rounded-xl border border-slate-200 transition">Admin Jurusan</button>
        <button onclick="filterRole('Worker/Siswa')" class="filter-btn bg-white hover:bg-slate-100 text-slate-600 px-4 py-2 rounded-xl border border-slate-200 transition">Worker/Siswa</button>
      </div>

      <!-- Table Container -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <table class="w-full text-left text-xs">
          <thead class="bg-slate-50/50 border-b border-slate-200 text-slate-400 uppercase font-semibold">
            <tr>
              <th class="py-4 px-6">Nama Lengkap</th>
              <th class="py-4 px-4">Username</th>
              <th class="py-4 px-4">Role</th>
              <th class="py-4 px-4">Jurusan</th>
              <th class="py-4 px-4">Status</th>
              <th class="py-4 px-4">Login Terakhir</th>
              <th class="py-4 px-6 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody id="user-table-body" class="divide-y divide-slate-100 text-slate-600 font-medium">
            <!-- Rendered by JS -->
          </tbody>
        </table>
      </div>
    </div>

    <!-- VIEW 2: BAGAN ORGANISASI -->
    <div id="view-bagan-organisasi" class="hidden bg-white p-8 rounded-2xl border border-slate-200/80 shadow-sm">
      <h2 class="text-center font-bold text-slate-700 tracking-wide text-xs mb-10 uppercase">
        Struktur Organisasi Teaching Factory — SMKN 4 Tanjungpinang
      </h2>

      <div class="flex flex-col items-center">
        <!-- Top Leader -->
        <div class="bg-indigo-600 text-white text-center px-8 py-4 rounded-2xl shadow-md min-w-[200px]">
          <p class="text-xs opacity-80">Ketua TeFA</p>
          <p class="font-bold text-sm">Bu Neni, S.Pd</p>
        </div>

        <!-- Vertical Connector Line -->
        <div class="w-0.5 h-8 bg-slate-300"></div>

        <!-- Horizontal Connector Line -->
        <div class="w-full max-w-4xl border-t-2 border-slate-300 relative"></div>

        <!-- Departments Grid -->
        <div class="grid grid-cols-6 gap-4 w-full max-w-5xl mt-8">
          <!-- RPL -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">RPL</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Ahmad Fauzi</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">12</p>
            </div>
          </div>

          <!-- DKV -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">DKV</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Sari Dewi</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">10</p>
            </div>
          </div>

          <!-- PSPT -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">PSPT</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Rudi Hartono</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">8</p>
            </div>
          </div>

          <!-- TKJ -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">TKJ</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Rina Susanti</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">9</p>
            </div>
          </div>

          <!-- GIM -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">GIM</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Eko Prasetyo</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">7</p>
            </div>
          </div>

          <!-- ANIMASI -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">ANIMASI</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Dewi Kartika</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">6</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script>
    const users = [
      { name: 'Bu Neni, S.Pd', username: 'bu.neni', role: 'Admin TeFA', jurusan: 'TeFA', status: 'Aktif', login: '25 Agu 2026, 08:42', avatarBg: 'bg-purple-500' },
      { name: 'Bpk. Ahmad Fauzi, S.Pd', username: 'ahmad.fauzi', role: 'Admin Jurusan', jurusan: 'RPL', status: 'Aktif', login: '25 Agu 2026, 09:12', avatarBg: 'bg-blue-600' },
      { name: 'Ibu Sari Dewi, S.Ds', username: 'sari.dewi', role: 'Admin Jurusan', jurusan: 'DKV', status: 'Aktif', login: '24 Agu 2026, 15:30', avatarBg: 'bg-indigo-600' },
      { name: 'Bpk. Rudi Hartono, S.Pd', username: 'rudi.hartono', role: 'Admin Jurusan', jurusan: 'PSPT', status: 'Aktif', login: '23 Agu 2026, 10:05', avatarBg: 'bg-blue-600' },
      { name: 'Ibu Rina Susanti, S.Kom', username: 'rina.susanti', role: 'Admin Jurusan', jurusan: 'TKJ', status: 'Aktif', login: '25 Agu 2026, 07:55', avatarBg: 'bg-indigo-600' },
      { name: 'Bpk. Eko Prasetyo, S.T', username: 'eko.prasetyo', role: 'Admin Jurusan', jurusan: 'GIM', status: 'Aktif', login: '22 Agu 2026, 14:20', avatarBg: 'bg-blue-600' },
      { name: 'Ibu Dewi Kartika, S.Sn', username: 'dewi.kartika', role: 'Admin Jurusan', jurusan: 'ANIMASI', status: 'Nonaktif', login: '10 Agu 2026, 09:00', avatarBg: 'bg-indigo-600' },
      { name: 'Rizky Firmansyah', username: 'rizky.f', role: 'Worker/Siswa', jurusan: 'RPL', status: 'Aktif', login: '25 Agu 2026, 10:30', avatarBg: 'bg-emerald-600' },
      { name: 'Siti Nurhaliza', username: 'siti.n', role: 'Worker/Siswa', jurusan: 'DKV', status: 'Aktif', login: '25 Agu 2026, 11:00', avatarBg: 'bg-emerald-600' },
      { name: 'Budi Santoso', username: 'budi.s', role: 'Worker/Siswa', jurusan: 'RPL', status: 'Aktif', login: '24 Agu 2026, 16:45', avatarBg: 'bg-emerald-600' }
    ];

    function renderTable(data) {
      const tbody = document.getElementById('user-table-body');
      tbody.innerHTML = data.map(u => `
        <tr class="hover:bg-slate-50/80 transition-colors">
          <td class="py-4 px-6 flex items-center gap-3">
            <div class="w-8 h-8 rounded-full ${u.avatarBg} text-white font-bold flex items-center justify-center text-xs">
              ${u.name.charAt(0)}
            </div>
            <span class="font-semibold text-slate-800">${u.name}</span>
          </td>
          <td class="py-4 px-4 text-slate-500">${u.username}</td>
          <td class="py-4 px-4">
            <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold 
              ${u.role === 'Admin TeFA' ? 'bg-purple-100 text-purple-700' : 
                u.role === 'Admin Jurusan' ? 'bg-blue-100 text-blue-700' : 'bg-emerald-100 text-emerald-700'}">
              ${u.role}
            </span>
          </td>
          <td class="py-4 px-4">
            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-indigo-600">
              ${u.jurusan}
            </span>
          </td>
          <td class="py-4 px-4">
            <span class="font-bold ${u.status === 'Aktif' ? 'text-emerald-600' : 'text-slate-400'}">
              ${u.status}
            </span>
          </td>
          <td class="py-4 px-4 text-slate-400">${u.login}</td>
          <td class="py-4 px-6 text-center space-x-2">
            <button class="px-3 py-1 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs transition">Edit</button>
            <button class="px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs transition">Hapus</button>
          </td>
        </tr>
      `).join('');
    }

    function switchTab(tab) {
      const kelolaView = document.getElementById('view-kelola-akun');
      const baganView = document.getElementById('view-bagan-organisasi');
      const tabKelola = document.getElementById('tab-kelola');
      const tabBagan = document.getElementById('tab-bagan');

      if (tab === 'kelola') {
        kelolaView.classList.remove('hidden');
        baganView.classList.add('hidden');
        tabKelola.className = "px-5 py-2 rounded-lg bg-indigo-600 text-white shadow-sm transition";
        tabBagan.className = "px-5 py-2 rounded-lg hover:text-slate-900 transition";
      } else {
        kelolaView.classList.add('hidden');
        baganView.classList.remove('hidden');
        tabBagan.className = "px-5 py-2 rounded-lg bg-indigo-600 text-white shadow-sm transition";
        tabKelola.className = "px-5 py-2 rounded-lg hover:text-slate-900 transition";
      }
    }

    function filterRole(role) {
      const buttons = document.querySelectorAll('.filter-btn');
      buttons.forEach(btn => {
        if (btn.textContent.trim() === (role === 'all' ? 'Semua' : role)) {
          btn.className = "filter-btn bg-indigo-600 text-white px-4 py-2 rounded-xl transition shadow-sm";
        } else {
          btn.className = "filter-btn bg-white hover:bg-slate-100 text-slate-600 px-4 py-2 rounded-xl border border-slate-200 transition";
        }
      });

      if (role === 'all') {
        renderTable(users);
      } else {
        renderTable(users.filter(u => u.role === role));
      }
    }

    renderTable(users);
  </script>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.tefa.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/tefa/pengguna.blade.php ENDPATH**/ ?>