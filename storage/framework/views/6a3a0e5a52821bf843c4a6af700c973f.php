<?php $__env->startSection('title', 'Produk / Layanan'); ?>

<?php $__env->startSection('content'); ?>

  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    <!-- Title Header -->
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-slate-800">Manajemen Pesanan</h1>
      <p class="text-xs text-slate-500 mt-1">Kelola alur masuk, verifikasi, disposisi, dan penyelesaian pesanan</p>
    </div>

    <!-- Filter Tabs Navigation -->
    <?php
    $jumlahPesananBaru = $pesanans->where('status', 'pending')->count();
    $jumlahMenungguRespons = $pesanans->where('status', 'waiting_response')->count();
    $jumlahDalamPengerjaan = $pesanans->where('status', 'in_progress')->count();
    $jumlahSelesai = $pesanans->where('status', 'completed')->count();
    $jumlahDibatalkan = $pesanans->where('status', 'cancelled')->count();
    ?>

    <div class="flex flex-wrap gap-3 mb-6">

      
      <button
          type="button"
          id="btn-baru"
          onclick="switchTab('baru')"
          class="tab-btn px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold text-xs shadow-sm transition">
          Pesanan Baru
          <span class="ml-1 opacity-90">
              <?php echo e($jumlahPesananBaru); ?>

          </span>
      </button>

      
      <button
          type="button"
          id="btn-menunggu"
          onclick="switchTab('menunggu')"
          class="tab-btn px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
          Menunggu Respons
          <span class="ml-1 text-slate-400">
              <?php echo e($jumlahMenungguRespons); ?>

          </span>
      </button>

      
      <button
          type="button"
          id="btn-pengerjaan"
          onclick="switchTab('pengerjaan')"
          class="tab-btn px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
          Dalam Pengerjaan
          <span class="ml-1 text-slate-400">
              <?php echo e($jumlahDalamPengerjaan); ?>

          </span>
      </button>

      
      <button
          type="button"
          id="btn-selesai"
          onclick="switchTab('selesai')"
          class="tab-btn px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
          Selesai
          <span class="ml-1 text-slate-400">
              <?php echo e($jumlahSelesai); ?>

          </span>
      </button>

      
      <button
          type="button"
          id="btn-ditolak"
          onclick="switchTab('ditolak')"
          class="tab-btn px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition">
          Ditolak/Batal
          <span class="ml-1 text-slate-400">
              <?php echo e($jumlahDibatalkan); ?>

          </span>
      </button>

  </div>

    <!-- TAB 1: PESANAN BARU -->
    <div id="tab-baru" class="tab-content">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-4 px-3">ID Pesanan</th>
                        <th class="py-4 px-3">Klien</th>
                        <th class="py-4 px-3">Layanan</th>
                        <th class="py-4 px-3">Tanggal</th>
                        <th class="py-4 px-3">Nilai</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $pesanans->where('status', 'pending'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50 transition">

                            
                            <td class="py-3.5 px-3">
                                <span class="font-bold text-indigo-600">
                                    #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </td>

                            
                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->nama_pemesan); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->email_pemesan); ?>

                                </div>
                            </td>

                            
                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->tefa->jurusan ?? '-'); ?>

                                </div>
                            </td>

                            
                            <td class="py-3.5 px-3 text-slate-600">
                                <?php echo e($pesanan->tanggal_pesan?->format('d M Y')); ?>


                                <div class="text-[10px] text-slate-400">
                                    <?php echo e($pesanan->tanggal_pesan?->format('H:i')); ?>

                                </div>
                            </td>

                            
                            <td class="py-3.5 px-3">
                                <span class="font-semibold text-slate-800">
                                    Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                                </span>
                            </td>

                            
                            <td class="py-3.5 px-3">
                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 font-semibold text-[10px]">
                                    Pending
                                </span>
                            </td>

                            
                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-2">

                                    <form
                                        action="<?php echo e(route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)); ?>"
                                        method="GET">

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                            Detail
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Belum ada pesanan baru.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>


    <!-- TAB 2: MENUNGGU RESPONS -->
    <div id="tab-menunggu" class="tab-content hidden">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-4 px-3">ID Pesanan</th>
                        <th class="py-4 px-3">Klien</th>
                        <th class="py-4 px-3">Layanan</th>
                        <th class="py-4 px-3">Tanggal</th>
                        <th class="py-4 px-3">Nilai</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $pesanans->where('status', 'waiting_response'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50 transition">

                            <td class="py-3.5 px-3">
                                <span class="font-bold text-indigo-600">
                                    #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->nama_pemesan); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->email_pemesan); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->tefa->jurusan ?? '-'); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3 text-slate-600">
                                <?php echo e($pesanan->tanggal_pesan?->format('d M Y')); ?>


                                <div class="text-[10px] text-slate-400">
                                    <?php echo e($pesanan->tanggal_pesan?->format('H:i')); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="font-semibold text-slate-800">
                                    Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 font-semibold text-[10px]">
                                    Menunggu Respons
                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-2">

                                    <form
                                        action="<?php echo e(route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)); ?>"
                                        method="GET">

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                            Detail
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Belum ada pesanan yang menunggu respons.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>


    <!-- TAB 3: DALAM PENGERJAAN -->
    <div id="tab-pengerjaan" class="tab-content hidden">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-4 px-3">ID Pesanan</th>
                        <th class="py-4 px-3">Klien</th>
                        <th class="py-4 px-3">Layanan</th>
                        <th class="py-4 px-3">Tanggal</th>
                        <th class="py-4 px-3">Nilai</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $pesanans->where('status', 'in_progress'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50 transition">

                            <td class="py-3.5 px-3">
                                <span class="font-bold text-indigo-600">
                                    #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->nama_pemesan); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->email_pemesan); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->tefa->jurusan ?? '-'); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3 text-slate-600">
                                <?php echo e($pesanan->tanggal_pesan?->format('d M Y')); ?>


                                <div class="text-[10px] text-slate-400">
                                    <?php echo e($pesanan->tanggal_pesan?->format('H:i')); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="font-semibold text-slate-800">
                                    Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-purple-50 text-purple-600 font-semibold text-[10px]">
                                    Dalam Pengerjaan
                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-2">

                                    <form
                                        action="<?php echo e(route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)); ?>"
                                        method="GET">

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                            Detail
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Belum ada pesanan yang sedang dikerjakan.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>


    <!-- TAB 4: SELESAI -->
    <div id="tab-selesai" class="tab-content hidden">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-4 px-3">ID Pesanan</th>
                        <th class="py-4 px-3">Klien</th>
                        <th class="py-4 px-3">Layanan</th>
                        <th class="py-4 px-3">Tanggal</th>
                        <th class="py-4 px-3">Nilai</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $pesanans->where('status', 'completed'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50 transition">

                            <td class="py-3.5 px-3">
                                <span class="font-bold text-indigo-600">
                                    #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->nama_pemesan); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->email_pemesan); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->tefa->jurusan ?? '-'); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3 text-slate-600">
                                <?php echo e($pesanan->tanggal_pesan?->format('d M Y')); ?>


                                <div class="text-[10px] text-slate-400">
                                    <?php echo e($pesanan->tanggal_pesan?->format('H:i')); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="font-semibold text-slate-800">
                                    Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">
                                    Selesai
                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-2">

                                    <form
                                        action="<?php echo e(route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)); ?>"
                                        method="GET">

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                            Detail
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Belum ada pesanan yang selesai.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>


    <!-- TAB 5: DITOLAK / BATAL -->
    <div id="tab-ditolak" class="tab-content hidden">
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">

            <table class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
                    <tr>
                        <th class="py-4 px-3">ID Pesanan</th>
                        <th class="py-4 px-3">Klien</th>
                        <th class="py-4 px-3">Layanan</th>
                        <th class="py-4 px-3">Tanggal</th>
                        <th class="py-4 px-3">Nilai</th>
                        <th class="py-4 px-3">Status</th>
                        <th class="py-4 px-3 text-right">Aksi</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $pesanans->where('status', 'cancelled'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pesanan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr class="hover:bg-slate-50 transition">

                            <td class="py-3.5 px-3">
                                <span class="font-bold text-indigo-600">
                                    #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->nama_pemesan); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->email_pemesan); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="font-semibold text-slate-800">
                                    <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    <?php echo e($pesanan->tefa->jurusan ?? '-'); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3 text-slate-600">
                                <?php echo e($pesanan->tanggal_pesan?->format('d M Y')); ?>


                                <div class="text-[10px] text-slate-400">
                                    <?php echo e($pesanan->tanggal_pesan?->format('H:i')); ?>

                                </div>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="font-semibold text-slate-800">
                                    Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>

                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <span class="inline-flex px-2.5 py-1 rounded-lg bg-red-50 text-red-600 font-semibold text-[10px]">
                                    Dibatalkan
                                </span>
                            </td>

                            <td class="py-3.5 px-3">
                                <div class="flex items-center justify-end gap-2">

                                    <form
                                        action="<?php echo e(route('admin.tefa.pesanan.detail', $pesanan->id_pesanan)); ?>"
                                        method="GET">

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                            Detail
                                        </button>

                                    </form>

                                </div>
                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>
                            <td colspan="7" class="py-12 text-center text-slate-400">
                                Belum ada pesanan yang ditolak atau dibatalkan.
                            </td>
                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>
    </div>

  </main>

  <!-- SCRIPT SWITCH TAB -->
  <script>
    function switchTab(tabId) {
      // Sembunyikan semua tab content
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      
      // Reset style semua tombol tab
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.className = "tab-btn px-4 py-2.5 rounded-xl text-xs font-semibold transition-all flex items-center gap-2 bg-white text-slate-600 border border-slate-200 hover:bg-slate-50";
        const badge = btn.querySelector('span');
        if (badge) badge.className = "bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full";
      });

      // Tampilkan tab terpilih
      document.getElementById('tab-' + tabId).classList.remove('hidden');

      // Set style tombol tab yang aktif
      const activeBtn = document.getElementById('btn-' + tabId);
      const activeBadge = activeBtn.querySelector('span');
      
      ///ngubah warna tab pada manajemen pesanan (pesanan baru, menunggu respon dll)
      const colorMap = {
        'baru': 'bg-blue-600 text-white shadow-sm',
        'menunggu': 'bg-blue-600 text-white shadow-sm',
        'pengerjaan': 'bg-blue-600 text-white shadow-sm',
        'selesai': 'bg-blue-600 text-white shadow-sm',
        'ditolak': 'bg-blue-600 text-white shadow-sm'
      };

      activeBtn.className = `tab-btn px-4 py-2.5 rounded-xl text-xs font-semibold transition-all flex items-center gap-2 ${colorMap[tabId]}`;
      if (activeBadge) activeBadge.className = "bg-white/20 text-white text-[10px] px-2 py-0.5 rounded-full";
    }
  </script>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.tefa.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/tefa/pesanan/index.blade.php ENDPATH**/ ?>