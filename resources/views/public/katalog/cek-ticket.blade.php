<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Tiket - TeFA SMKN 4 Tanjungpinang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-slate-50 font-sans text-slate-700 antialiased leading-relaxed">

  <header class="sticky top-0 z-[1000] flex items-center justify-between bg-white px-[5%] md:px-[8%] py-4 shadow-sm">
      {{-- LOGO --}}
      <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img
              src="{{ asset('gambar/tefa/logo.png') }}"
              alt=""
              class="h-10 w-auto max-w-[120px] object-contain"
          >

          <div>
              <div class="text-[15px] font-bold leading-tight text-slate-900">
                  TeFA SMKN 4
              </div>

              <div class="text-xs text-blue-500">
                  Tanjungpinang
              </div>
          </div>
      </a>


      {{-- BAGIAN KANAN --}}
      <div class="flex items-center gap-4">

          {{-- NAVIGASI --}}
          <nav
              id="navMenu"
              class="hidden absolute top-[72px] left-0 right-0 flex-col gap-2 bg-white px-[5%] py-4 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-6 md:p-0 md:shadow-none">

              <a
                  href="{{ url('/') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Beranda
              </a>

              <a
                  href="{{ route('katalog') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Layanan
              </a>


              <a
                  href="{{ route('kontak') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Kontak
              </a>

          </nav>


          {{-- ICON PROFIL --}}
          <button
              type="button"
              class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-800 text-white shadow-md transition hover:bg-blue-900"
              aria-label="Profil">

              <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="h-5 w-5"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2">

                  <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />

              </svg>

          </button>

      </div>


      {{-- TOMBOL MENU MOBILE --}}
      <button
          class="block md:hidden rounded-md bg-blue-700 px-3 py-2 text-lg text-white"
          onclick="toggleMenu()"
          aria-label="Buka Menu Navigasi">
          ☰
      </button>
  </header>

  <main class="flex-1 px-[5%] md:px-[8%] py-10 md:py-[60px]">
    <div class="mx-auto mb-9 max-w-[600px] text-center">
      <h1 class="mb-2 text-2xl md:text-3xl font-bold text-slate-900">Cek Status Pesanan</h1>
      <p class="text-sm md:text-base text-slate-500">Masukkan kode ticket Anda untuk memantau pengerjaan proyek secara online.</p>
    </div>

    <div class="mx-auto max-w-[580px] rounded-xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
      <form
          action="{{ route('cek.ticket') }}"
          method="GET"
          class="flex flex-col md:flex-row gap-2.5">
          <input
              type="text"
              name="ticket"
              value="{{ request('ticket') }}"
              placeholder="Contoh: TF-0001"
              autocomplete="off"
              class="flex-1 rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20"
              required
          >

          <button
              type="submit"
              class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 w-full md:w-auto"
          >
              Cek Tiket
          </button>
      </form>

       <div
          id="hasilTiket"
          class="mt-5 {{ isset($pesanan) ? '' : 'hidden' }}">
          @if(isset($pesanan))

              @php
                  $statusLabel = [
                      'pending' => 'Menunggu Respons',
                      'in_progress' => 'Sedang Dikerjakan',
                      'completed' => 'Selesai',
                      'cancelled' => 'Dibatalkan',
                  ];
              @endphp

              {{-- INFORMASI PESANAN --}}
              <div class="rounded-lg border border-slate-200 bg-slate-50 p-4 mb-5">

                  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">

                      <div>
                          <div class="text-xs text-slate-500">
                              Nomor Tiket
                          </div>

                          <div class="text-lg font-bold text-blue-700">
                              #TF-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                          </div>
                      </div>

                      <div>
                          <div class="text-xs text-slate-500">
                              Layanan
                          </div>

                          <div class="font-semibold text-slate-800">
                              {{ $pesanan->tefa->nama_produk ?? '-' }}
                          </div>
                      </div>

                  </div>

              </div>


              {{-- RIWAYAT PENGERJAAN --}}
              <div class="rounded-lg border border-slate-200 bg-white overflow-hidden">

                  <div class="px-5 py-4 border-b border-slate-200">
                      <h3 class="font-bold text-slate-800">
                          Riwayat Pengerjaan
                      </h3>

                      <p class="text-xs text-slate-500 mt-1">
                          Jejak perubahan status pesanan Anda
                      </p>
                  </div>


                  <div class="p-5">

                    <div class="relative flex gap-4 pb-6">

                      {{-- GARIS --}}
                      @if($pesanan->riwayat->count() > 0)
                          <div class="absolute left-[7px] top-5 bottom-0 w-px bg-slate-200"></div>
                      @endif

                      {{-- BULATAN --}}
                      <div class="relative z-10 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-blue-600 ring-4 ring-blue-50">
                      </div>

                      {{-- ISI --}}
                      <div class="flex-1">

                          <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-1">

                              <div class="font-semibold text-slate-800">
                                  Pesanan Diterima
                              </div>

                              <div class="text-[11px] text-slate-400">
                                  {{ $pesanan->tanggal_pesan?->format('d M Y, H:i') }}
                              </div>

                          </div>

                          <p class="text-sm text-slate-600 mt-1">
                              Pesanan berhasil diterima dan menunggu diproses.
                          </p>

                      </div>

                  </div>


                  {{-- RIWAYAT DARI DATABASE --}}
                  @foreach($pesanan->riwayat as $riwayat)

                      <div class="relative flex gap-4 pb-6 last:pb-0">

                          {{-- GARIS --}}
                          @unless($loop->last)
                              <div class="absolute left-[7px] top-5 bottom-0 w-px bg-slate-200"></div>
                          @endunless

                          {{-- BULATAN --}}
                          <div class="relative z-10 flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-blue-600 ring-4 ring-blue-50">
                          </div>

                          {{-- ISI --}}
                          <div class="flex-1">

                              <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-1">

                                  <div class="font-semibold text-slate-800">
                                      {{ $statusLabel[$riwayat->status] ?? $riwayat->status }}
                                  </div>

                                  <div class="text-[11px] text-slate-400">
                                      {{ $riwayat->tanggal_tracking?->format('d M Y, H:i') }}
                                  </div>

                              </div>

                              @if($riwayat->keterangan)
                                  <p class="text-sm text-slate-600 mt-1">
                                      {{ $riwayat->keterangan }}
                                  </p>
                              @endif

                              @if($riwayat->lokasi)
                                  <div class="text-xs text-slate-400 mt-1">
                                      📍 {{ $riwayat->lokasi }}
                                  </div>
                              @endif

                          </div>

                      </div>

                  @endforeach

                  </div>

              </div>


          @elseif(request()->filled('ticket'))
              <div class="rounded-lg bg-red-50 border border-red-200 p-4 text-sm text-red-800">
                  ❌ Tiket
                  <strong>"{{ request('ticket') }}"</strong>
                  tidak ditemukan.
              </div>
          @endif
      </div>
    </div>
  </main>

  <footer class="mt-[60px] bg-blue-900 px-[5%] md:px-[8%] pt-10 pb-5 text-white">
    <div class="mb-10 flex flex-wrap justify-between gap-8">
      <div>
        <h3 class="mb-2 text-lg font-bold">TeFA SMKN 4 Tanjungpinang</h3>
        <p class="text-xs text-blue-300">Teaching Factory</p>
        <p class="mt-3 max-w-[300px] text-xs text-slate-300">
          Produk dan jasa profesional karya siswa SMKN 4 Tanjungpinang yang terlatih dan bersertifikat.
        </p>
      </div>

      <div>
        <h4 class="mb-4 text-sm font-bold">Kontak &amp; Lokasi</h4>
        <ul class="space-y-2 text-xs text-slate-300">
          <li>📍 Jl. Nusantara No.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29157</li>
          <li>⏰ Senin–Jumat, 07.00–18.00 WIB</li>
          <li>🌐 tefa.smkn4tpi.sch.id</li>
        </ul>
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-between items-center gap-2 border-t border-white/10 pt-5 text-center text-xs text-blue-300">
      <span>© 2026 TeFA SMKN 4 Tanjungpinang. Semua hak dilindungi.</span>
      <span>Dibuat dengan ❤️ oleh siswa-siswi TeFA</span>
    </div>
  </footer>

  <script>
    function toggleMenu() {
      const nav = document.getElementById("navMenu");
      nav.classList.toggle("hidden");
      nav.classList.toggle("flex");
    }

  </script>

</body>
</html>