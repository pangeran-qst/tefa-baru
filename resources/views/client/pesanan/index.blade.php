<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesanan Saya - TeFA SMKN 4</title>
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

        {{-- JUDUL --}}
        <section class="mb-8">
            <a href="{{ route('client.dashboard') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-blue-700 transition mb-5">
                <span>←</span> Kembali ke Profil
            </a>


            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight text-slate-900">
                Pesanan Saya
            </h1>
            <p class="text-slate-500 mt-2 text-sm md:text-base">
                Lihat layanan yang sudah kamu pesan dan pantau status pengerjaannya.
            </p>
        </section>


        {{-- RINGKASAN --}}
        <section class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-8">

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Total Pesanan</p>
                        <h2 class="text-2xl font-extrabold text-slate-900 mt-2">—</h2>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2h12l4 7-10 13L2 9l4-7Z"/>
                            <path d="M2 9h20M12 22 8 9l4-7 4 7-4 13"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Sedang Diproses</p>
                        <h2 class="text-2xl font-extrabold text-slate-900 mt-2">—</h2>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 6v6l4 2"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-slate-500 font-medium">Selesai</p>
                        <h2 class="text-2xl font-extrabold text-slate-900 mt-2">—</h2>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <path d="m9 11 3 3L22 4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </section>


        {{-- DAFTAR PESANAN --}}
        <section class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="p-5 md:p-6 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-bold text-slate-900">Riwayat Pesanan</h2>
                    <p class="text-sm text-slate-500 mt-1">
                        Informasi produk, tanggal, tiket, dan status pesanan.
                    </p>
                </div>

            </div>

            {{-- CONTOH KARTU PESANAN: PLACEHOLDER --}}
            <div class="p-5 md:p-6">
                <div class="rounded-2xl border border-dashed border-slate-300 bg-slate-50/70 p-8 md:p-12 text-center">
                    <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-100 text-blue-700 flex items-center justify-center mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M6 2h12l4 7-10 13L2 9l4-7Z"/>
                            <path d="M2 9h20M12 22 8 9l4-7 4 7-4 13"/>
                        </svg>
                    </div>

                    <h3 class="text-lg font-bold text-slate-900">
                        Pesanan Kamu Akan Tampil di Sini
                    </h3>

                    <p class="text-sm text-slate-500 leading-relaxed max-w-md mx-auto mt-2">
                        Saat kamu memesan layanan TeFA, informasi produk, status pengerjaan, tanggal pemesanan, dan nomor tiket akan ditampilkan pada halaman ini.
                    </p>

                    <a href="{{ route('katalog') }}"
                       class="inline-flex items-center justify-center mt-6 rounded-xl bg-blue-700 px-5 py-3 text-sm font-semibold text-white hover:bg-blue-800 transition">
                        Jelajahi Layanan
                    </a>
                </div>
            </div>
        </section>

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
