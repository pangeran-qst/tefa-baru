<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Produk - TeFA SMKN 4 Tanjungpinang</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-50 text-slate-700 font-sans antialiased">

    {{-- HEADER --}}
    <header class="sticky top-0 z-50 flex items-center justify-between bg-white px-[5%] md:px-[8%] py-4 shadow-sm">

        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3">

            <img
                src="{{ asset('gambar/tefa/logo.png') }}"
                alt="Logo TeFA"
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


        {{-- TOMBOL KEMBALI --}}
        <a
            href="{{ route('katalog') }}"
            class="rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-800">
            ← Kembali ke Katalog
        </a>

    </header>


    {{-- KONTEN DETAIL PRODUK --}}
    <main class="px-5 md:px-[8%] py-10 md:py-16">

        <div class="max-w-6xl mx-auto">

            {{-- JUDUL HALAMAN --}}
            <div class="mb-8">

                <p class="text-sm font-semibold text-blue-600 uppercase">
                    Detail Produk
                </p>

                <h1 class="mt-2 text-3xl md:text-4xl font-bold text-slate-900">
                    Design Karakter 2D
                </h1>

            </div>


            {{-- CARD DETAIL --}}
            <div class="overflow-hidden rounded-2xl bg-white shadow-xl">

                <div class="grid grid-cols-1 md:grid-cols-2">


                    {{-- GAMBAR PRODUK --}}
                    <div class="flex min-h-[400px] items-center justify-center bg-slate-100 p-6 md:p-10">

                        <img
                            src="{{ asset('gambar/tefa/1790351987_jsa rpl web.jpeg') }}"
                            alt="Design Karakter 2D"
                            class="max-h-[400px] w-full rounded-xl object-contain">

                    </div>


                    {{-- INFORMASI PRODUK --}}
                    <div class="p-6 md:p-10">

                        <h2 class="mb-4 text-2xl font-bold text-slate-900">
                            Design Karakter 2D
                        </h2>


                        {{-- DESKRIPSI --}}
                        <p class="mb-8 leading-relaxed text-slate-600">
                            Jasa pembuatan karakter 2D dengan desain dan gaya visual
                            yang dapat disesuaikan dengan konsep, cerita, atau
                            kebutuhan pelanggan.
                        </p>


                        {{-- SPESIFIKASI --}}
                        <div class="rounded-xl bg-indigo-50 p-6">

                            <div class="grid grid-cols-[120px_1fr] gap-x-4 gap-y-5">

                                <strong class="text-slate-900">
                                    Spesifikasi
                                </strong>

                                <span class="text-slate-600">
                                    Layanan ANIMASI
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
                                    Rp 0
                                </strong>

                            </div>

                        </div>


                        {{-- TOMBOL BELI --}}
                        <a
                            href="#"
                            class="mt-8 block w-full rounded-xl bg-indigo-600 py-4 text-center font-semibold text-white transition hover:bg-indigo-700">
                            Beli
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="bg-blue-900 px-5 py-8 text-center text-white">

        <p class="text-sm text-blue-200">
            © 2026 TeFA SMKN 4 Tanjungpinang.
            Semua hak dilindungi.
        </p>

    </footer>

</body>

</html>