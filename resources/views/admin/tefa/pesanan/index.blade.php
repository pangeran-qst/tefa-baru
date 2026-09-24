@extends('admin.tefa.layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    <!-- Title Header -->
    <div class="mb-8">
      <h1 class="text-2xl font-bold text-slate-800">Manajemen Pesanan</h1>
      <p class="text-xs text-slate-500 mt-1">Kelola alur masuk, verifikasi, disposisi, dan penyelesaian pesanan</p>
    </div>

    <!-- Filter Tabs Navigation -->
    @php
    $jumlahPesananBaru = $pesanans->where('status', 'pending')->count();
    $jumlahDalamPengerjaan = $pesanans->where('status', 'in_progress')->count();
    $jumlahSelesai = $pesanans->where('status', 'completed')->count();
    $jumlahDibatalkan = $pesanans->where('status', 'cancelled')->count();
    @endphp

    <div class="flex flex-wrap gap-3 mb-6">

        {{-- PESANAN BARU --}}
        <button
            type="button"
            onclick="filterPesanan('pending')"
            class="status-filter px-6 py-3 rounded-xl bg-orange-500 text-white font-semibold text-xs shadow-sm transition"
            data-status="pending">
            Pesanan Baru
            <span class="ml-1 opacity-90">
                {{ $jumlahPesananBaru }}
            </span>
        </button>

        {{-- MENUNGGU RESPONS --}}
        <button
            type="button"
            onclick="filterPesanan('pending')"
            class="status-filter px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition"
            data-status="pending">
            Menunggu Respons
            <span class="ml-1 text-slate-400">
                {{ $jumlahPesananBaru }}
            </span>
        </button>

        {{-- DALAM PENGERJAAN --}}
        <button
            type="button"
            onclick="filterPesanan('in_progress')"
            class="status-filter px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition"
            data-status="in_progress">
            Dalam Pengerjaan
            <span class="ml-1 text-slate-400">
                {{ $jumlahDalamPengerjaan }}
            </span>
        </button>

        {{-- SELESAI --}}
        <button
            type="button"
            onclick="filterPesanan('completed')"
            class="status-filter px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition"
            data-status="completed">
            Selesai
            <span class="ml-1 text-slate-400">
                {{ $jumlahSelesai }}
            </span>
        </button>

        {{-- DITOLAK / BATAL --}}
        <button
            type="button"
            onclick="filterPesanan('cancelled')"
            class="status-filter px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-semibold text-xs hover:bg-slate-50 transition"
            data-status="cancelled">
            Ditolak/Batal
            <span class="ml-1 text-slate-400">
                {{ $jumlahDibatalkan }}
            </span>
        </button>

    </div>

    <!-- TAB 1: PESANAN BARU -->
    <div id="tab-baru" class="tab-content">
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
            <tr>
              <th class="py-4 px-3">ID Pesanan</th>
              <th class="py-4 px-3">Klien</th>
              <th class="py-4 px-3">Layanan</th>
              <th class="py-4 px-3">Tanggal</th>
              <th class="py-4 px-3">Nilai</th>
              <th class="py-4 px-3">Status</th>
              <th class="py-4 px-3 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($pesanans as $pesanan)
                <tr class="hover:bg-slate-50 transition">

                    {{-- ID PESANAN --}}
                    <td class="py-3.5 px-3">
                        <span class="font-bold text-indigo-600">
                            #TF-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                        </span>
                    </td>

                    {{-- KLIEN --}}
                    <td class="py-3.5 px-3">
                        <div class="font-semibold text-slate-800">
                            {{ $pesanan->nama_pemesan }}
                        </div>

                        <div class="text-[10px] text-slate-400 mt-0.5">
                            {{ $pesanan->email_pemesan }}
                        </div>
                    </td>

                    {{-- LAYANAN --}}
                    <td class="py-3.5 px-3">
                        <div class="font-semibold text-slate-800">
                            {{ $pesanan->tefa->nama_produk ?? '-' }}
                        </div>

                        <div class="text-[10px] text-slate-400 mt-0.5">
                            {{ $pesanan->tefa->jurusan ?? '-' }}
                        </div>
                    </td>

                    {{-- TANGGAL --}}
                    <td class="py-3.5 px-3 text-slate-600">
                        {{ $pesanan->tanggal_pesan?->format('d M Y') }}
                        <div class="text-[10px] text-slate-400">
                            {{ $pesanan->tanggal_pesan?->format('H:i') }}
                        </div>
                    </td>

                    {{-- NILAI --}}
                    <td class="py-3.5 px-3">
                        <span class="font-semibold text-slate-800">
                            Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}
                        </span>
                    </td>

                    {{-- STATUS --}}
                    <td class="py-3.5 px-3">
                        @if ($pesanan->status === 'pending')

                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-amber-50 text-amber-600 font-semibold text-[10px]">
                                Pending
                            </span>

                        @elseif ($pesanan->status === 'in_progress')

                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-blue-50 text-blue-600 font-semibold text-[10px]">
                                Diproses
                            </span>

                        @elseif ($pesanan->status === 'completed')

                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">
                                Selesai
                            </span>

                        @elseif ($pesanan->status === 'cancelled')

                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-red-50 text-red-600 font-semibold text-[10px]">
                                Dibatalkan
                            </span>

                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="py-3.5 px-3">
                        <div class="flex items-center justify-end gap-2">

                            <button
                                type="button"
                                class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition"
                                onclick="lihatPesanan(
                                    {{ $pesanan->id_pesanan }},
                                    @js($pesanan->nama_pemesan),
                                    @js($pesanan->email_pemesan),
                                    @js($pesanan->no_hp_pemesan),
                                    @js($pesanan->catatan_pesanan),
                                    @js($pesanan->tefa->nama_produk ?? '-'),
                                    {{ $pesanan->total_harga }},
                                    @js($pesanan->status)
                                )">
                                Detail
                            </button>

                        </div>
                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="py-12 text-center text-slate-400">
                        Belum ada pesanan.
                    </td>
                </tr>

            @endforelse
        </tbody>
        </table>
      </div>
    </div>

    <!-- TAB 2: MENUNGGU RESPONS -->
    <div id="tab-menunggu" class="tab-content hidden">
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead>
            <tr>
                <th class="w-[13%] text-left">ID PESANAN</th>
                <th class="w-[19%] text-left">KLIEN</th>
                <th class="w-[21%] text-left">LAYANAN</th>
                <th class="w-[14%] text-left">TANGGAL</th>
                <th class="w-[13%] text-left">NILAI</th>
                <th class="w-[10%] text-left">STATUS</th>
                <th class="w-[10%] text-center">AKSI</th>
            </tr>
        </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50/50 transition">
              <td class="p-4 font-bold text-indigo-600">#TF-2888</td>
              <td class="p-4 font-bold text-slate-800">PT Riau Inovasi</td>
              <td class="p-4 text-slate-600">API Service Integration</td>
              <td class="p-4"><span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2.5 py-1 rounded-md">RPL</span></td>
              <td class="p-4 font-bold text-slate-800">Rp 5.500.000</td>
              <td class="p-4"><span class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Menunggu Kajur</span></td>
            </tr>
            <tr class="hover:bg-slate-50/50 transition">
              <td class="p-4 font-bold text-indigo-600">#TF-2885</td>
              <td class="p-4 font-bold text-slate-800">Yayasan Al-Hikmah</td>
              <td class="p-4 text-slate-600">Mobile App — Absensi</td>
              <td class="p-4"><span class="bg-indigo-100 text-indigo-700 text-[10px] font-bold px-2.5 py-1 rounded-md">RPL</span></td>
              <td class="p-4 font-bold text-slate-800">Rp 8.000.000</td>
              <td class="p-4"><span class="bg-blue-50 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Menunggu Kajur</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- TAB 3: DALAM PENGERJAAN -->
    <div id="tab-pengerjaan" class="tab-content hidden">
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">
        <table class="w-full table-fixed">
          <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
            <tr>
              <th class="p-4">ID / Jurusan</th>
              <th class="p-4">Klien & Layanan</th>
              <th class="p-4">QC Guru</th>
              <th class="p-4">Pembayaran</th>
              <th class="p-4">Progress</th>
              <th class="p-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50/50 transition">
              <td class="p-4">
                <div class="font-bold text-indigo-600">#TF-2884</div>
                <div class="text-[11px] text-slate-400">RPL</div>
              </td>
              <td class="p-4">
                <div class="font-bold text-slate-800">PT Kepri Digital</div>
                <div class="text-[11px] text-slate-500">Website E-commerce</div>
              </td>
              <td class="p-4"><span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">OK</span></td>
              <td class="p-4"><span class="bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-1 rounded-full">DP 50%</span></td>
              <td class="p-4">
                <div class="flex items-center gap-2">
                  <div class="w-16 bg-slate-200 h-1.5 rounded-full overflow-hidden">
                    <div class="bg-indigo-600 h-full w-3/4"></div>
                  </div>
                  <span class="text-[11px] font-semibold text-slate-600">75%</span>
                </div>
              </td>
              <td class="p-4 text-right">
                <button class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs px-3 py-1.5 rounded-lg transition">Kuitansi</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- TAB 4: SELESAI -->
    <div id="tab-selesai" class="tab-content hidden">
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
            <tr>
              <th class="p-4">ID Pesanan</th>
              <th class="p-4">Klien</th>
              <th class="p-4">Layanan</th>
              <th class="p-4">Nilai Total</th>
              <th class="p-4">Status Bayar</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50/50 transition">
              <td class="p-4 font-bold text-indigo-600">#TF-2800</td>
              <td class="p-4 font-bold text-slate-800">Dinas Pariwisata</td>
              <td class="p-4 text-slate-600">Video Promo Destinasi</td>
              <td class="p-4 font-bold text-slate-800">Rp 15.000.000</td>
              <td class="p-4"><span class="bg-emerald-100 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">Lunas</span></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- TAB 5: DITOLAK -->
    <div id="tab-ditolak" class="tab-content hidden">
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[11px] tracking-wider">
            <tr>
              <th class="p-4">ID Pesanan</th>
              <th class="p-4">Klien</th>
              <th class="p-4">Layanan</th>
              <th class="p-4">Alasan Penolakan</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            <tr class="hover:bg-slate-50/50 transition">
              <td class="p-4 font-bold text-rose-500 line-through">#TF-2870</td>
              <td class="p-4 font-bold text-slate-800">Toko Berkah</td>
              <td class="p-4 text-slate-600">Cetak Baliho Besar</td>
              <td class="p-4 text-rose-600 font-medium">Kapasitas mesin penuh</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </main>

  <!-- SCRIPT SWITCH TAB -->
  <script>
    function switchTab(tabId) {
      // Sembunyikan semua tab content
      document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
      
      // Reset style semua tombol tab
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.className = "tab-btn px-4 py-2.5 rounded-xl text-xs font-semibold transition-all flex items-center gap-2 bg-white text-slate-600 border border-slate-200 hover:bg-slate-50";
        const badge = btn.querySelector('span');
        if (badge) badge.className = "bg-slate-100 text-slate-600 text-[10px] px-2 py-0.5 rounded-full";
      });

      // Tampilkan tab terpilih
      document.getElementById('tab-' + tabId).classList.remove('hidden');

      // Set style tombol tab yang aktif
      const activeBtn = document.getElementById('btn-' + tabId);
      const activeBadge = activeBtn.querySelector('span');

      const colorMap = {
        'baru': 'bg-amber-500 text-white shadow-md shadow-amber-500/20',
        'menunggu': 'bg-blue-600 text-white shadow-md shadow-blue-600/20',
        'pengerjaan': 'bg-purple-600 text-white shadow-md shadow-purple-600/20',
        'selesai': 'bg-emerald-600 text-white shadow-md shadow-emerald-600/20',
        'ditolak': 'bg-rose-600 text-white shadow-md shadow-rose-600/20'
      };

      activeBtn.className = `tab-btn px-4 py-2.5 rounded-xl text-xs font-semibold transition-all flex items-center gap-2 ${colorMap[tabId]}`;
      if (activeBadge) activeBadge.className = "bg-white/20 text-white text-[10px] px-2 py-0.5 rounded-full";
    }
  </script>
  
@endsection