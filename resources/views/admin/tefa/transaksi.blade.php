@extends('admin.tefa.layouts.app')

@section('title', 'Produk / Layanan')

@section('content')

  
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

        {{-- TOTAL TRANSAKSI --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-sky-50 text-sky-500 flex items-center justify-center text-xl shrink-0">
                💳
            </div>

            <div>
                <span class="text-[11px] text-slate-400 font-medium block">
                    Total Transaksi
                </span>

                <span class="text-base font-bold text-indigo-900">
                    Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
                </span>
            </div>
        </div>


        {{-- TRANSAKSI LUNAS --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-500 flex items-center justify-center text-xl shrink-0">
                ✅
            </div>

            <div>
                <span class="text-[11px] text-slate-400 font-medium block">
                    Transaksi Lunas
                </span>

                <span class="text-base font-bold text-emerald-600">
                    {{ $transaksiLunas }} Transaksi
                </span>
            </div>
        </div>


        {{-- PENDING PELUNASAN --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-500 flex items-center justify-center text-xl shrink-0">
                ⏳
            </div>

            <div>
                <span class="text-[11px] text-slate-400 font-medium block">
                    Pending Pelunasan
                </span>

                <span class="text-base font-bold text-amber-600">
                    {{ $pendingPelunasan }} Pesanan
                </span>
            </div>
        </div>


        {{-- TOTAL PEMBAYARAN --}}
        <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-500 flex items-center justify-center text-xl shrink-0">
                📈
            </div>

            <div>
                <span class="text-[11px] text-slate-400 font-medium block">
                    Total Pembayaran
                </span>

                <span class="text-base font-bold text-indigo-600">
                    Rp {{ number_format($omset, 0, ',', '.') }}
                </span>
            </div>
        </div>

    </div>

    <!-- TABLE AREA -->
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">
      <div class="p-6 border-b border-slate-100 flex flex-wrap items-center justify-between gap-4">

        {{-- FILTER TANGGAL --}}
        <form
            action="{{ route('admin.tefa.transaksi') }}"
            method="GET"
            class="flex items-center gap-3 text-xs">

            <span class="text-slate-500 font-medium">
                Dari
            </span>

            <div class="relative">
                <input
                    type="date"
                    name="tanggal_dari"
                    value="{{ $tanggalDari }}"
                    class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700
                          w-36 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            </div>


            <span class="text-slate-500 font-medium">
                Sampai
            </span>

            <div class="relative">
                <input
                    type="date"
                    name="tanggal_sampai"
                    value="{{ $tanggalSampai }}"
                    class="bg-white border border-slate-200 rounded-xl px-3 py-2 text-xs text-slate-700
                          w-36 focus:outline-none focus:ring-2 focus:ring-indigo-500/20">
            </div>


            <button
                type="submit"
                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold
                      px-5 py-2 rounded-xl text-xs transition shadow-sm">
                Tampilkan
            </button>

        </form>


        {{-- EXPORT --}}
        <div class="flex items-center gap-2">

            <a href="{{ route('admin.tefa.transaksi.excel', [ 'tanggal_dari' => $tanggalDari, 'tanggal_sampai' => $tanggalSampai ]) }}" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 transition shadow-sm">
              📥 Export Excel
            </a>

            <a href="{{ route('admin.tefa.transaksi.pdf', [ 'tanggal_dari' => $tanggalDari, 'tanggal_sampai' => $tanggalSampai ]) }}" target="_blank" class="bg-rose-500 hover:bg-rose-600 text-white font-semibold px-4 py-2 rounded-xl text-xs flex items-center gap-1.5 transition shadow-sm">
              📥 Export PDF
            </a>

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

            @forelse($transaksi as $pesanan)

                @php
                    $hargaFinal = $pesanan->harga_final ?? 0;
                    $sudahDibayar = $pesanan->nominal_dibayar ?? 0;
                    $sisa = max($hargaFinal - $sudahDibayar, 0);
                @endphp

                <tr class="hover:bg-slate-50/50 transition">

                    {{-- NO. INVOICE --}}
                    <td class="py-4 px-6 font-semibold text-indigo-600">
                        INV-{{ date('Y', strtotime($pesanan->tanggal_pesan)) }}-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                    </td>


                    {{-- ORDER --}}
                    <td class="py-4 px-6 text-slate-400 font-medium">
                        #{{ $pesanan->id_pesanan }}
                    </td>


                    {{-- KLIEN --}}
                    <td class="py-4 px-6 font-semibold text-slate-700">
                        {{ $pesanan->nama_pemesan }}
                    </td>


                    {{-- LAYANAN --}}
                    <td class="py-4 px-6">
                        {{ $pesanan->tefa->nama_produk ?? '-' }}
                    </td>


                    {{-- JURUSAN --}}
                    <td class="py-4 px-6">

                        <span class="bg-indigo-50 text-indigo-600 font-bold px-2 py-0.5 rounded text-[11px]">
                            {{ $pesanan->tefa->jurusan ?? '-' }}
                        </span>

                    </td>


                    {{-- TANGGAL --}}
                    <td class="py-4 px-6 text-slate-400 whitespace-nowrap">
                        {{ $pesanan->tanggal_pesan
                            ? $pesanan->tanggal_pesan->format('d M Y')
                            : '-' }}
                    </td>


                    {{-- JUMLAH --}}
                    <td class="py-4 px-6 text-right font-bold text-slate-800 whitespace-nowrap">
                        Rp {{ number_format($hargaFinal, 0, ',', '.') }}
                    </td>


                    {{-- TIPE --}}
                    <td class="py-4 px-6 text-center">

                        @if($pesanan->status_pembayaran === 'lunas')

                            <span class="bg-emerald-100 text-emerald-700 font-medium px-3 py-1 rounded-full text-[11px] whitespace-nowrap">
                                Lunas
                            </span>

                        @elseif($pesanan->status_pembayaran === 'dp')

                            <div class="inline-flex flex-col items-center">

                                <span class="bg-amber-100 text-amber-700 font-semibold px-2.5 py-0.5 rounded-full text-[10px]">
                                    DP
                                </span>

                                @if($hargaFinal > 0)
                                    <span class="text-[10px] text-amber-600 font-semibold mt-0.5">
                                        {{ round(($sudahDibayar / $hargaFinal) * 100) }}%
                                    </span>
                                @endif

                            </div>

                        @else

                            <span class="bg-rose-100 text-rose-700 font-medium px-3 py-1 rounded-full text-[11px] whitespace-nowrap">
                                Belum Bayar
                            </span>

                        @endif

                    </td>


                    {{-- AKSI --}}
                    <td class="py-4 px-6 text-center">

                        <a href="{{ route('admin.tefa.transaksi.pdf.satuan', $pesanan->id_pesanan) }}" target="_blank" class="bg-slate-100 hover:bg-slate-200 text-slate-600 px-3 py-1.5 rounded-lg font-semibold text-[11px]">
                            Cetak
                        </a>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="9" class="py-8 text-center text-slate-400">
                        Belum ada transaksi pada periode ini.
                    </td>
                </tr>

            @endforelse

        </tbody>
        </table>
      </div>

      <div class="bg-indigo-50/60 border-t border-indigo-100 p-6 flex justify-between items-center">
        <span class="font-bold text-indigo-900 text-sm">
            Total Harga
        </span>

        <span class="font-bold text-indigo-600 text-lg">
            Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
        </span>
      </div>
    </div>
  </main>
  
@endsection