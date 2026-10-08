@extends('admin.jurusan.layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

  
  

  
  <title>Manajemen Pesanan - Admin Jurusan RPL</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  


  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Title Header -->
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-800">Manajemen Pesanan</h1>
      <p class="text-xs text-slate-500 mt-0.5">Kelola alur pesanan masuk hingga penyelesaian</p>
    </div>

    <!-- TAB NAVIGATION -->
    <div class="flex flex-wrap items-center gap-3 mb-6">
      
      <!-- Tab 1: Pesanan Masuk -->
      <button onclick="switchTab('pesanan-masuk')" id="tab-pesanan-masuk" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-indigo-600 text-white shadow-md shadow-indigo-600/20 transition">
        <span></span> Pesanan Masuk
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pesananMasuk->count() }}</span>
      </button>

      <!-- Tab 2: Dalam Pengerjaan -->
      <button onclick="switchTab('dalam-pengerjaan')" id="tab-dalam-pengerjaan" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Dalam Pengerjaan
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $dalamPengerjaan->count() }}</span>
      </button>

      <!-- Tab 3: Peninjauan & QC -->
      <button onclick="switchTab('peninjauan-qc')" id="tab-peninjauan-qc" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Peninjauan & QC
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $peninjauanQC->count() }}</span>
      </button>

      <!-- Tab 4: Pesanan Selesai -->
      <button onclick="switchTab('pesanan-selesai')" id="tab-pesanan-selesai" class="tab-btn flex items-center gap-2 px-5 py-2.5 rounded-2xl text-xs font-semibold bg-white text-slate-600 hover:bg-slate-50 border border-slate-200 transition">
        <span></span> Pesanan Selesai
        <span class="bg-indigo-800/60 text-white text-[10px] px-2 py-0.5 rounded-full">{{ $pesananSelesai->count() }}</span>
      </button>

    </div>

    <!-- TAB CONTENTS -->

    <!-- CONTENT 1: PESANAN MASUK -->
    <div id="content-pesanan-masuk" class="tab-content space-y-4">
      
      @forelse($pesananMasuk as $item)
      <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

          <!-- INFORMASI RINGKAS PESANAN -->
          <div class="flex-1">

              <!-- TICKET + STATUS -->
              <div class="flex items-center gap-2 mb-2">

                  <span class="text-xs font-semibold text-slate-400">
                      #TF-{{ str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT) }}
                  </span>

                  <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>

                  <span class="text-xs font-semibold text-purple-600 bg-purple-50 px-2.5 py-0.5 rounded-md">
                      Baru
                  </span>

              </div>

              <!-- NAMA PRODUK -->
              <h3 class="text-base font-bold text-slate-800">
                  {{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan Tidak Diketahui' }}
              </h3>

              <!-- TANGGAL PESAN -->
              <div class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-3">

                  <span>⏰</span>

                  <span>
                      Tanggal Pesan:
                      <strong class="text-slate-700">
                          {{ $item->created_at ? $item->created_at->format('d M Y - H:i') : '-' }} WIB
                      </strong>
                  </span>

              </div>

          </div>

          <!-- TOMBOL DETAIL -->
          <div class="flex-shrink-0 w-full md:w-auto">

              <a href="{{ route('admin.jurusan.pesanan.detail', $item->id_pesanan ?? $item->id) }}"
                class="w-full md:w-[170px] px-4 py-2.5 bg-indigo-50 hover:bg-indigo-100 text-indigo-600 rounded-xl text-xs font-semibold flex items-center justify-center transition">

                  Detail Pesanan

              </a>

          </div>

      </div>

      @empty

      <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">

          <div class="w-12 h-12 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center mx-auto mb-3 text-lg">
              📮
          </div>

          <h4 class="text-sm font-bold text-slate-700">
              Belum Ada Pesanan Masuk
          </h4>

          <p class="text-xs text-slate-400 mt-1">
              Pesanan yang diteruskan oleh Admin TEFA ke jurusan ini akan muncul di sini.
          </p>

      </div>

      @endforelse

    </div>

    <!-- CONTENT 2: DALAM PENGERJAAN -->
    <div id="content-dalam-pengerjaan" class="tab-content hidden space-y-4">

      @forelse($dalamPengerjaan as $item)

        @php
            $progressTerakhir = $item->progress->first();
            $nilaiProgress = $progressTerakhir?->progress ?? 0;
        @endphp

        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">

          <!-- HEADER PROJECT -->
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">

            <div class="flex-1">

              <div class="flex items-center gap-2 mb-1">

                <span class="text-xs font-semibold text-slate-400">
                  #TF-{{ str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT) }}
                </span>

                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>

                <span class="text-xs font-semibold text-amber-700 bg-amber-50 px-2.5 py-0.5 rounded-md">
                  Proses Pengerjaan
                </span>

              </div>

              <h3 class="text-base font-bold text-slate-800">
                {{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan' }}
              </h3>

              <p class="text-xs text-slate-500 font-medium mt-0.5">
                Worker:
                <span class="text-indigo-600 font-bold">
                  {{ $item->worker->nama ?? $item->worker->name ?? 'Belum ditugaskan' }}
                </span>

                · Klien:
                <span class="text-slate-700 font-semibold">
                  {{ $item->nama_pemesan }}
                </span>
              </p>

            </div>

            <!-- STATUS PROGRESS -->
            <div class="w-full md:w-64">

              <div class="flex items-center justify-between mb-1.5">

                <span class="text-xs font-semibold text-slate-500">
                  Progress Pengerjaan
                </span>

                <span class="text-xs font-bold text-indigo-600">
                  {{ $nilaiProgress }}%
                </span>

              </div>

              <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">

                <div
                  class="bg-indigo-600 h-full rounded-full transition-all duration-500"
                  style="width: {{ $nilaiProgress }}%">
                </div>

              </div>

              @if($progressTerakhir)
                <p class="text-[10px] text-slate-400 mt-1.5">
                  Tahap: {{ $progressTerakhir->tahap }}
                </p>
              @else
                <p class="text-[10px] text-slate-400 mt-1.5">
                  Belum ada update progress
                </p>
              @endif

            </div>

          </div>

        </div>

      @empty

        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">

          <p class="text-xs text-slate-400">
            Belum ada pesanan yang sedang dikerjakan.
          </p>

        </div>

      @endforelse

    </div>

    <!-- CONTENT 3: PENINJAUAN & QC -->
    <div id="content-peninjauan-qc" class="tab-content hidden space-y-4">
      @forelse($peninjauanQC as $item)
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-{{ str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT) }}</span>
              <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
              <span class="text-xs font-semibold text-blue-700 bg-blue-50 px-2.5 py-0.5 rounded-md">Peninjauan / QC</span>
            </div>
            <h3 class="text-base font-bold text-slate-800">{{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan' }}</h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Dikerjakan oleh: {{ $item->worker->nama ?? 'Worker' }}</p>
          </div>
          <div class="flex items-center gap-2">
            <form action="{{ route('admin.jurusan.pesanan.updateStatus', $item->id_pesanan ?? $item->id) }}" method="POST">
              @csrf
              <input type="hidden" name="status" value="selesai">
              <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl text-xs font-semibold transition">
                ✓ Setujui & Selesaikan
              </button>
            </form>
          </div>
        </div>
      @empty
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <p class="text-xs text-slate-400">Belum ada pesanan dalam peninjauan QC.</p>
        </div>
      @endforelse
    </div>

    <!-- CONTENT 4: PESANAN SELESAI -->
    <div id="content-pesanan-selesai" class="tab-content hidden space-y-4">
      @forelse($pesananSelesai as $item)
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
          <div>
            <div class="flex items-center gap-2 mb-1">
              <span class="text-xs font-semibold text-slate-400">#TF-{{ str_pad($item->id_pesanan ?? $item->id, 4, '0', STR_PAD_LEFT) }}</span>
              <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
              <span class="text-xs font-semibold text-emerald-700 bg-emerald-50 px-2.5 py-0.5 rounded-md">Selesai</span>
            </div>
            <h3 class="text-base font-bold text-slate-800">{{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan' }}</h3>
            <p class="text-xs text-slate-500 font-medium mt-0.5">Klien: {{ $item->nama_pemesan }}</p>
          </div>
          <div>
            <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1.5 rounded-xl">✓ Tuntas</span>
          </div>
        </div>
      @empty
        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 text-center">
          <p class="text-xs text-slate-400">Belum ada pesanan yang selesai.</p>
        </div>
      @endforelse
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
                @csrf

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

                            @foreach($workers as $worker)
                                <option value="{{ $worker->id_user }}">
                                    {{ $worker->nama }}
                                </option>
                            @endforeach

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



@endsection
