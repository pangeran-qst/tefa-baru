<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - TeFA SMKN 4</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-800">

    {{-- HEADER --}}
    <header class="sticky top-0 z-[1000] bg-white/95 backdrop-blur-md border-b border-slate-100 shadow-sm">
        <div class="max-w-7xl mx-auto px-5 md:px-10 lg:px-16 py-3.5 flex items-center justify-between">

            {{-- LOGO --}}
            <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0">
                <img
                    src="{{ asset('gambar/tefa/logo.png') }}"
                    alt="Logo TeFA"
                    class="h-11 w-auto object-contain">

                <div>
                    <div class="text-base font-bold leading-tight text-slate-900">
                        TeFA SMKN 4
                    </div>
                    <div class="text-xs text-blue-600 mt-0.5">
                        Tanjungpinang
                    </div>
                </div>
            </a>

            {{-- NAVIGASI --}}
            <div class="flex items-center gap-3 md:gap-5">
                <nav
                    id="navMenu"
                    class="hidden absolute top-full left-0 right-0 flex-col gap-2 bg-white px-5 py-4 shadow-lg border-t border-slate-100 md:static md:flex md:flex-row md:items-center md:gap-3 md:p-0 md:shadow-none md:border-0">

                    <a href="{{ url('/') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                        Beranda
                    </a>

                    <a href="{{ route('katalog') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                        Layanan
                    </a>

                    <a href="{{ route('kontak') }}"
                       class="rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-600 transition hover:bg-blue-50 hover:text-blue-700">
                        Kontak
                    </a>
                </nav>

                {{-- PROFILE BUTTON --}}
                <a href="{{ route('client.dashboard') }}"
                   class="flex items-center gap-2.5 px-3.5 py-2 rounded-xl bg-blue-700 text-white text-sm font-semibold shadow-md shadow-blue-700/20 hover:bg-blue-800 transition">
                    <span class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </span>
                    <span class="hidden sm:inline">Profil</span>
                </a>
            </div>
        </div>
    </header>


    {{-- MAIN --}}
    <main class="max-w-7xl mx-auto px-5 md:px-10 lg:px-16 py-10 md:py-14">

        {{-- GREETING --}}
        <section class="mb-9">
            <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 border border-blue-100 px-3.5 py-1.5 mb-4">
                <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                <p class="text-xs font-semibold text-blue-700">
                    Profil Pembeli
                </p>
            </div>

            <h2 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">
                Halo, {{ Auth::user()->nama }}
                <span class="inline-block">👋</span>
            </h2>

            <p class="text-slate-500 mt-2 text-sm md:text-base">
                Kelola akun dan pantau layanan TeFA yang kamu pesan.
            </p>
        </section>


        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-7">

            {{-- PROFILE CARD --}}
            <div class="lg:col-span-1">
                <div class="relative overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-sm hover:shadow-md transition duration-300">

                    {{-- TOP ACCENT --}}
                    <div class="h-2 bg-gradient-to-r from-blue-800 via-blue-600 to-sky-400"></div>

                    <div class="p-6 md:p-7">

                        {{-- PROFILE IDENTITY --}}
                        <div class="flex items-center gap-4 mb-7">
                            <div class="relative shrink-0">
                                <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center text-2xl font-extrabold">
                                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                                </div>
                                <span class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 border-[3px] border-white rounded-full"></span>
                            </div>

                            <div class="min-w-0">
                                <h3 class="font-bold text-lg text-slate-900 truncate">
                                    {{ Auth::user()->nama }}
                                </h3>
                                <p class="text-sm text-slate-500 mt-1">
                                    Client / Pembeli
                                </p>
                                <div class="inline-flex items-center gap-1.5 mt-2 text-xs text-emerald-600 font-semibold">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                    Akun Aktif
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-slate-100 mb-6"></div>

                        {{-- USER INFORMATION --}}
                        <div class="space-y-5">

                            <div class="flex gap-3 items-start">
                                <div class="w-9 h-9 shrink-0 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                                        <path d="m22 7-10 6L2 7"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                        Email
                                    </p>
                                    <p class="text-sm font-medium text-slate-700 mt-1 break-all">
                                        {{ Auth::user()->email }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-3 items-start">
                                <div class="w-9 h-9 shrink-0 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.96.35 1.9.7 2.8a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.9.35 1.84.58 2.8.7a2 2 0 0 1 1.73 2.03z"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                        Nomor HP
                                    </p>
                                    <p class="text-sm font-medium text-slate-700 mt-1">
                                        {{ Auth::user()->no_hp ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex gap-3 items-start">
                                <div class="w-9 h-9 shrink-0 bg-blue-50 text-blue-700 rounded-xl flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20 10c0 5-8 12-8 12S4 15 4 10a8 8 0 1 1 16 0Z"/>
                                        <circle cx="12" cy="10" r="2.5"/>
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                                        Alamat
                                    </p>
                                    <p class="text-sm font-medium text-slate-700 mt-1 leading-relaxed">
                                        {{ Auth::user()->alamat ?? '-' }}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


            {{-- MENU CLIENT --}}
            <div class="lg:col-span-2">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- PESANAN --}}
                    <a href="{{ route('client.pesanan') }}"
                       class="group relative overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition duration-300">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-blue-50 rounded-bl-full opacity-60 group-hover:scale-125 transition duration-500"></div>

                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5 group-hover:bg-blue-700 group-hover:text-white transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 2h12l4 7-10 13L2 9l4-7Z"/>
                                    <path d="M2 9h20M12 22 8 9l4-7 4 7-4 13"/>
                                </svg>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                                Pesanan Saya
                            </h3>

                            <p class="text-sm text-slate-500 mt-2 leading-relaxed min-h-[48px]">
                                Lihat layanan yang sudah kamu pesan dan status pengerjaannya.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-bold text-blue-700">
                                Lihat Pesanan
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </div>
                        </div>
                    </a>


                    {{-- TICKET --}}
                    <a href="{{ route('cek.ticket') }}"
                       class="group relative overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition duration-300">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-sky-50 rounded-bl-full opacity-60 group-hover:scale-125 transition duration-500"></div>

                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5 group-hover:bg-blue-700 group-hover:text-white transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2 9V6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v3a3 3 0 0 0 0 6v3a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-3a3 3 0 0 0 0-6Z"/>
                                    <path d="M13 5v2M13 11v2M13 17v2"/>
                                </svg>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                                Tiket & Tracking
                            </h3>

                            <p class="text-sm text-slate-500 mt-2 leading-relaxed min-h-[48px]">
                                Cek perkembangan dan status pesanan berdasarkan tiket.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-bold text-blue-700">
                                Cek Tracking
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </div>
                        </div>
                    </a>


                    {{-- KATALOG --}}
                    <a href="{{ route('katalog') }}"
                       class="group relative overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition duration-300">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-indigo-50 rounded-bl-full opacity-60 group-hover:scale-125 transition duration-500"></div>

                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5 group-hover:bg-blue-700 group-hover:text-white transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M6 7h15l-1.5 9h-12L6 7Z"/>
                                    <path d="M6 7 5 3H2M9 20h.01M18 20h.01"/>
                                    <circle cx="9" cy="20" r="1"/>
                                    <circle cx="18" cy="20" r="1"/>
                                </svg>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                                Lihat Layanan
                            </h3>

                            <p class="text-sm text-slate-500 mt-2 leading-relaxed min-h-[48px]">
                                Jelajahi produk dan layanan yang tersedia di TeFA SMKN 4.
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-bold text-blue-700">
                                Buka Katalog
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </div>
                        </div>
                    </a>


                    {{-- KONTAK --}}
                    <a href="{{ route('kontak') }}"
                       class="group relative overflow-hidden bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 hover:shadow-lg hover:-translate-y-1 hover:border-blue-200 transition duration-300">

                        <div class="absolute top-0 right-0 w-24 h-24 bg-cyan-50 rounded-bl-full opacity-60 group-hover:scale-125 transition duration-500"></div>

                        <div class="relative">
                            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5 group-hover:bg-blue-700 group-hover:text-white transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5Z"/>
                                </svg>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                                Hubungi Kami
                            </h3>

                            <p class="text-sm text-slate-500 mt-2 leading-relaxed min-h-[48px]">
                                Butuh informasi atau bantuan terkait layanan TeFA?
                            </p>

                            <div class="mt-5 flex items-center gap-2 text-sm font-bold text-blue-700">
                                Hubungi TeFA
                                <span class="group-hover:translate-x-1 transition">→</span>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </main>


    {{-- FOOTER --}}
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

</body>
</html>
