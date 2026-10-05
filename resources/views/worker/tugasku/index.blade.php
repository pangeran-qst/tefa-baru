@extends('worker.layouts.app')

@section('title', 'Tugasku')

@section('content')


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tugasku - TeFA Platform</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
    .line-through-custom { text-decoration: line-through; color: #94a3b8; }
  </style>


<!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    
    <!-- Header Title & User Status -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Tugasku — Project Management</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola seluruh alur pengerjaan tugas kamu</p>
      </div>
      <div class="flex items-center gap-3 self-start sm:self-auto">

        <span class="text-xs text-muted">
          {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
        </span>

          @php
            $nama = Auth::user()->nama ?? 'Worker';

            $inisial = collect(explode(' ', trim($nama)))
                ->filter()
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->take(2)
                ->implode('');
        @endphp

        <div
            class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center shadow"
            style="width: 32px; height: 32px; font-size: 11px;">
            {{ $inisial }}
        </div>
      </div>
    </div>

    <!-- TAB NAVIGATION CARD -->
    <div class="bg-white rounded-2xl p-2.5 border border-slate-200/80 shadow-sm inline-flex gap-2 mb-6">
      <button onclick="switchTab('new-project')" id="btn-new-project" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 transition bg-indigo-600 text-white shadow-md shadow-indigo-600/20">
        <span></span> New Project
      </button>
      <button onclick="switchTab('project-saya')" id="btn-project-saya" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 transition text-slate-500 hover:bg-slate-100">
        <span></span> Project Saya
      </button>
      <button onclick="switchTab('project-selesai')" id="btn-project-selesai" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 transition text-slate-500 hover:bg-slate-100">
        <span></span> Project Selesai
      </button>
    </div>

    <!-- TAB CONTENT 1: NEW PROJECT -->
    <div id="tab-new-project" class="tab-content space-y-4">

      @forelse($newProject as $item)

        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

          <div>
            <div class="flex items-center gap-2 mb-2">

              <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-100 text-indigo-600">
                {{ $item->tefa->layanan ?? 'TEFA' }}
              </span>

              <span class="text-xs text-slate-400">
                Pesanan #{{ $item->id_pesanan }}
              </span>

            </div>

            <h3 class="text-sm font-bold text-slate-800">
              {{ $item->tefa->nama_produk ?? 'Layanan TEFA' }}
            </h3>

            <p class="text-xs text-slate-500 mt-1">
              Klien:
              <span class="font-medium text-slate-700">
                {{ $item->nama_pemesan }}
              </span>
            </p>

            @if($item->catatan_pesanan)
              <p class="text-xs text-slate-400 mt-1">
                Catatan: {{ $item->catatan_pesanan }}
              </p>
            @endif

          </div>

          <div class="flex items-center gap-2 shrink-0">

            <!-- TOLAK -->
            <form action="{{ route('worker.pesanan.tolak', $item->id_pesanan) }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menolak project ini?')">
                @csrf

                <button type="submit"
                        class="px-4 py-2 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl text-xs font-semibold transition">
                    ✕ Tolak
                </button>
            </form>

            <!-- TERIMA -->
            <form action="{{ route('worker.pesanan.terima', $item->id_pesanan) }}"
                  method="POST">
                @csrf

                <button type="submit"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold shadow-sm transition">
                    ✓ Terima Project
                </button>
            </form>

        </div>

        </div>

      @empty

        <div class="bg-white rounded-2xl p-10 border border-slate-200/80 shadow-sm text-center">

          <div class="text-3xl mb-3">📭</div>

          <h3 class="text-sm font-bold text-slate-700">
            Belum ada project baru
          </h3>

          <p class="text-xs text-slate-400 mt-1">
            Project yang ditugaskan oleh Admin Jurusan akan muncul di sini.
          </p>

        </div>

      @endforelse

    </div>

    <!-- TAB CONTENT 2: PROJECT SAYA -->
    <div id="tab-project-saya" class="tab-content hidden space-y-6">

      @forelse($projectSaya as $item)

        <!-- Project -->
        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm">

          <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
            <div>
              <div class="flex items-center gap-2 mb-2">

                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-indigo-100 text-indigo-600">
                  {{ $item->tefa->jurusan ?? 'TEFA' }}
                </span>

                <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-600 flex items-center gap-1">
                  ⏰ Dalam pengerjaan
                </span>

              </div>

              <h3 class="text-base font-bold text-slate-800">
                {{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan' }}
              </h3>

              <p class="text-xs text-slate-500 font-medium mt-0.5">
                Pesanan #{{ $item->id_pesanan }}
                · Klien:
                <span class="text-slate-700 font-semibold">
                  {{ $item->nama_pemesan }}
                </span>
              </p>
            </div>

            <div class="flex items-center gap-2">

              <button class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-xs font-bold flex items-center gap-1.5 shadow-md shadow-emerald-500/20 transition">
                💬 Quick-WA Kajur
              </button>

              <button
                type="button"
                onclick="openProgressModal(
                    '{{ $item->id_pesanan }}',
                    '{{ $item->tefa->nama_produk ?? 'Layanan' }}'
                )"
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-bold flex items-center gap-1.5 shadow-md shadow-indigo-600/20 transition">
                📊 Update Progress
            </button>

            </div>
          </div>


          <!-- Progress Bar -->
          @php
              $progressTerakhir = $item->progress->first();
              $nilaiProgress = $progressTerakhir?->progress ?? 0;
          @endphp

          <div class="mb-6">
              <div class="flex justify-between items-center text-xs text-slate-500 font-medium mb-1.5">
                  <span>Progress Pengerjaan</span>

                  <span class="font-bold text-indigo-600">
                      {{ $nilaiProgress }}%
                  </span>
              </div>

              <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                  <div
                      class="bg-indigo-600 h-full rounded-full transition-all duration-500"
                      style="width: {{ $nilaiProgress }}%">
                  </div>
              </div>
          </div>


          <!-- Catatan Pesanan -->
          @if($item->catatan_pesanan)
            <div class="mb-6">

              <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
                CATATAN PESANAN
              </h4>

              <div class="bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5">
                <p class="text-xs text-slate-600">
                  {{ $item->catatan_pesanan }}
                </p>
              </div>

            </div>
          @endif


          <!-- Link Hasil Pengerjaan -->
          <div>
            <h4 class="text-[11px] font-bold text-slate-400 uppercase tracking-wider mb-2">
              LINK HASIL PENGERJAAN
            </h4>

            <input
              type="text"
              placeholder="https://drive.google.com/... / https://github.com/..."
              class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs focus:outline-none focus:border-indigo-500 transition">
          </div>


          <div class="flex justify-end mt-5 pt-4 border-t border-slate-100">

            @php
              $progressTerakhir = $item->progress->first();
              $nilaiProgress = $progressTerakhir?->progress ?? 0;
            @endphp

            <div class="flex justify-end mt-5 pt-4 border-t border-slate-100">

                <form
                    action="{{ route('worker.pesanan.selesai', $item->id_pesanan) }}"
                    method="POST"
                    onsubmit="return confirm('Project sudah selesai dan siap diajukan untuk QC?')">

                    @csrf

                    <button
                        type="submit"
                        @disabled($nilaiProgress < 100)
                        class="px-5 py-2.5 rounded-xl text-xs font-bold flex items-center gap-2 transition
                            {{ $nilaiProgress >= 100
                                ? 'bg-emerald-500 hover:bg-emerald-600 text-white shadow-md shadow-emerald-500/20'
                                : 'bg-slate-100 text-slate-400 cursor-not-allowed' }}">

                        Selesai

                    </button>

                </form>

            </div>

          </div>

        </div>

      @empty

        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm text-center">

          <div class="text-3xl mb-3">
            🛠️
          </div>

          <h3 class="text-sm font-bold text-slate-700">
            Belum ada project yang sedang dikerjakan
          </h3>

          <p class="text-xs text-slate-400 mt-1">
            Project yang sudah kamu terima akan muncul di sini.
          </p>

        </div>

      @endforelse

    </div>

    <!-- TAB CONTENT 3: PROJECT SELESAI -->
    <div id="tab-project-selesai" class="tab-content hidden space-y-4">

      @forelse($projectSelesai as $item)

        <div class="bg-white rounded-2xl p-6 border border-slate-200/80 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

          <!-- INFO PROJECT -->
          <div>

            <div class="flex items-center gap-2 mb-2">

              <!-- JURUSAN / LAYANAN -->
              <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-600">
                {{ $item->tefa->jurusan ?? $item->tefa->layanan ?? 'TEFA' }}
              </span>

              <!-- STATUS -->
              <span class="px-2.5 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-600">
                ✓ Selesai
              </span>

            </div>

            <!-- NAMA PROJECT -->
            <h3 class="text-sm font-bold text-slate-800">
              {{ $item->tefa->nama_produk ?? $item->nama_layanan ?? 'Layanan TEFA' }}
            </h3>

            <!-- NOMOR & CLIENT -->
            <p class="text-xs text-slate-500 mt-1">
              Pesanan #{{ $item->id_pesanan }}

              · Klien:
              <span class="font-medium text-slate-700">
                {{ $item->nama_pemesan }}
              </span>
            </p>

            <!-- TANGGAL SELESAI -->
            <p class="text-xs text-slate-400 mt-1">
              Selesai:
              {{ $item->updated_at ? $item->updated_at->format('d M Y - H:i') : '-' }}
            </p>

          </div>

          <!-- STATUS -->
          <div class="self-start md:self-auto">

            <span class="px-5 py-2.5 bg-emerald-50 text-emerald-600 border border-emerald-100 rounded-xl text-xs font-bold flex items-center gap-2">
              ✓ Lolos QC
            </span>

          </div>

        </div>

      @empty

        <div class="bg-white rounded-2xl p-8 border border-slate-200/80 shadow-sm text-center">

          <div class="text-3xl mb-3">
            🎉
          </div>

          <h3 class="text-sm font-bold text-slate-700">
            Belum ada project yang selesai
          </h3>

          <p class="text-xs text-slate-400 mt-1">
            Project yang sudah lolos QC akan muncul di sini.
          </p>

        </div>

      @endforelse

    </div>

  </main>



  <!-- MODAL UPDATE PROGRESS -->
  <div id="progressModal"
      class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50">

      <div class="bg-white rounded-2xl w-full max-w-md mx-4 p-6 shadow-xl">

          <!-- Header -->
          <div class="flex items-center justify-between mb-5">
              <div>
                  <h3 class="text-base font-bold text-slate-800">
                      Update Progress
                  </h3>

                  <p id="progressNamaProduk"
                    class="text-xs text-slate-400 mt-1">
                      Project
                  </p>
              </div>

              <button
                  type="button"
                  onclick="closeProgressModal()"
                  class="text-slate-400 hover:text-slate-600 text-xl">
                  ×
              </button>
          </div>

          <!-- Form -->
          <form id="progressForm" method="POST">

              @csrf

              <!-- Progress -->
              <div class="mb-4">

                  <label class="block text-xs font-semibold text-slate-600 mb-2">
                      Persentase Progress
                  </label>

                  <div class="flex items-center gap-3">

                      <input
                          type="range"
                          name="progress"
                          id="progressRange"
                          min="0"
                          max="100"
                          value="0"
                          class="w-full accent-indigo-600"
                          oninput="document.getElementById('progressValue').innerText = this.value + '%'">

                      <span
                          id="progressValue"
                          class="text-sm font-bold text-indigo-600 w-12">
                          0%
                      </span>

                  </div>

              </div>

              <!-- Tahap -->
              <div class="mb-4">

                  <label class="block text-xs font-semibold text-slate-600 mb-2">
                      Tahap Pengerjaan
                  </label>

                  <select
                      name="tahap"
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-xs focus:outline-none focus:border-indigo-500">

                      <option value="Persiapan">Persiapan</option>
                      <option value="Pengerjaan">Pengerjaan</option>
                      <option value="Implementasi">Implementasi</option>
                      <option value="Testing">Testing</option>
                      <option value="Revisi">Revisi</option>
                      <option value="Finalisasi">Finalisasi</option>

                  </select>

              </div>

              <!-- Catatan -->
              <div class="mb-5">

                  <label class="block text-xs font-semibold text-slate-600 mb-2">
                      Catatan Progress
                  </label>

                  <textarea
                      name="catatan"
                      rows="3"
                      placeholder="Contoh: Fitur login dan dashboard sudah selesai..."
                      class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3 py-2.5 text-xs focus:outline-none focus:border-indigo-500"></textarea>

              </div>

              <!-- Button -->
              <div class="flex justify-end gap-2">

                  <button
                      type="button"
                      onclick="closeProgressModal()"
                      class="px-4 py-2 bg-slate-100 text-slate-500 rounded-xl text-xs font-semibold">
                      Batal
                  </button>

                  <button
                      type="submit"
                      class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-xs font-semibold">
                      Simpan Progress
                  </button>

              </div>

          </form>

      </div>

  </div>




  <!-- SCRIPT INTERAKTIF KHUSUS TABS -->
  <script>
    function switchTab(tabName) {
      // Sembunyikan semua tab content
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
      });

      // Reset style semua tombol tab
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-600/20');
        btn.classList.add('text-slate-500', 'hover:bg-slate-100');
      });

      // Tampilkan tab yang dipilih
      document.getElementById('tab-' + tabName).classList.remove('hidden');

      // Aktifkan gaya tombol tab yang dipilih
      const activeBtn = document.getElementById('btn-' + tabName);
      activeBtn.classList.remove('text-slate-500', 'hover:bg-slate-100');
      activeBtn.classList.add('bg-indigo-600', 'text-white', 'shadow-md', 'shadow-indigo-600/20');
    }


    function openProgressModal(idPesanan, namaProduk) {

      const modal = document.getElementById('progressModal');
      const form = document.getElementById('progressForm');
      const nama = document.getElementById('progressNamaProduk');

      nama.innerText = namaProduk;

      form.action = '/worker/pesanan/' + idPesanan + '/progress';

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }


    function closeProgressModal() {

        const modal = document.getElementById('progressModal');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


  </script>
  

  

@endsection