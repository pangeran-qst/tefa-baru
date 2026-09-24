<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cek Tiket - TeFA SMKN 4 Tanjungpinang</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col min-h-screen bg-slate-50 font-sans text-slate-700 antialiased leading-relaxed">

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
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Layanan
              </a>

              <a
                  href="<?php echo e(route('cek.ticket')); ?>"
                  class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
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

  <main class="flex-1 px-[5%] md:px-[8%] py-10 md:py-[60px]">
    <div class="mx-auto mb-9 max-w-[600px] text-center">
      <h1 class="mb-2 text-2xl md:text-3xl font-bold text-slate-900">Cek Status Pesanan</h1>
      <p class="text-sm md:text-base text-slate-500">Masukkan kode ticket Anda untuk memantau pengerjaan proyek secara online.</p>
    </div>

    <div class="mx-auto max-w-[580px] rounded-xl border border-slate-200 bg-white p-6 md:p-8 shadow-sm">
      <div class="flex flex-col md:flex-row gap-2.5">
        <input 
          type="text" 
          id="tiketInput" 
          placeholder="Contoh: TF-0001" 
          autocomplete="off" 
          class="flex-1 rounded-lg border border-slate-300 px-4 py-3 text-sm outline-none transition focus:border-blue-600 focus:ring-2 focus:ring-blue-600/20"
        />
        <button 
          class="rounded-lg bg-blue-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-blue-700 w-full md:w-auto" 
          onclick="cekTiket()"
        >
          Cek Tiket
        </button>
      </div>

      <div
        id="hasilTiket"
        class="mt-5 rounded-lg p-4 text-sm leading-relaxed
        <?php echo e(isset($pesanan) ? '' : 'hidden'); ?>

        <?php echo e(isset($pesanan)
            ? 'bg-emerald-50 border border-emerald-200 text-emerald-800'
            : ''); ?>">

        <?php if(isset($pesanan)): ?>

            <?php
                $statusLabel = [
                    'pending' => 'Menunggu Respons',
                    'in_progress' => 'Sedang Dikerjakan',
                    'completed' => 'Selesai',
                    'cancelled' => 'Dibatalkan',
                ];
            ?>

            <strong>
                Nomor Tiket: #TF-<?php echo e(str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT)); ?>

            </strong>

            <br>

            📌 Layanan:
            <strong>
                <?php echo e($pesanan->tefa->nama_produk ?? '-'); ?>

            </strong>

            <br>

            👤 Pemesan:
            <?php echo e($pesanan->nama_pemesan); ?>


            <br>

            📅 Tanggal:
            <?php echo e($pesanan->tanggal_pesan?->format('d M Y, H:i')); ?>


            <br>

            💰 Total:
            Rp <?php echo e(number_format($pesanan->total_harga, 0, ',', '.')); ?>


            <br>

            📌 Status:
            <strong>
                <?php echo e($statusLabel[$pesanan->status] ?? $pesanan->status); ?>

            </strong>

        <?php elseif(request()->filled('ticket')): ?>

            <div class="text-red-800">
                ❌ Tiket
                <strong>"<?php echo e(request('ticket')); ?>"</strong>
                tidak ditemukan.
            </div>

        <?php endif; ?>
      </div>
    </div>
  </main>

  <footer class="mt-[60px] bg-blue-900 px-[5%] md:px-[8%] pt-10 pb-5 text-white">
    <div class="mb-10 flex flex-wrap justify-between gap-8">
      <div>
        <h3 class="mb-2 text-lg font-bold">TeFA SMKN 4 Tanjungpinang</h3>
        <p class="text-xs text-blue-300">Teaching Factory</p>
        <p class="mt-3 max-w-[300px] text-xs text-slate-300">
          Produk dan jasa profesional karya siswa SMKN 4 Tanjungpinang yang terlatih dan bersertifikat.
        </p>
      </div>

      <div>
        <h4 class="mb-4 text-sm font-bold">Kontak &amp; Lokasi</h4>
        <ul class="space-y-2 text-xs text-slate-300">
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
      const nav = document.getElementById("navMenu");
      nav.classList.toggle("hidden");
      nav.classList.toggle("flex");
    }

    document.getElementById("tiketInput").addEventListener("keypress", function (event) {
      if (event.key === "Enter") {
        cekTiket();
      }
    });

    function cekTiket() {
    const input = document.getElementById("tiketInput");
    const hasil = document.getElementById("hasilTiket");
    const kode = input.value.trim().toUpperCase();

    hasil.classList.remove("hidden");

    if (!kode) {
        hasil.className =
            "mt-5 rounded-lg p-4 text-sm leading-relaxed bg-red-50 border border-red-200 text-red-800";

        hasil.innerHTML =
            "⚠️ Silakan masukkan nomor tiket terlebih dahulu.";

        return;
    }

    fetch("<?php echo e(route('cek.ticket')); ?>?ticket=" + encodeURIComponent(kode))
        .then(response => response.text())
        .then(html => {

            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");

            const hasilServer = doc.getElementById("hasilTiket");

            if (hasilServer) {
                hasil.innerHTML = hasilServer.innerHTML;
                hasil.className = hasilServer.className;
            }

        })
        .catch(error => {
            console.error(error);

            hasil.className =
                "mt-5 rounded-lg p-4 text-sm leading-relaxed bg-red-50 border border-red-200 text-red-800";

            hasil.innerHTML =
                "❌ Terjadi kesalahan saat mengecek tiket.";
        });
}
  </script>

</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa/resources/views/public/katalog/cek-ticket.blade.php ENDPATH**/ ?>