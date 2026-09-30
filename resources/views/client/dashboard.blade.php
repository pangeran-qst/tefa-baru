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
    <header class="sticky top-0 z-[1000] flex items-center justify-between bg-white px-[5%] md:px-[8%] py-4 shadow-sm">
        {{-- LOGO --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img
              src="{{ asset('gambar/tefa/logo.png') }}"
              alt=""
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


      {{-- BAGIAN KANAN --}}
        <div class="flex items-center gap-4">
          {{-- NAVIGASI --}}
            <nav
              id="navMenu"
              class="hidden absolute top-[72px] left-0 right-0 flex-col gap-2 bg-white px-[5%] py-4 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-6 md:p-0 md:shadow-none">

              {{-- BERANDA --}}
              <a
                  href="{{ url('/') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Beranda
              </a>

              {{-- LAYANAN --}}
              <a
                  href="{{ route('katalog') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Layanan
              </a>

              {{-- CEK TIKET --}}
              <a
                  href="{{ route('cek.ticket') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Cek Tiket
              </a>

              {{-- KONTAK --}}
              <a
                  href="{{ route('kontak') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Kontak
              </a>
            </nav>

            {{-- PROFILE BUTTON --}}
            <a href="{{ route('client.dashboard') }}"
                class="flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-700 text-white text-sm font-semibold hover:bg-blue-800 transition">

                <span
                    class="w-7 h-7 rounded-full bg-white/20 flex items-center justify-center">
                    {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                </span>

                <span>
                    Profil
                </span>

            </a>

        </div>
    </header>


    {{-- MAIN --}}
    <main class="max-w-7xl mx-auto px-5 md:px-[8%] py-10">

        {{-- GREETING --}}
        <section class="mb-8">

            <p class="text-sm font-semibold text-blue-700 mb-2">
                Profil Pembeli
            </p>

            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">
                Halo, {{ Auth::user()->nama }} 👋
            </h2>

            <p class="text-slate-500 mt-2">
                Kelola akun dan pantau layanan TeFA yang kamu pesan.
            </p>

        </section>


        {{-- CONTENT --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PROFILE CARD --}}
            <div class="lg:col-span-1">

                <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

                    <div class="flex items-center gap-4 mb-6">

                        <div
                            class="w-14 h-14 rounded-full bg-blue-100 text-blue-700 flex items-center justify-center text-xl font-bold">

                            {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}

                        </div>

                        <div>

                            <h3 class="font-bold text-slate-900">
                                {{ Auth::user()->nama }}
                            </h3>

                            <p class="text-sm text-slate-500">
                                Client / Pembeli
                            </p>

                        </div>

                    </div>


                    <div class="space-y-4">

                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">
                                Email
                            </p>

                            <p class="text-sm text-slate-700 mt-1">
                                {{ Auth::user()->email }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">
                                Nomor HP
                            </p>

                            <p class="text-sm text-slate-700 mt-1">
                                {{ Auth::user()->no_hp ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs font-semibold text-slate-400 uppercase">
                                Alamat
                            </p>

                            <p class="text-sm text-slate-700 mt-1">
                                {{ Auth::user()->alamat ?? '-' }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- MENU CLIENT --}}
            <div class="lg:col-span-2">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                    {{-- PESANAN --}}
                    <a href="#"
                        class="group bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition">

                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-5">
                            📦
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                            Pesanan Saya
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Lihat layanan yang sudah kamu pesan dan status pengerjaannya.
                        </p>

                        <div class="mt-5 text-sm font-semibold text-blue-700">
                            Lihat Pesanan →
                        </div>

                    </a>


                    {{-- TICKET --}}
                    <a href="{{ route('cek.ticket') }}"
                        class="group bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition">

                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-5">
                            🎫
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                            Tiket & Tracking
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Cek perkembangan dan status pesanan berdasarkan tiket.
                        </p>

                        <div class="mt-5 text-sm font-semibold text-blue-700">
                            Cek Tracking →
                        </div>

                    </a>


                    {{-- KATALOG --}}
                    <a href="{{ route('katalog') }}"
                        class="group bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition">

                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-5">
                            🛍️
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                            Lihat Layanan
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Jelajahi produk dan layanan yang tersedia di TeFA SMKN 4.
                        </p>

                        <div class="mt-5 text-sm font-semibold text-blue-700">
                            Buka Katalog →
                        </div>

                    </a>


                    {{-- KONTAK --}}
                    <a href="{{ route('kontak') }}"
                        class="group bg-white rounded-2xl border border-slate-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition">

                        <div
                            class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center text-xl mb-5">
                            💬
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 group-hover:text-blue-700 transition">
                            Hubungi Kami
                        </h3>

                        <p class="text-sm text-slate-500 mt-2 leading-relaxed">
                            Butuh informasi atau bantuan terkait layanan TeFA?
                        </p>

                        <div class="mt-5 text-sm font-semibold text-blue-700">
                            Hubungi TeFA →
                        </div>

                    </a>

                </div>

            </div>

        </div>

    </main>


    {{-- FOOTER --}}
    <footer class="bg-blue-900 text-white mt-16">

        <div class="max-w-7xl mx-auto px-5 md:px-[8%] py-8">

            <div class="flex flex-col md:flex-row items-center justify-between gap-4">

                <div>
                    <h3 class="font-bold">
                        TeFA SMKN 4
                    </h3>

                    <p class="text-sm text-blue-200 mt-1">
                        Teaching Factory SMKN 4 Tanjungpinang
                    </p>
                </div>


                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button
                        type="submit"
                        class="px-5 py-2.5 rounded-xl bg-white text-blue-900 text-sm font-semibold hover:bg-blue-50 transition">
                        Logout
                    </button>

                </form>

            </div>

        </div>

    </footer>

</body>

</html>