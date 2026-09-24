<?php $__env->startSection('title', 'Produk / Layanan'); ?>

<?php $__env->startSection('content'); ?>

  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- MAIN CONTENT -->
  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    <div class="mb-6">
      <h1 class="text-2xl font-bold text-slate-800">Transaksi & Laporan BLUD</h1>
      <p class="text-xs text-slate-500 mt-1">Rekap keuangan dan kepatuhan administrasi BLUD sekolah</p>
    </div>

    <!-- CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center text-xl shrink-0">
          💳
        </div>
        <div>
          <span class="text-[11px] text-slate-400 font-medium block">Total Transaksi Bulan Ini</span>
          <span class="text-base font-bold text-indigo-900">Rp 31.200.000</span>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shrink-0">
          ✅
        </div>
        <div>
          <span class="text-[11px] text-slate-400 font-medium block">Transaksi Lunas</span>
          <span class="text-base font-bold text-emerald-600">42 Kuitansi</span>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl shrink-0">
          ⏳
        </div>
        <div>
          <span class="text-[11px] text-slate-400 font-medium block">Pending Pelunasan</span>
          <span class="text-base font-bold text-amber-600">5 Pesanan</span>
        </div>
      </div>

      <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl shrink-0">
          📈
        </div>
        <div>
          <span class="text-[11px] text-slate-400 font-medium block">Omset YTD 2026</span>
          <span class="text-base font-bold text-indigo-600">Rp 187,4 Jt</span>
        </div>
      </div>
    </div>

    <!-- TABLE AREA -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center gap-3 text-xs">
          <span class="text-slate-500 font-medium">Dari</span>
          <div class="relative">
            <input type="text" value="01/08/2026" class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 w-36 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            <span class="absolute right-3 top-2.5 text-slate-400 pointer-events-none">📅</span>
          </div>

          <span class="text-slate-500 font-medium">Sampai</span>
          <div class="relative">
            <input type="text" value="25/08/2026" class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700 w-36 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            <span class="absolute right-3 top-2.5 text-slate-400 pointer-events-none">📅</span>
          </div>

          <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-5 py-2 rounded-xl text-xs transition shadow-sm">
            Tampilkan
          </button>
        </div>

        <div class="flex items-center gap-2">
          <button class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 transition shadow-sm">
            📥 Export Excel
          </button>
          <button class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 transition shadow-sm">
            📥 Export PDF
          </button>
        </div>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">
              <th class="py-4 px-6 font-semibold">No. Invoice</th>
              <th class="py-4 px-6 font-semibold">Order</th>
              <th class="py-4 px-6 font-semibold">Klien</th>
              <th class="py-4 px-6 font-semibold">Layanan</th>
              <th class="py-4 px-6 font-semibold">Jurusan</th>
              <th class="py-4 px-6 font-semibold">Tanggal</th>
              <th class="py-4 px-6 font-semibold text-right">Jumlah</th>
              <th class="py-4 px-6 font-semibold text-center">Tipe</th>
              <th class="py-4 px-6 font-semibold text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-50 text-xs text-slate-600">
            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-4 px-6 font-semibold text-indigo-600">INV-2026-0047</td>
              <td class="py-4 px-6 text-slate-400 font-medium">#TF-2878</td>
              <td class="py-4 px-6 font-semibold text-slate-700">SMKN 1 Tanjungpinang</td>
              <td class="py-4 px-6">Sistem Informasi Siswa</td>
              <td class="py-4 px-6"><span class="bg-indigo-50 text-indigo-600 font-bold px-2 py-0.5 rounded text-[11px]">RPL</span></td>
              <td class="py-4 px-6 text-slate-400">20 Agu 2026</td>
              <td class="py-4 px-6 text-right font-bold text-slate-800">Rp 9.000.000</td>
              <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 font-medium px-3 py-1 rounded-full text-[11px]">Lunas</span></td>
              <td class="py-4 px-6 text-center"><button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg font-semibold text-[11px]">Cetak</button></td>
            </tr>

            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-4 px-6 font-semibold text-indigo-600">INV-2026-0046</td>
              <td class="py-4 px-6 text-slate-400 font-medium">#TF-2870</td>
              <td class="py-4 px-6 font-semibold text-slate-700">PT Batam Teknologi</td>
              <td class="py-4 px-6">UI/UX Design</td>
              <td class="py-4 px-6"><span class="bg-indigo-50 text-indigo-600 font-bold px-2 py-0.5 rounded text-[11px]">DKV</span></td>
              <td class="py-4 px-6 text-slate-400">18 Agu 2026</td>
              <td class="py-4 px-6 text-right font-bold text-slate-800">Rp 3.800.000</td>
              <td class="py-4 px-6 text-center"><span class="bg-emerald-100 text-emerald-700 font-medium px-3 py-1 rounded-full text-[11px]">Lunas</span></td>
              <td class="py-4 px-6 text-center"><button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg font-semibold text-[11px]">Cetak</button></td>
            </tr>

            <tr class="hover:bg-slate-50/50 transition">
              <td class="py-4 px-6 font-semibold text-indigo-600">INV-2026-0044</td>
              <td class="py-4 px-6 text-slate-400 font-medium">#TF-2884</td>
              <td class="py-4 px-6 font-semibold text-slate-700">PT Kepri Digital</td>
              <td class="py-4 px-6">Website E-commerce (DP)</td>
              <td class="py-4 px-6"><span class="bg-indigo-50 text-indigo-600 font-bold px-2 py-0.5 rounded text-[11px]">RPL</span></td>
              <td class="py-4 px-6 text-slate-400">14 Agu 2026</td>
              <td class="py-4 px-6 text-right font-bold text-slate-800">Rp 7.500.000</td>
              <td class="py-4 px-6 text-center">
                <div class="inline-flex flex-col items-center">
                  <span class="bg-amber-100 text-amber-700 font-semibold px-2.5 py-0.5 rounded-full text-[10px]">DP</span>
                  <span class="text-[10px] text-amber-600 font-semibold mt-0.5">50%</span>
                </div>
              </td>
              <td class="py-4 px-6 text-center"><button class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg font-semibold text-[11px]">Cetak</button></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="bg-indigo-50/60 border-t border-indigo-100 p-6 flex justify-between items-center">
        <span class="font-bold text-indigo-900 text-sm">Total Periode</span>
        <span class="font-bold text-indigo-600 text-lg">Rp 31.200.000</span>
      </div>
    </div>
  </main>
  
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.tefa.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa/resources/views/admin/tefa/transaksi.blade.php ENDPATH**/ ?>