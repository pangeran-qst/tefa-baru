<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kontak - TeFA SMKN 4 Tanjungpinang</title>
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
                    class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
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

    <main class="flex-1 px-5 md:px-[8%] py-[40px] md:py-[60px]">
      <div class="flex flex-col md:flex-row justify-between items-stretch md:items-center gap-8 md:gap-[40px] rounded-2xl bg-gradient-to-r from-blue-900 to-blue-600 p-6 md:p-12 text-white shadow-xl shadow-blue-500/10">
         
        <div class="flex-1">
          <h1 class="text-2xl md:text-3xl font-bold mb-2.5">Hubungi Kami</h1>
          <p class="text-blue-100 text-sm md:text-base mb-7">Ada pertanyaan seputar pemesanan, kerjasama, atau layanan TeFA? Kontak tim customer service kami.</p>

    <ul class="flex flex-col gap-6">

    {{-- GOOGLE MAPS --}}
    <li>
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d127654.38416180738!2d104.3584688966797!3d1.0091301928309448!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d96c8b61440b13%3A0xdc142cab464b148a!2sSMK%20Negeri%204%20Tanjungpinang!5e0!3m2!1sid!2sid!4v1790602608760!5m2!1sid!2sid"
            width="100%"
            height="225"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="strict-origin-when-cross-origin"
            class="rounded-xl">
        </iframe>
    </li>

    {{-- BAGIAN BAWAH MAP --}}
    <li>
        <div class="flex flex-col md:flex-row justify-between gap-8">

            {{-- INFORMASI KIRI --}}
            <div class="flex flex-col gap-4 flex-1">

                {{-- ALAMAT --}}
                <div class="flex items-start gap-3.5">
                    <span class="text-xl leading-none">📍</span>
                    <div>
                        <strong class="block text-sm md:text-base text-white font-semibold">
                            Alamat Sekolah
                        </strong>
                        <p class="text-xs md:text-sm text-slate-200">
                        Jl. Nusantara No.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29157
                        </p>
                    </div>
                </div>

               

                {{-- JAM LAYANAN --}}
                <div class="flex items-start gap-3.5">
                    <span class="text-xl leading-none">🕘</span>
                    <div>
                        <strong class="block text-sm md:text-base text-white font-semibold">
                            Jam Layanan
                        </strong>
                        <p class="text-xs md:text-sm text-slate-200">
                            Senin – Jumat (08.00 – 16.00 WIB)
                        </p>
                    </div>
                </div>

            </div>

            {{-- TOMBOL KANAN --}}
            <div class="flex flex-col gap-3.5 w-full md:w-[250px]">

                <a
                    href="mailto:tefa@smkn4tpi.sch.id"
                    class="rounded-lg bg-white/10 border border-white/30 px-6 py-3.5 text-center text-sm font-semibold text-white transition hover:bg-white/20 hover:-translate-y-0.5">
                    ✉️ Kirim Email CS
                </a>

            </div>

        </div>
    </li>

</ul>
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
          <li>⏰ Senin–Jumat, 08.00–16.00 WIB</li>
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