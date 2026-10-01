<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio Jurusan - TeFA SMKN 4 Tanjungpinang</title>
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
                            class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
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

        {{-- MAIN CONTENT LAYOUT --}}
        <main class="mx-auto my-10 max-w-[1200px] px-5">
            <div class="flex flex-col md:flex-row gap-8">
                
                {{-- SIDEBAR NAVIGASI JURUSAN --}}
                <aside class="w-full md:w-64 shrink-0">
                    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sticky top-24">
                        <h3 class="mb-4 text-xs font-bold uppercase tracking-wider text-slate-400">Pilih Jurusan</h3>
                        <nav class="flex flex-col gap-1.5">
                            @foreach($allJurusan as $item)
                                <a href="{{ route('katalog.detail', $item->slug) }}" 
                                   class="flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-semibold transition {{ $jurusan->slug === $item->slug ? 'bg-blue-700 text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                                    <span class="w-8 text-xs font-bold uppercase">{{ $item->singkatan }}</span>
                                    <span class="truncate">{{ $item->nama_singkat }}</span>
                                </a>
                            @endforeach
                        </nav>
                    </div>
                </aside>

                {{-- GRID PORTOFOLIO --}}
                <section class="flex-1">
                    @if($portofolios->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                            @foreach($portofolios as $item)
                                <div class="group flex flex-col justify-between overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                                    <div>
                                        <div class="h-48 w-full overflow-hidden bg-slate-100">
                                            <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                                        </div>
                                        <div class="p-5">
                                            <div class="mb-2 inline-block rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                                                {{ $item->kategori }}
                                            </div>
                                            <h3 class="mb-2 text-lg font-bold text-slate-900 leading-snug">{{ $item->judul }}</h3>
                                            <p class="line-clamp-2 text-xs text-slate-500 leading-relaxed">{{ $item->deskripsi }}</p>
                                        </div>
                                    </div>

                                    <div class="border-t border-slate-100 p-5 pt-3 flex items-center justify-between">
                                        <div>
                                            <span class="block text-[10px] uppercase font-bold text-slate-400">Klien / Tahun</span>
                                            <span class="text-xs font-semibold text-slate-700">{{ $item->klien ?? 'Proyek TeFA' }} ({{ $item->tahun }})</span>
                                        </div>
                                        <button onclick='openModal(@json($item))' class="rounded-lg bg-blue-700 px-3.5 py-2 text-xs font-bold text-white transition hover:bg-blue-800">
                                            Detail Karya
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            {{ $portofolios->links() }}
                        </div>
                    @else
                        <div class="rounded-xl border border-dashed border-slate-300 p-12 text-center bg-white">
                            <p class="text-slate-500 font-medium">Belum ada data portofolio yang ditampilkan untuk jurusan ini.</p>
                        </div>
                    @endif
                </section>

            </div>
        </main>
    </div>

    {{-- MODAL DETAIL PORTOFOLIO --}}
    <div id="modalDetail" class="fixed inset-0 z-[2000] hidden items-center justify-center bg-slate-900/60 p-4 backdrop-blur-sm">
        <div class="relative w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl">
            <button onclick="closeModal()" class="absolute right-4 top-4 z-10 flex h-8 w-8 items-center justify-center rounded-full bg-white/80 text-slate-600 shadow-md transition hover:bg-white">✕</button>

            <div class="h-56 w-full overflow-hidden bg-slate-100">
                <img id="modalImg" src="" alt="" class="h-full w-full object-cover">
            </div>

            <div class="p-6">
                <span id="modalKategori" class="inline-block rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700 mb-2"></span>
                <h3 id="modalJudul" class="text-xl font-bold text-slate-900 mb-2"></h3>
                <p id="modalDeskripsi" class="text-xs text-slate-600 leading-relaxed mb-4"></p>

                <div class="rounded-xl bg-slate-50 p-4 border border-slate-100 space-y-2 text-xs mb-6">
                    <div class="flex justify-between">
                        <span class="font-bold text-slate-500">Pembuat/Siswa:</span>
                        <span id="modalKreator" class="font-semibold text-slate-800"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold text-slate-500">Klien:</span>
                        <span id="modalKlien" class="font-semibold text-slate-800"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-bold text-slate-500">Tahun Pembuatan:</span>
                        <span id="modalTahun" class="font-semibold text-slate-800"></span>
                    </div>
                </div>

                <a id="modalLink" href="#" target="_blank" class="block w-full text-center rounded-lg bg-blue-700 py-2.5 text-xs font-bold text-white shadow-sm transition hover:bg-blue-800">
                    Lihat Proyek Asli / Demo
                </a>
            </div>
        </div>
    </div>

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

        function openModal(data) {
            document.getElementById('modalImg').src = '/storage/' + data.gambar;
            document.getElementById('modalJudul').innerText = data.judul;
            document.getElementById('modalKategori').innerText = data.kategori;
            document.getElementById('modalDeskripsi').innerText = data.deskripsi;
            document.getElementById('modalKreator').innerText = data.kreator || 'Siswa TeFA';
            document.getElementById('modalKlien').innerText = data.klien || 'Internal / Portofolio';
            document.getElementById('modalTahun').innerText = data.tahun;

            const linkBtn = document.getElementById('modalLink');
            if(data.link_proyek) {
                linkBtn.href = data.link_proyek;
                linkBtn.classList.remove('hidden');
            } else {
                linkBtn.classList.add('hidden');
            }

            const modal = document.getElementById('modalDetail');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal() {
            const modal = document.getElementById('modalDetail');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>