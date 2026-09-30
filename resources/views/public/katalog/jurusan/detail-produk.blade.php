<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Produk - TeFA SMKN 4 Tanjungpinang</title>

    <style>

        /* MODAL FORM PEMBELIAN */

        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            padding: 20px;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-card {
            background: white;
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            overflow-y: auto;
            border-radius: 16px;
            position: relative;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
        }

        .modal-close {
            position: absolute;
            right: 18px;
            top: 15px;
            border: none;
            background: transparent;
            font-size: 22px;
            cursor: pointer;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-body h3 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .modal-body > p {
            color: #666;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            margin-bottom: 7px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 14px;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn-block {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

    </style>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-700 font-sans antialiased">

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
                        <svg xmlns="http://www.w3.org/2000/svg"
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


    {{-- KONTEN DETAIL PRODUK --}}
    <main class="px-5 md:px-[8%] py-10 md:py-16">

        <div class="max-w-6xl mx-auto">

            {{-- JUDUL + TOMBOL KEMBALI --}}
            <div class="mb-8 flex items-center justify-between gap-4">

                <div>

                    <h1 class="mt-2 text-3xl md:text-4xl font-bold text-slate-900">
                        {{ $tefa->nama_produk }}
                    </h1>

                </div>

                @php
                    $routeJurusan = match (strtoupper($tefa->jurusan)) {
                        'ANIMASI' => 'katalog.animasi',
                        'RPL' => 'katalog.rpl',
                        'TKJ' => 'katalog.tkj',
                        'DKV' => 'katalog.dkv',
                        'GIM' => 'katalog.gim',
                        'PSPT' => 'katalog.pspt',
                        default => 'katalog',
                    };
                @endphp

                {{-- TOMBOL KEMBALI --}}
                <a
                    href="{{ route($routeJurusan) }}"
                    class="shrink-0 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800">

                    ← Kembali ke Katalog

                </a>

            </div>


            {{-- CARD DETAIL PRODUK --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl">


                {{-- GAMBAR PRODUK - BAGIAN ATAS --}}
                <div class="w-full bg-slate-100">

                    @if($tefa->gambar)
                        <img
                            src="{{ asset('gambar/tefa/' . $tefa->gambar) }}"
                            alt="{{ $tefa->nama_produk }}"
                            class="block h-[400px] md:h-[500px] w-full object-cover">
                    @else
                        <div class="flex h-[400px] md:h-[500px] w-full items-center justify-center bg-indigo-50">
                            <span class="text-6xl">✨</span>
                        </div>
                    @endif

                </div>


                {{-- TEKS PRODUK - BAGIAN BAWAH --}}
                <div class="p-6 md:p-10 text-left">

                    <h2 class="mb-4 text-2xl font-bold text-slate-900">
                        {{ $tefa->nama_produk }}    
                    </h2>


                    {{-- DESKRIPSI --}}
                    <p class="mb-8 leading-relaxed text-slate-600">
                        {{ $tefa->deskripsi }}
                    </p>


                    {{-- SPESIFIKASI --}}
                    <div class="rounded-xl bg-indigo-50 p-6">

                        <div class="grid grid-cols-[120px_1fr] gap-x-4 gap-y-5">

                            <strong class="text-slate-900">
                                Spesifikasi
                            </strong>

                            <span class="text-slate-600">
                                Layanan {{ $tefa->jurusan }}
                            </span>


                            <strong class="text-slate-900">
                                Durasi
                            </strong>

                            <span class="text-slate-600">
                                Hubungi kami untuk informasi lebih lanjut
                            </span>


                            <strong class="text-slate-900">
                                Mulai dari
                            </strong>

                            <strong class="text-slate-900">
                                Rp {{ number_format($tefa->harga, 0, ',', '.') }}
                            </strong>

                        </div>

                    </div>


                    {{-- TOMBOL BELI --}}
                    <button
                        type="button"
                        onclick="openPurchaseModal()"
                        class="mt-8 block w-full rounded-xl bg-indigo-600 py-4 text-center font-semibold text-white transition hover:bg-indigo-700">
                        Beli Sekarang
                    </button>

                </div>

            </div>

        </div>

    </main>

    <!-- MODAL FORM PEMBELIAN -->
    <div class="modal-overlay" id="formModal">
        <div class="modal-card">

            <button
                type="button"
                class="modal-close"
                onclick="closePurchaseModal()">
                ✕
            </button>

            <div class="modal-body">

                <h3>Form Pemesanan</h3>

                <p id="formServiceName">
                    {{ $tefa->nama_produk }}
                </p>

                <form onsubmit="submitForm(event)">

                    <div class="form-group">
                        <label for="nama">Nama Lengkap</label>

                        <input
                            type="text"
                            id="nama"
                            placeholder="Nama Anda"
                            required>
                    </div>


                    <div class="form-group">
                        <label for="email">Email</label>

                        <input
                            type="email"
                            id="email"
                            placeholder="nama@email.com"
                            required>
                    </div>


                    <div class="form-group">
                        <label for="whatsapp">Nomor WhatsApp</label>

                        <input
                            type="tel"
                            id="whatsapp"
                            placeholder="08xx-xxxx-xxxx"
                            required>
                    </div>


                    <div class="form-group">
                        <label for="catatan">
                            Catatan / Kebutuhan Proyek
                        </label>

                        <textarea
                            id="catatan"
                            placeholder="Ceritakan kebutuhan proyek Anda..."></textarea>
                    </div>


                    <button
                        type="submit"
                        class="btn-block">
                        Kirim Pesanan
                    </button>

                </form>

            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    <footer class="bg-blue-900 px-5 py-8 text-center text-white">

        <p class="text-sm text-blue-200">
            © 2026 TeFA SMKN 4 Tanjungpinang.
            Semua hak dilindungi.
        </p>

    </footer>

    <script>
        
        function openPurchaseModal() {
        document.getElementById('formModal').classList.add('active');
    }

    function closePurchaseModal() {
        document.getElementById('formModal').classList.remove('active');
    }


    async function submitForm(e) {
        e.preventDefault();

        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const wa = document.getElementById('whatsapp').value;
        const catatan = document.getElementById('catatan').value;

        try {

            const response = await fetch("{{ route('pesanan.store') }}", {
                method: "POST",

                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json"
                },

                body: JSON.stringify({

                    // ID PRODUK DIAMBIL LANGSUNG DARI DATABASE
                    id_produk: {{ $tefa->id_produk }},

                    nama_pemesan: nama,

                    email_pemesan: email,

                    no_hp_pemesan: wa,

                    catatan_pesanan: catatan
                })
            });


            const data = await response.json();


            if (!response.ok) {

                alert(
                    data.message ||
                    'Pesanan gagal disimpan.'
                );

                return;
            }


            alert('Pesanan berhasil dikirim!');

            closePurchaseModal();


            // Kosongkan form
            document.getElementById('nama').value = '';
            document.getElementById('email').value = '';
            document.getElementById('whatsapp').value = '';
            document.getElementById('catatan').value = '';


        } catch (error) {

            console.error(error);

            alert(
                'Terjadi kesalahan saat mengirim pesanan.'
            );
        }
    }

    </script>

</body>

</html>