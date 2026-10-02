<?php $__env->startSection('title', 'Produk / Layanan'); ?>

<?php $__env->startSection('content'); ?>

  
  

  
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
        <span></span> Pesanan Masuk
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo e($pesananMasuk->count()); ?></span>
      </button>

      <!-- Tab 2: Dalam Pengerjaan -->
      <button onclick="switchTab('dalam-pengerjaan')" id="tab-dalam-pengerjaan" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Dalam Pengerjaan
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo e($dalamPengerjaan->count()); ?></span>
      </button>

      <!-- Tab 3: Peninjauan & QC -->
      <button onclick="switchTab('peninjauan-qc')" id="tab-peninjauan-qc" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Peninjauan & QC
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo e($peninjauanQC->count()); ?></span>
      </button>

      <!-- Tab 4: Pesanan Selesai -->
      <button onclick="switchTab('pesanan-selesai')" id="tab-pesanan-selesai" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Pesanan Selesai
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full"><?php echo e($pesananSelesai->count()); ?></span>
      </button>

    </div>

    <!-- TAB CONTENTS -->

    <!-- CONTENT 1: PESANAN MASUK -->
    <div id="content-pesanan-masuk" class="tab-content space-y-4">
      
      <?php $__empty_1 = true; $__currentLoopData = $pesananMasuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-<?php echo e(str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT)); ?></span>
              <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
              <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-md">Baru</span>
            </div>

            <h3 class="text-base font-bold text-slate-800">
              <?php echo e($item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan Tidak Diketahui'); ?>

            </h3>

            <p class="text-xs text-slate-500 font-medium mt-0.5">
              Klien: <span class="text-slate-700 font-semibold"><?php echo e($item->nama_pemesan); ?></span>
              <?php if($item->no_hp_pemesan): ?>
                · <span class="text-slate-500"><?php echo e($item->no_hp_pemesan); ?></span>
              <?php endif; ?>
            </p>

            <p class="text-xs text-slate-500 mt-2 max-w-2xl leading-relaxed">
              <?php echo e($item->catatan_pesanan ?? $item->catatan ?? 'Tidak ada catatan khusus dari Admin TEFA / Klien.'); ?>

            </p>

            <div class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-3">
              <span>⏰</span> Tanggal Pesan: 
              <strong class="text-slate-700">
                <?php echo e($item->created_at ? $item->created_at->format('d M Y - H:i') : '-'); ?> WIB
              </strong>
            </div>
          </div>

          <div class="flex flex-col gap-2 min-w-[160px] w-full md:w-auto">
            <!-- 1. Chat WA Klien -->
            <?php
              $noHp = $item->no_hp_pemesan ?? '';
              if (str_starts_with($noHp, '0')) {
                  $noHp = '62' . substr($noHp, 1);
              }
              $pesanWa = rawurlencode("Halo " . $item->nama_pemesan . ", kami dari Admin Jurusan TeFa ingin mengonfirmasi pesanan #" . str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT) . " (" . ($item->tefa->nama_produk ?? 'Layanan') . ").");
            ?>
            <a href="https://wa.me/<?php echo e($noHp); ?>?text=<?php echo e($pesanWa); ?>" target="_blank" class="px-3 py-2 bg-emerald-50 hover:bg-emerald-100 text-emerald-600 rounded-xl text-xs font-semibold flex items-center gap-1.5 transition">
              <span>💬 Chat WA</span>
            </a>

            <!-- 2. Tombol Tolak -->
            <form action="<?php echo e(route('admin.jurusan.pesanan.updateStatus', $item->id_pesanan ?? $item->id)); ?>" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="status" value="ditolak">
              <button type="submit" class="px-3 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-semibold transition">
                ✕ Tolak
              </button>
            </form>

            <!-- 3. Tombol Terima & Tugaskan (Aktif Membuka Modal) -->
            <button type="button" 
              onclick="openAssignModal('<?php echo e($item->id_pesanan ?? $item->id); ?>', '<?php echo e(addslashes($item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan')); ?>')" 
              class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-sm transition">
              ✓ Terima & Tugaskan
            </button>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg">
            📮
          </div>
          <h4 class="text-sm font-bold text-slate-700">Belum Ada Pesanan Masuk</h4>
          <p class="text-xs text-slate-400 mt-1">Pesanan yang diteruskan oleh Admin TEFA ke jurusan ini akan muncul di sini.</p>
        </div>
      <?php endif; ?>

    </div>

    <!-- CONTENT 2: DALAM PENGERJAAN -->
    <div id="content-dalam-pengerjaan" class="tab-content hidden space-y-4">
      <?php $__empty_1 = true; $__currentLoopData = $dalamPengerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-<?php echo e(str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT)); ?></span>
              <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
              <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-md">Proses Pengerjaan</span>
            </div>
            <h3 class="text-base font-bold text-slate-800"><?php echo e($item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan'); ?></h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">
              Worker: <span class="text-indigo-600 font-bold"><?php echo e($item->worker->name ?? $item->worker->username ?? 'Belum ditugaskan'); ?></span>
              · Klien: <span class="text-slate-700 font-semibold"><?php echo e($item->nama_pemesan); ?></span>
            </p>
          </div>
          <div class="flex items-center gap-2">
            <form action="<?php echo e(route('admin.jurusan.pesanan.updateStatus', $item->id_pesanan ?? $item->id)); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="status" value="review">
              <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-xl text-xs font-semibold transition">
                Kirim ke QC / Review →
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <p class="text-xs text-slate-400">Belum ada pesanan yang sedang dikerjakan.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- CONTENT 3: PENINJAUAN & QC -->
    <div id="content-peninjauan-qc" class="tab-content hidden space-y-4">
      <?php $__empty_1 = true; $__currentLoopData = $peninjauanQC; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-<?php echo e(str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT)); ?></span>
              <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
              <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-md">Peninjauan / QC</span>
            </div>
            <h3 class="text-base font-bold text-slate-800"><?php echo e($item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan'); ?></h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Dikerjakan oleh: <?php echo e($item->worker->name ?? 'Worker'); ?></p>
          </div>
          <div class="flex items-center gap-2">
            <form action="<?php echo e(route('admin.jurusan.pesanan.updateStatus', $item->id_pesanan ?? $item->id)); ?>" method="POST">
              <?php echo csrf_field(); ?>
              <input type="hidden" name="status" value="selesai">
              <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold transition">
                ✓ Setujui & Selesaikan
              </button>
            </form>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <p class="text-xs text-slate-400">Belum ada pesanan dalam peninjauan QC.</p>
        </div>
      <?php endif; ?>
    </div>

    <!-- CONTENT 4: PESANAN SELESAI -->
    <div id="content-pesanan-selesai" class="tab-content hidden space-y-4">
      <?php $__empty_1 = true; $__currentLoopData = $pesananSelesai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-<?php echo e(str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT)); ?></span>
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-md">Selesai</span>
            </div>
            <h3 class="text-base font-bold text-slate-800"><?php echo e($item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan'); ?></h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: <?php echo e($item->nama_pemesan); ?></p>
          </div>
          <div>
            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-xl">✓ Tuntas</span>
          </div>
        </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <p class="text-xs text-slate-400">Belum ada pesanan yang selesai.</p>
        </div>
      <?php endif; ?>
    </div>

  </main>

  <!-- JAVASCRIPT UNTUK SWITCH TAB -->
  <script>
    function switchTab(tabId) {
        // Sembunyikan semua konten tab
        const contents = document.querySelectorAll('.tab-content');

        contents.forEach(content => {
            content.classList.add('hidden');
        });

        // Tampilkan konten tab yang dipilih
        const activeContent = document.getElementById(`content-${tabId}`);

        if (activeContent) {
            activeContent.classList.remove('hidden');
        }

        // Reset semua tombol tab
        const buttons = document.querySelectorAll('.tab-btn');

        buttons.forEach(btn => {
            btn.className =
                'tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition';

            const badge = btn.querySelector('span:last-child');

            if (badge) {
                badge.className =
                    'bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full';
            }
        });

        // Aktifkan tombol tab yang dipilih
        const activeBtn = document.getElementById(`tab-${tabId}`);

        if (activeBtn) {
            activeBtn.className =
                'tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-indigo-600 text-white shadow-md shadow-indigo-600/20 transition';

            const badge = activeBtn.querySelector('span:last-child');

            if (badge) {
                badge.className =
                    'bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full';
            }
        }
    }


    // ==========================================
    // MODAL TERIMA & TUGASKAN WORKER
    // ==========================================

    function openAssignModal(idPesanan, namaProduk) {
        const modalElement = document.getElementById('assignWorkerModal');
        const form = document.getElementById('assignWorkerForm');
        const txtNama = document.getElementById('modalNamaProduk');

        // Isi nama layanan ke modal
        if (txtNama) {
            txtNama.innerText = namaProduk;
        }

        // Set action form sesuai ID pesanan
        if (form) {
            form.action = '/admin/jurusan/pesanan/' + idPesanan + '/assign';
        }

        // Buka modal Bootstrap
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
        }
    }


    function closeAssignModal() {
        const modalElement = document.getElementById('assignWorkerModal');

        if (modalElement) {
            const modal = bootstrap.Modal.getInstance(modalElement);

            if (modal) {
                modal.hide();
            }
        }
    }
</script>




<!-- MODAL ASSIGN WORKER -->
<div class="modal fade" id="assignWorkerModal" tabindex="-1" aria-labelledby="assignWorkerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="assignWorkerModalLabel">
                    Tugaskan Pesanan ke Worker
                </h5>

                <button type="button"
                        class="btn-close"
                        onclick="closeAssignModal()"
                        aria-label="Close">
                </button>
            </div>

            <form id="assignWorkerForm" action="" method="POST">
                <?php echo csrf_field(); ?>

                <div class="modal-body">

                    <p class="text-muted mb-3" style="font-size: 0.875rem;">
                        Layanan:
                        <strong id="modalNamaProduk" class="text-dark"></strong>
                    </p>

                    <div class="mb-3">
                        <label for="id_user_worker" class="form-label font-weight-bold">
                            Worker / Siswa Jurusan
                        </label>

                        <select name="id_user_worker"
                                id="id_user_worker"
                                class="form-select"
                                required>

                            <option value="" disabled selected>
                                -- Pilih Siswa / Worker --
                            </option>

                            <?php $__currentLoopData = $workers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $worker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($worker->id_user); ?>">
                                    <?php echo e($worker->name ?? $worker->username); ?>

                                    (<?php echo e($worker->email); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </select>

                        <small class="text-muted">
                            Siswa yang dipilih akan menerima tugas pengerjaan pesanan ini.
                        </small>
                    </div>

                    <div class="mb-3">
                        <label for="catatan_worker" class="form-label font-weight-bold">
                            Catatan / Instruksi Pengerjaan
                        </label>

                        <textarea name="catatan_worker"
                                  id="catatan_worker"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Masukkan instruksi khusus untuk Worker / Siswa..."></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-secondary"
                            onclick="closeAssignModal()">
                        Batal
                    </button>

                    <button type="submit"
                            class="btn btn-primary">
                        Simpan & Tugaskan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


<style>
    .modal {
        z-index: 99999 !important;
    }

    .modal-backdrop {
        z-index: 99998 !important;
    }
</style>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.jurusan.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/jurusan/pesanan/index.blade.php ENDPATH**/ ?>