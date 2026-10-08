@extends('admin.jurusan.layouts.app')

@section('title', 'Transaksi')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>

<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
    rel="stylesheet"
>

<style>
    body {
        font-family: 'Inter', sans-serif;
    }
</style>


<main class="flex-1 p-8 overflow-y-auto">

    {{-- HEADER --}}
    <div class="mb-6">

        <h1 class="text-2xl font-bold text-slate-800">
            Transaksi
        </h1>

        <p class="text-xs text-slate-500 mt-1">
            Rekap transaksi dan pembayaran dari jurusan {{ Auth::user()->jurusan }}
        </p>

    </div>


    {{-- CARDS --}}
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


        {{-- PENDING --}}
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


        {{-- OMSET --}}
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


    {{-- TABLE --}}
    <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden">


        {{-- TABLE HEADER --}}
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">

            <div>

                <h2 class="text-sm font-bold text-slate-800">
                    Data Transaksi
                </h2>

                <p class="text-xs text-slate-400 mt-1">
                    Seluruh transaksi dari jurusan {{ Auth::user()->jurusan }}
                </p>

            </div>


            {{-- BUTTON EXPORT --}}
            <div class="flex items-center gap-2">

                {{-- CETAK PDF --}}
                <a
                    href="{{ route('admin.jurusan.transaksi.pdf') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-semibold
                        bg-rose-50 text-rose-600 border border-rose-100
                        hover:bg-rose-100 transition"
                >
                    <i class="bi bi-file-earmark-pdf"></i>
                    Cetak PDF
                </a>


                {{-- EXPORT EXCEL --}}
                <a
                    href="{{ route('admin.jurusan.transaksi.excel') }}"
                    class="inline-flex items-center gap-2 px-3 py-2 rounded-lg text-xs font-semibold
                        bg-emerald-50 text-emerald-600 border border-emerald-100
                        hover:bg-emerald-100 transition"
                >
                    <i class="bi bi-file-earmark-excel"></i>
                    Export Excel
                </a>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-left border-collapse">

                <thead>

                    <tr class="border-b border-slate-100 text-[11px] uppercase tracking-wider text-slate-400">

                        <th class="py-4 px-6 font-semibold">
                            Pesanan
                        </th>

                        <th class="py-4 px-6 font-semibold">
                            Klien
                        </th>

                        <th class="py-4 px-6 font-semibold">
                            Layanan
                        </th>

                        <th class="py-4 px-6 font-semibold text-right">
                            Harga Kesepakatan
                        </th>

                        <th class="py-4 px-6 font-semibold text-right">
                            Sudah Dibayar
                        </th>

                        <th class="py-4 px-6 font-semibold text-right">
                            Sisa
                        </th>

                        <th class="py-4 px-6 font-semibold text-center">
                            Status
                        </th>

                        <th class="py-4 px-6 font-semibold">
                            Tanggal
                        </th>

                        <th class="py-4 px-6 font-semibold text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-50 text-xs text-slate-600">


                    @forelse($transaksi as $pesanan)

                        @php

                            $hargaFinal = $pesanan->harga_final ?? 0;

                            $sudahDibayar = $pesanan->nominal_dibayar ?? 0;

                            $sisa = max(
                                $hargaFinal - $sudahDibayar,
                                0
                            );

                        @endphp


                        <tr class="hover:bg-slate-50/50 transition">


                            {{-- PESANAN --}}
                            <td class="py-4 px-6">

                                <div class="font-semibold text-indigo-600">
                                    #{{ $pesanan->id_pesanan }}
                                </div>

                            </td>


                            {{-- KLIEN --}}
                            <td class="py-4 px-6">

                                <div class="font-semibold text-slate-700">
                                    {{ $pesanan->nama_pemesan }}
                                </div>

                                <div class="text-[10px] text-slate-400 mt-0.5">
                                    {{ $pesanan->email_pemesan }}
                                </div>

                            </td>


                            {{-- LAYANAN --}}
                            <td class="py-4 px-6">

                                <div class="font-medium text-slate-700">
                                    {{ $pesanan->tefa->nama_produk ?? '-' }}
                                </div>

                            </td>


                            {{-- HARGA --}}
                            <td class="py-4 px-6 text-right font-semibold text-slate-800 whitespace-nowrap">

                                Rp {{ number_format($hargaFinal, 0, ',', '.') }}

                            </td>


                            {{-- SUDAH DIBAYAR --}}
                            <td class="py-4 px-6 text-right font-semibold text-emerald-600 ">

                                Rp {{ number_format($sudahDibayar, 0, ',', '.') }}

                            </td>


                            {{-- SISA --}}
                            <td class="py-4 px-6 text-right font-semibold text-amber-600">

                                Rp {{ number_format($sisa, 0, ',', '.') }}

                            </td>


                            {{-- STATUS --}}
                            <td class="py-3 px-4 text-center whitespace-nowrap">

                                @if($pesanan->status_pembayaran === 'lunas')

                                    <span class="inline-block bg-emerald-100 text-emerald-700 font-semibold px-3 py-1 rounded-full text-[10px] whitespace-nowrap">
                                        Lunas
                                    </span>

                                @elseif($pesanan->status_pembayaran === 'dp')

                                    <span class="inline-block bg-amber-100 text-amber-700 font-semibold px-3 py-1 rounded-full text-[10px] whitespace-nowrap">
                                        DP
                                    </span>

                                @else

                                    <span class="inline-block bg-rose-100 text-rose-700 font-semibold px-3 py-1 rounded-full text-[10px] whitespace-nowrap">
                                        Belum Bayar
                                    </span>

                                @endif

                            </td>


                            {{-- TANGGAL --}}
                            <td class="py-4 px-6 text-slate-400">

                                {{ $pesanan->tanggal_pembayaran
                                    ? $pesanan->tanggal_pembayaran->format('d M Y')
                                    : '-' }}

                            </td>


                            {{-- AKSI --}}
                            <td class="text-center">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- CETAK PDF --}}
                                    <a
                                        href="{{ route('admin.jurusan.transaksi.pdf.satuan', $pesanan->id_pesanan) }}"
                                        target="_blank"
                                        class="inline-flex items-center justify-center
                                            w-8 h-8 rounded-lg
                                            bg-rose-50 text-rose-600
                                            hover:bg-rose-100 transition"
                                        title="Cetak PDF">
                                        <i class="bi bi-file-earmark-pdf"></i>
                                    </a>

                                </div>

                            </td>


                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="9"
                                class="py-12 text-center"
                            >

                                <div class="text-slate-400 text-sm">
                                    Belum ada transaksi.
                                </div>

                                <div class="text-slate-300 text-xs mt-1">
                                    Transaksi akan muncul setelah pesanan memiliki data pembayaran.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- TOTAL --}}
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