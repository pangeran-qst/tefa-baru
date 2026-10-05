
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - TeFA SMKN 4</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-slate-50 text-slate-800 flex flex-col">

    {{-- HEADER --}}
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


      {{-- BAGIAN KANAN NAVBAR --}}
      <div class="flex items-center gap-4">

          {{-- NAVIGASI UTAMA --}}
          <nav id="navMenu"
              class="hidden absolute top-[72px] left-0 right-0 flex-col gap-2 bg-white px-[5%] py-4 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-6 md:p-0 md:shadow-none">

              {{-- BERANDA --}}
              <a href="{{ url('/') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Beranda
              </a>

              {{-- LAYANAN --}}
              <a href="{{ route('katalog') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Layanan
              </a>

              {{-- PORTOFOLIO --}}
              <a href="{{ route('portofolio') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Portofolio
              </a>

              {{-- KONTAK --}}
              <a href="{{ route('kontak') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Kontak
              </a>
          </nav>


          {{-- ICON PROFIL / USER --}}
          <div class="relative group">

              @if(Auth::check() && Auth::user()->role === 'client')
                  
                  {{-- 1. TAMPILAN JIKA USER CLIENT SUDAH LOGIN --}}
                  <button type="button"
                      class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-700 text-white font-bold shadow-md transition hover:bg-blue-800"
                      aria-label="Profil">
                      {{-- Inisial Huruf Nama Client --}}
                      {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                  </button>

                  {{-- DROPDOWN PROFIL CLIENT --}}
                  <div class="absolute right-0 top-full z-50 hidden pt-2 group-hover:block">
                      <div class="w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-lg">

                          {{-- INFORMASI USER --}}
                          <div class="border-b border-slate-100 px-4 py-2">
                              <p class="text-sm font-semibold text-slate-900 truncate">
                                  {{ Auth::user()->nama }}
                              </p>
                              <p class="mt-0.5 text-xs text-slate-500 truncate">
                                  {{ Auth::user()->email }}
                              </p>
                          </div>

                          {{-- MENU PROFIL --}}
                          <a href="{{ route('client.dashboard') }}"
                              class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                              Profil Saya
                          </a>

                          {{-- LOGOUT --}}
                          <div class="mt-1 border-t border-slate-100 pt-1">
                              <form action="{{ route('logout') }}" method="POST">
                                  @csrf
                                  <button type="submit"
                                      class="w-full rounded-lg px-4 py-2.5 text-left text-sm font-medium text-red-600 transition hover:bg-red-50">
                                      Logout
                                  </button>
                              </form>
                          </div>

                      </div>
                  </div>

              @else

                  {{-- 2. TAMPILAN JIKA GUEST / BELUM LOGIN --}}
                  <a href="{{ route('login', ['redirect' => url()->current()]) }}"
                      class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 shadow-sm transition hover:bg-blue-700 hover:text-white"
                      title="Login"
                      aria-label="Login">

                      {{-- Icon Guest / User Normal --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                      </svg>
                  </a>

              @endif

          </div>

      </div>

      {{-- TOMBOL MENU MOBILE --}}
      <button class="block md:hidden rounded-md bg-blue-700 px-3 py-2 text-lg text-white" onclick="toggleMenu()"
          aria-label="Buka Menu Navigasi">
          ☰
      </button>
  </header>

    {{-- MAIN --}}
    <main class="mx-auto w-full max-w-7xl flex-1 px-5 py-8 md:px-10 md:py-10 lg:px-16">

        {{-- JUDUL --}}
        <section class="mb-8">
            <a href="{{ route('client.dashboard') }}"
               class="mb-5 inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-blue-700">
                <span class="text-lg">←</span>
                Kembali ke Profil
            </a>

            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 md:text-4xl">
                Pesanan Saya
            </h1>

            <p class="mt-2 max-w-2xl text-sm leading-relaxed text-slate-500 md:text-base">
                Lihat layanan yang sudah kamu pesan dan pantau status pengerjaannya.
            </p>
        </section>

        {{-- RINGKASAN PESANAN --}}
        <section class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-3">

            {{-- TOTAL PESANAN --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md md:p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Total Pesanan
                        </p>
                        <h2 class="mt-2 text-3xl font-extrabold tabular-nums text-slate-900">
                            {{ $totalPesanan ?? 0 }}
                        </h2>
                        <p class="mt-1 text-xs text-slate-400">
                            Semua pesanan kamu
                        </p>
                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2h12l4 7-10 13L2 9l4-7Z"/>
                            <path d="M2 9h20M12 22 8 9l4-7 4 7-4 13"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- SEDANG DIPROSES --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-amber-200 hover:shadow-md md:p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Sedang Diproses
                        </p>
                        <h2 class="mt-2 text-3xl font-extrabold tabular-nums text-slate-900">
                            {{ $sedangDiproses ?? 0 }}
                        </h2>
                        <p class="mt-1 text-xs text-slate-400">
                            Pesanan dalam pengerjaan
                        </p>
                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- PESANAN SELESAI --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-emerald-200 hover:shadow-md md:p-6">
                <div class="flex items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-medium text-slate-500">
                            Selesai
                        </p>
                        <h2 class="mt-2 text-3xl font-extrabold tabular-nums text-slate-900">
                            {{ $pesananSelesai ?? 0 }}
                        </h2>
                        <p class="mt-1 text-xs text-slate-400">
                            Pesanan telah diselesaikan
                        </p>
                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor"
                             stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>

        {{-- DAFTAR PESANAN --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            {{-- HEADER RIWAYAT --}}
            <div class="flex flex-col gap-2 border-b border-slate-100 px-5 py-5 sm:flex-row sm:items-center sm:justify-between md:px-6">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">
                        Riwayat Pesanan
                    </h2>
                    <p class="mt-1 text-sm text-slate-500">
                        Informasi produk, tanggal, tiket, dan status pesanan.
                    </p>
                </div>

                <span class="w-fit rounded-full bg-blue-50 px-3 py-1 text-xs font-semibold text-blue-700">
                    {{ isset($pesanans) ? $pesanans->count() : 0 }} Pesanan
                </span>
            </div>

            {{-- ISI RIWAYAT --}}
            <div class="p-5 md:p-6">
                @forelse ($pesanans ?? [] as $pesanan)
                    @php
                        $kodeTiket = 'TF-' . str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT);

                        $statusLabel = [
                            'pending' => 'Menunggu',
                            'in_progress' => 'Sedang Diproses',
                            'completed' => 'Selesai',
                            'cancelled' => 'Dibatalkan',
                        ][$pesanan->status] ?? ucfirst($pesanan->status ?? 'Tidak diketahui');

                        $statusClass = [
                            'pending' => 'bg-amber-50 text-amber-700 ring-amber-200',
                            'in_progress' => 'bg-blue-50 text-blue-700 ring-blue-200',
                            'completed' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                            'cancelled' => 'bg-red-50 text-red-700 ring-red-200',
                        ][$pesanan->status] ?? 'bg-slate-100 text-slate-600 ring-slate-200';

                        $tanggalPesan = $pesanan->tanggal_pesan
                            ? \Illuminate\Support\Carbon::parse($pesanan->tanggal_pesan)->translatedFormat('d M Y')
                            : '-';
                    @endphp

                    {{-- KARTU PESANAN --}}
                    <div class="mb-4 flex flex-col gap-4 rounded-2xl border border-slate-200 bg-white p-4 transition duration-200 last:mb-0 hover:border-blue-200 hover:shadow-md sm:flex-row sm:items-center sm:p-5">
                       
                        {{-- FOTO PRODUK --}}
                                    
                            @if ($pesanan->tefa && $pesanan->tefa->gambar)
                                <img
                                    src="{{ asset('gambar/tefa/' . $pesanan->tefa->gambar) }}"
                                    alt="{{ $pesanan->tefa->nama_produk }}"
                                    class="h-20 w-20 shrink-0 rounded-xl border border-slate-200 object-cover">
                            @else
                                <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-3xl">
                                    ✨
                                </div>
                            @endif

                        {{-- INFORMASI PESANAN --}}
                        <div class="min-w-0 flex-1">
                            <h3 class="break-words text-base font-bold text-slate-900 md:text-lg">
                                {{ $pesanan->tefa?->nama_produk ?? 'Layanan TeFA' }}
                            </h3>

                            <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-slate-500">
                                <span>
                                    <span class="font-semibold text-slate-600">Tiket:</span>
                                    {{ $kodeTiket }}
                                </span>

                                <span>
                                    <span class="font-semibold text-slate-600">Tanggal:</span>
                                    {{ $tanggalPesan }}
                                </span>
                            </div>

                            <p class="mt-3 font-bold text-slate-900">
                                Rp{{ number_format((float) $pesanan->total_harga, 0, ',', '.') }}
                            </p>

                            <span class="mt-2 inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </div>

                        {{-- TOMBOL TIKET --}}
                        <div class="shrink-0 sm:ml-auto">
                            <a href="{{ route('cek.ticket', ['ticket' => $kodeTiket]) }}"
                               class="inline-flex w-full items-center justify-center gap-2 rounded-xl border border-blue-100 bg-blue-50 px-4 py-2.5 text-sm font-semibold text-blue-700 transition hover:border-blue-700 hover:bg-blue-700 hover:text-white sm:w-auto">
                                Lihat Tiket
                                <span class="text-base">→</span>
                            </a>
                        </div>
                    </div>

                @empty
                    {{-- TAMPILAN JIKA BELUM ADA PESANAN --}}
                    <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/70 px-5 py-10 text-center md:px-8 md:py-12">

                        <div class="mx-auto mb-5 flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30"
                                 viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                 stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M6 2h12l4 7-10 13L2 9l4-7Z"/>
                                <path d="M2 9h20M12 22 8 9l4-7 4 7-4 13"/>
                            </svg>
                        </div>

                        <h3 class="text-lg font-bold text-slate-900">
                            Belum Ada Pesanan
                        </h3>

                        <p class="mx-auto mt-2 max-w-md text-sm leading-relaxed text-slate-500">
                            Saat kamu memesan layanan TeFA, informasi produk,
                            status pengerjaan, tanggal pemesanan, dan nomor tiket
                            akan ditampilkan pada halaman ini.
                        </p>

                        <a href="{{ route('katalog') }}"
                           class="mt-6 inline-flex items-center justify-center gap-2 rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white shadow-md shadow-blue-700/20 transition hover:bg-blue-800">
                            Jelajahi Layanan
                            <span>→</span>
                        </a>
                    </div>
                @endforelse
            </div>
        </section>
    </main>

    {{-- FOOTER --}}
    <footer class="mt-10 bg-blue-900 px-5 pt-10 pb-5 text-white md:px-[8%]">
        <div class="mx-auto mb-10 flex max-w-7xl flex-wrap justify-between gap-8">
            {{-- TENTANG TEFA --}}
            <div class="max-w-sm">
                <h3 class="mb-2 text-base font-bold md:text-lg">
                    TeFA SMKN 4 Tanjungpinang
                </h3>

                <p class="text-xs text-blue-300">
                    Teaching Factory
                </p>

                <p class="mt-3 max-w-[300px] text-xs leading-relaxed text-slate-300">
                    Produk dan jasa profesional karya siswa SMKN 4 Tanjungpinang
                    yang terlatih dan bersertifikat.
                </p>
            </div>

            {{-- KONTAK --}}
            <div class="max-w-xl">
                <h4 class="mb-4 text-sm font-semibold">
                    Kontak & Lokasi
                </h4>

                <ul class="space-y-2 text-xs leading-relaxed text-slate-300 md:text-sm">
                    <li>
                        📍 Jl. Nusantara No.14, Batu IX, Kec. Tanjungpinang Tim.,
                        Kota Tanjung Pinang, Kepulauan Riau 29157
                    </li>
                    <li>
                        ⏰ Senin–Jumat, 08.00–16.00 WIB
                    </li>
                    <li>
                        🌐 tefa.smkn4tpi.sch.id
                    </li>
                </ul>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-2 border-t border-white/10 pt-5 text-center text-xs text-blue-300 md:flex-row">
            <span>
                © 2026 TeFA SMKN 4 Tanjungpinang. Semua hak dilindungi.
            </span>

            <span>
                Dibuat dengan ❤️ oleh siswa-siswi TeFA
            </span>
        </div>
    </footer>

</body>
</html>