<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Katalog Layanan & Jurusan - TeFA SMKN 4 Tanjungpinang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-700 font-sans antialiased leading-relaxed min-h-screen flex flex-col justify-between">

  <div>
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
                    class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
                    Layanan
                </a>

                {{-- CEK TIKET --}}
                <a href="{{ route('cek.ticket') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                    Cek Tiket
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

    <section class="bg-blue-800 px-5 py-14 text-center text-white">
      <h1 class="mb-3 text-3xl font-bold">Katalog Layanan & Jurusan</h1>
      <p class="mb-6 text-sm md:text-base text-blue-200">Temukan layanan profesional dari 6 jurusan keahlian Teaching Factory SMKN 4 Tanjungpinang.</p>
    </section>

    <main class="mx-auto my-10 max-w-[1200px] px-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- TKJ -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-emerald-700 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box (Desain Awal) -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/tkj.png') }}" alt="Logo TKJ" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">TKJ</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Teknik Komputer dan Jaringan
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Instalasi jaringan, maintenance komputer, dan solusi IT infrastruktur.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.tkj') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan TKJ</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>


            <!-- GIM -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-cyan-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/gim.png') }}" alt="Logo GIM" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">GIM</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Pengembangan Game
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Pengembangan game mobile, PC, dan game edukasi interaktif.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.gim') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan GIM</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>


            <!-- ANIMASI -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-blue-600 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/animasi.png') }}" alt="Logo ANIMASI" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">ANIMASI</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Animasi
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Animasi 2D/3D, motion graphic, ilustrasi, dan konten visual.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.animasi') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan ANIMASI</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>


            <!-- RPL -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-orange-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/rpl.png') }}" alt="Logo RPL" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">RPL</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Rekayasa Perangkat Lunak
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Pengembangan aplikasi web, mobile, dan sistem informasi.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.rpl') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan RPL</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>


            <!-- DKV -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-red-600 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/dkv.png') }}" alt="Logo DKV" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">DKV</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Desain Komunikasi Visual
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Desain grafis, branding, ilustrasi, dan komunikasi visual kreatif.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.dkv') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan DKV</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>


            <!-- PSPT -->
            <div class="group relative flex min-h-[280px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-yellow-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <!-- Logo Box -->
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg border border-slate-200 bg-slate-50">
                        <img src="{{ asset('gambar/tefa/pspt.png') }}" alt="Logo PSPT" class="h-full w-full object-cover">
                    </div>

                    <!-- Judul Singkat -->
                    <h3 class="mb-1 text-xl font-bold text-slate-900">PSPT</h3>

                    <!-- Nama Panjang Jurusan -->
                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Produksi Siaran Program Televisi
                    </div>

                    <!-- Deskripsi -->
                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Produksi video, dokumentasi acara, iklan, dan konten multimedia.
                    </p>
                </div>

                <!-- Tombol CTA Full-Width -->
                <a href="{{ route('katalog.pspt') }}" class="flex w-full items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-xs font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md active:scale-[0.99]">
                    <span>Lihat Layanan PSPT</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

        </div>
    </main>
  </div>

    <footer class="mt-[60px] bg-blue-900 px-5 md:px-[8%] pt-10 pb-5 text-white">
        <div class="mb-10 flex flex-wrap justify-between gap-8">
        <div>
            <h3 class="mb-2 text-base md:text-lg font-bold">TeFA SMKN 4 Tanjungpinang</h3>
            <p class="text-xs text-blue-300">Teaching Factory</p>
            <p class="mt-3 max-w-[300px] text-xs text-slate-300">
            Produk dan jasa profesional karya siswa SMKN 4 Tanjungpinang yang terlatih dan bersertifikat.
            </p>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-semibold">Kontak & Lokasi</h4>
            <ul class="space-y-2 text-xs md:text-sm text-slate-300">
            <li>📍 Jl. Nusantara No.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29157</li>
            <li>📞 0771-4440844 (WhatsApp CS)</li>
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
      const nav = document.getElementById('navMenu');
      nav.classList.toggle('hidden');
      nav.classList.toggle('flex');
    }
  </script>

</body>
</html>