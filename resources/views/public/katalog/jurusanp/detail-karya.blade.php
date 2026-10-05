<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Portofolio - TeFA SMKN 4 Tanjungpinang</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-700 font-sans antialiased">

    {{-- HEADER --}}
    <header class="sticky top-0 z-[1000] flex items-center justify-between bg-white px-[5%] md:px-[8%] py-4 shadow-sm">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3">
            <img
                src="{{ asset('gambar/tefa/logo.png') }}"
                alt="Logo TeFA SMKN 4"
                class="h-10 w-auto max-w-[120px] object-contain">
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

                <a href="{{ url('/') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                    Beranda
                </a>

                <a href="{{ route('katalog') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                    Layanan
                </a>

                <a href="{{ route('portofolio') }}"
                    class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
                    Portofolio
                </a>

                <a href="{{ route('kontak') }}"
                    class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                    Kontak
                </a>

            </nav>

            {{-- ICON PROFIL / USER --}}
            <div class="relative group">

                @if(Auth::check() && Auth::user()->role === 'client')

                    <button type="button"
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-700 text-white font-bold shadow-md transition hover:bg-blue-800"
                        aria-label="Profil">
                        {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                    </button>

                    <div class="absolute right-0 top-full z-50 hidden pt-2 group-hover:block">
                        <div class="w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-lg">
                            <div class="border-b border-slate-100 px-4 py-2">
                                <p class="text-sm font-semibold text-slate-900 truncate">
                                    {{ Auth::user()->nama }}
                                </p>
                                <p class="mt-0.5 text-xs text-slate-500 truncate">
                                    {{ Auth::user()->email }}
                                </p>
                            </div>

                            <a href="{{ route('client.dashboard') }}"
                                class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                                Profil Saya
                            </a>

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

                    <a href="{{ route('login', ['redirect' => url()->current()]) }}"
                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 shadow-sm transition hover:bg-blue-700 hover:text-white"
                        title="Login"
                        aria-label="Login">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                        </svg>
                    </a>

                @endif

            </div>

        </div>

        {{-- TOMBOL MENU MOBILE --}}
        <button
            class="block md:hidden rounded-md bg-blue-700 px-3 py-2 text-lg text-white"
            onclick="toggleMenu()"
            aria-label="Buka Menu Navigasi">
            ☰
        </button>

    </header>

    {{-- KONTEN DETAIL PORTOFOLIO --}}
    <main class="px-5 md:px-[8%] py-10 md:py-16">
        <div class="max-w-6xl mx-auto">

            {{-- JUDUL + TOMBOL KEMBALI --}}
            <div class="mb-8 flex items-center justify-between gap-4">
                <div>
                    <h1 class="mt-2 text-3xl md:text-4xl font-bold text-slate-900">
                        {{ $karya->judul_karya }}
                    </h1>

                    <p class="mt-2 text-sm text-slate-500">
                        Portofolio Karya TeFA
                    </p>
                </div>

                <a href="{{ url('/portofolio/produk/' . $karya->id_produk) }}"
                    class="shrink-0 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800">
                    ← Kembali ke Portofolio
                </a>
            </div>


            {{-- CARD DETAIL --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl">

                {{-- GAMBAR UTAMA --}}
                <div class="w-full bg-slate-100">
                    @if(!empty($karya->gambar))

                        <img
                            src="{{ asset('gambar/portofolio/' . $karya->gambar) }}"
                            alt="{{ $karya->judul_karya }}"
                            class="block h-[400px] md:h-[500px] w-full object-cover">

                    @else

                        <div class="flex h-[400px] md:h-[500px] w-full items-center justify-center bg-indigo-50">
                            <span class="text-6xl">🎨</span>
                        </div>

                    @endif
                </div>


                {{-- INFORMASI KARYA --}}
                <div class="p-6 md:p-10 text-left">

                    {{-- JUDUL --}}
                    <h2 class="mb-4 text-2xl font-bold text-slate-900">
                        {{ $karya->judul_karya }}
                    </h2>


                    {{-- DESKRIPSI --}}
                    <p class="mb-8 leading-relaxed text-slate-600">
                        {{ $karya->deskripsi }}
                    </p>


                    {{-- INFORMASI PORTOFOLIO --}}
                    <div class="rounded-xl bg-indigo-50 p-6">

                        <div class="grid grid-cols-[120px_1fr] gap-x-4 gap-y-5">

                            {{-- JURUSAN --}}
                            <strong class="text-slate-900">
                                Jurusan
                            </strong>

                            <span class="text-slate-600">
                                {{ $karya->jurusan ?? '-' }}
                            </span>


                            {{-- PRODUK TERKAIT --}}
                            <strong class="text-slate-900">
                                Produk
                            </strong>

                            <span class="text-slate-600">
                                {{ $karya->tefa->nama_produk ?? '-' }}
                            </span>


                            {{-- KLIEN --}}
                            @if(!empty($karya->klien))

                                <strong class="text-slate-900">
                                    Klien / DUDI
                                </strong>

                                <span class="text-slate-600">
                                    {{ $karya->klien }}
                                </span>

                            @endif


                            {{-- TAHUN --}}
                            <strong class="text-slate-900">
                                Tahun
                            </strong>

                            <span class="text-slate-600">
                                {{ $karya->tahun ?? '-' }}
                            </span>

                        </div>
                    </div>


                    {{-- GALERI SCREENSHOT --}}
                    @if(!empty($karya->galeri_screenshot))

                        <div class="mt-10">

                            <h3 class="mb-5 text-xl font-bold text-slate-900">
                                Galeri Karya
                            </h3>

                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5">

                                @foreach($karya->galeri_screenshot as $gambar)

                                    <div class="overflow-hidden rounded-xl bg-slate-100 shadow-sm">

                                        <img
                                            src="{{ asset('gambar/portofolio/' . $gambar) }}"
                                            alt="Galeri {{ $karya->judul_karya }}"
                                            class="h-52 w-full object-cover transition duration-300 hover:scale-105">

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif


                    {{-- LINK PROYEK --}}
                    @if(!empty($karya->link_proyek))

                        <a
                            href="{{ $karya->link_proyek }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-8 block w-full rounded-xl bg-blue-700 py-4 text-center font-semibold text-white transition hover:bg-blue-800">

                            Lihat Proyek / Demo Live ↗

                        </a>

                    @endif

                    {{-- TOMBOL AKSI --}}
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">

                        {{-- TOMBOL TERTARIK --}}
                        <a href="{{ route('detail.produk', $karya->id_produk) }}"
                            class="mt-4 block w-full rounded-xl bg-green-600 py-4 text-center font-semibold text-white transition hover:bg-green-700">
                            Tertarik? → Lihat Detail Produk & Pesan
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </main>

    {{-- FOOTER --}}
    <<footer class="mt-[60px] bg-blue-900 px-5 md:px-[8%] pt-10 pb-5 text-white">
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

</body>

</html>