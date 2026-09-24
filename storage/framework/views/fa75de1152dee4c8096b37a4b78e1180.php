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
      
      <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-3">
          <img
              src="<?php echo e(asset('gambar/tefa/logo.png')); ?>"
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


      
      <div class="flex items-center gap-4">

          
          <nav
              id="navMenu"
              class="hidden absolute top-[72px] left-0 right-0 flex-col gap-2 bg-white px-[5%] py-4 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-6 md:p-0 md:shadow-none">

              <a
                  href="<?php echo e(url('/')); ?>"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Beranda
              </a>

              <a
                  href="<?php echo e(route('katalog')); ?>"
                  class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
                  Layanan
              </a>

              <a
                  href="<?php echo e(route('cek.ticket')); ?>"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Cek Tiket
              </a>

              <a
                  href="<?php echo e(route('kontak')); ?>"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Kontak
              </a>

          </nav>


          
          <button
              type="button"
              class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-800 text-white shadow-md transition hover:bg-blue-900"
              aria-label="Profil">

              <svg
                  xmlns="http://www.w3.org/2000/svg"
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

          </button>

      </div>


      
      <button
          class="block md:hidden rounded-md bg-blue-700 px-3 py-2 text-lg text-white"
          onclick="toggleMenu()"
          aria-label="Buka Menu Navigasi">
          ☰
      </button>
  </header>

    <section class="bg-blue-800 px-5 py-15 text-center text-white py-14">
      <h1 class="mb-3 text-3xl font-bold">Katalog Layanan & Jurusan</h1>
      <p class="mb-6 text-sm md:text-base text-blue-200">Temukan layanan profesional dari 6 jurusan keahlian Teaching Factory SMKN 4 Tanjungpinang.</p>
    </section>

    <main class="mx-auto my-10 max-w-[1200px] px-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

            <!-- TKJ -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-emerald-700 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/tkj.png')); ?>" alt="Logo TKJ" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">TKJ</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Teknik Komputer dan Jaringan
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Instalasi jaringan, maintenance komputer, dan solusi IT infrastruktur.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.tkj')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
            </div>


            <!-- GIM -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-cyan-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/gim.png')); ?>" alt="Logo GIM" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">GIM</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Pengembangan Game
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Pengembangan game mobile, PC, dan game edukasi interaktif.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.gim')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
            </div>


            <!-- ANIMASI -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-blue-600 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/animasi.png')); ?>" alt="Logo ANIMASI" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">ANIMASI</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Animasi
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Animasi 2D/3D, motion graphic, ilustrasi, dan konten visual.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.animasi')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
            </div>


            <!-- RPL -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-orange-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/rpl.png')); ?>" alt="Logo RPL" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">RPL</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Rekayasa Perangkat Lunak
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Pengembangan aplikasi web, mobile, dan sistem informasi.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.rpl')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
            </div>


            <!-- DKV -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-red-600 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/dkv.png')); ?>" alt="Logo DKV" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">DKV</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Desain Komunikasi Visual
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Desain grafis, branding, ilustrasi, dan komunikasi visual kreatif.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.dkv')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
            </div>


            <!-- PSPT -->
            <div class="relative flex min-h-[250px] flex-col justify-between overflow-hidden rounded-xl border border-slate-200 border-t-4 border-t-yellow-400 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
                <div>
                    <div class="mb-4 flex h-14 w-14 items-center justify-center overflow-hidden rounded-lg bg-slate-50 border border-slate-200">
                        <img src="<?php echo e(asset('gambar/tefa/pspt.png')); ?>" alt="Logo PSPT" class="h-full w-full object-cover">
                    </div>

                    <h3 class="mb-1 text-xl font-bold text-slate-900">PSPT</h3>

                    <div class="mb-3 text-sm font-semibold text-blue-600">
                        Produksi Siaran Program Televisi
                    </div>

                    <p class="mb-6 text-sm text-slate-500 leading-relaxed">
                        Produksi video, dokumentasi acara, iklan, dan konten multimedia.
                    </p>
                </div>

                <div class="flex items-center justify-between text-xs text-slate-400">
                    <a href="<?php echo e(route('katalog.pspt')); ?>" class="font-semibold text-blue-600 hover:underline">
                        Lihat Layanan →
                    </a>
                </div>
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
</html> <?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2)/resources/views/public/katalog/index.blade.php ENDPATH**/ ?>