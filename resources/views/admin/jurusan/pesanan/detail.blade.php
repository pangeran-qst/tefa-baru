@extends('admin.jurusan.layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<style>
    .detail-page {
        max-width: 1056px;
        margin: 0 auto;
    }

    .detail-header {
        margin-bottom: 18px;
    }

    .detail-header h1 {
        font-size: 28px;
        line-height: 1.2;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .detail-header p {
        font-size: 13px;
        color: #64748b;
        margin: 4px 0 0;
    }

    .detail-back {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #dbe2ea;
        background: white;
        border-radius: 9px;
        color: #475569;
        text-decoration: none;
    }

    .detail-back:hover {
        background: #f8fafc;
        color: #4f46e5;
    }

    .detail-card {
        background: white;
        border: 1px solid #dbe2ea;
        border-radius: 15px;
        box-shadow: 0 2px 8px rgba(15, 23, 42, .03);
    }

    .order-head {
        padding: 14px 18px;
    }

    .order-icon {
        width: 38px;
        height: 38px;
        border-radius: 9px;
        background: #eef2ff;
        color: #4f46e5;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
    }

    .label {
        font-size: 10px;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: .35px;
        margin-bottom: 3px;
    }

    .value {
        font-size: 13px;
        font-weight: 600;
        color: #334155;
    }

    .section-card {
        padding: 18px;
    }

    .section-title {
        font-size: 16px;
        font-weight: 700;
        color: #334155;
        margin: 0;
    }

    .section-desc {
        font-size: 11px;
        color: #94a3b8;
        margin-top: 3px;
        margin-bottom: 18px;
    }

    .info-value {
        font-size: 13px;
        font-weight: 600;
        color: #475569;
    }

    .note-box {
        background: #f8fafc;
        border-radius: 9px;
        padding: 11px 13px;
        font-size: 12px;
        color: #64748b;
        line-height: 1.5;
    }

    .summary-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }

    .summary-item:last-child {
        margin-bottom: 0;
    }

    .summary-icon {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .summary-worker-row {
        display: flex;
        align-items: stretch;
    }

    .summary-worker-card {
        height: 230px;
    }

    .action-card {
        height: 230px;
    }

    .summary-worker-row > .summary-worker-col {
        display: flex;
    }

    .summary-worker-row .detail-card {
        width: 100%;
        height: 100%;
    }

    .worker-empty {
        background: #f8fafc;
        border-radius: 10px;
        padding: 18px 12px;
        text-align: center;
    }

    .worker-icon {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        margin: 0 auto 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f1f5f9;
        color: #94a3b8;
    }

    .action-btn {
        width: 100%;
        height: 38px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        border: 0;
    }

    .progress-box {
        background: #f8fafc;
        border-radius: 10px;
        padding: 12px;
    }
</style>


<div class="detail-page">

    {{-- HEADER --}}
    <div class="detail-header d-flex align-items-center gap-3">

        <a
            href="{{ route('admin.jurusan.pesanan') }}"
            class="detail-back">

            <i class="bi bi-arrow-left"></i>

        </a>

        <div>

            <h1>Detail Pesanan</h1>

            <p>
                Lihat informasi lengkap dan kelola pesanan klien
            </p>

        </div>

    </div>


    {{-- IDENTITAS PESANAN --}}
    <div class="detail-card order-head mb-4">

        <div class="d-flex align-items-center justify-content-between">

            <div class="d-flex align-items-center gap-3">

                <div class="order-icon">
                    <i class="bi bi-receipt"></i>
                </div>

                <div>

                    <div class="label">
                        ID Pesanan
                    </div>

                    <div
                        style="
                            font-size:20px;
                            font-weight:700;
                            color:#4f46e5;
                        ">

                        #TF-{{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}

                    </div>

                </div>

            </div>


            {{-- STATUS --}}
            @if($pesanan->status === 'diproses')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#f5f3ff;
                        color:#7c3aed;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Baru

                </span>

            @elseif($pesanan->status === 'ditugaskan')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#eef2ff;
                        color:#4f46e5;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Ditugaskan

                </span>

            @elseif($pesanan->status === 'pengerjaan')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#fffbeb;
                        color:#d97706;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Dalam Pengerjaan

                </span>

            @elseif($pesanan->status === 'review')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#eff6ff;
                        color:#2563eb;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Peninjauan / QC

                </span>

            @elseif($pesanan->status === 'selesai')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#ecfdf5;
                        color:#059669;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Selesai

                </span>

            @elseif($pesanan->status === 'ditolak')

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#fef2f2;
                        color:#dc2626;
                        font-size:11px;
                    ">

                    <i
                        class="bi bi-circle-fill me-1"
                        style="font-size:5px;">
                    </i>

                    Ditolak

                </span>

            @else

                <span
                    class="badge rounded-pill px-3 py-2"
                    style="
                        background:#f1f5f9;
                        color:#475569;
                        font-size:11px;
                    ">

                    {{ ucfirst($pesanan->status) }}

                </span>

            @endif

        </div>

    </div>


    {{-- MAIN --}}
    <div class="row g-5">


        {{-- ========================= --}}
        {{-- KIRI --}}
        {{-- ========================= --}}
        <div class="col-lg-8">


            {{-- DATA KLIEN --}}
            <div class="detail-card mb-4">

                <div class="section-card">

                    <h2 class="section-title">
                        Data Klien
                    </h2>

                    <div class="section-desc">
                        Informasi kontak pemesan
                    </div>


                    <div class="row g-4">


                        {{-- NAMA --}}
                        <div class="col-md-6">

                            <div class="label">
                                Nama Klien
                            </div>

                            <div class="info-value">
                                {{ $pesanan->nama_pemesan ?? '-' }}
                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <div class="label">
                                Email
                            </div>

                            <div class="info-value">
                                {{ $pesanan->email_pemesan ?? '-' }}
                            </div>

                        </div>


                        {{-- WHATSAPP --}}
                        <div class="col-md-6">

                            <div class="label">
                                Nomor WhatsApp
                            </div>

                            <div class="info-value">
                                {{ $pesanan->no_hp_pemesan ?? '-' }}
                            </div>

                        </div>


                    </div>

                </div>

            </div>


            {{-- INFORMASI PESANAN --}}
            <div class="detail-card mb-5">

                <div class="section-card">

                    <h2 class="section-title">
                        Informasi Pesanan
                    </h2>

                    <div class="section-desc">
                        Detail layanan yang dipesan oleh klien
                    </div>


                    <div class="row g-4">


                        {{-- LAYANAN --}}
                        <div class="col-md-6">

                            <div class="label">
                                Layanan
                            </div>

                            <div class="info-value">
                                {{ $pesanan->tefa->nama_produk ?? '-' }}
                            </div>

                        </div>


                        {{-- JURUSAN --}}
                        <div class="col-md-6">

                            <div class="label">
                                Jurusan
                            </div>

                            <div class="info-value">
                                {{ $pesanan->tefa->jurusan ?? '-' }}
                            </div>

                        </div>


                        {{-- NILAI PESANAN --}}
                        <div class="col-md-6">

                            <div class="label">
                                Nilai Pesanan
                            </div>

                            <div class="info-value">
                                Rp {{ number_format($pesanan->total_harga ?? $pesanan->tefa->harga ?? 0, 0, ',', '.') }}
                            </div>

                        </div>


                        {{-- TANGGAL --}}
                        <div class="col-md-6">

                            <div class="label">
                                Tanggal Pesanan
                            </div>

                            <div class="info-value">

                                {{ $pesanan->tanggal_pesan?->format('d M Y') ?? '-' }}

                            </div>

                            <div
                                style="
                                    font-size:11px;
                                    color:#94a3b8;
                                    margin-top:2px;
                                ">

                                {{ $pesanan->tanggal_pesan?->format('H:i') ?? '-' }} WIB

                            </div>

                        </div>


                    </div>


                    {{-- CATATAN --}}
                    <div class="border-top mt-4 pt-4">

                        <div class="label">
                            Catatan Pesanan
                        </div>

                        <div class="note-box">

                            {{ $pesanan->catatan_pesanan ?: 'Tidak ada catatan dari klien.' }}

                        </div>

                    </div>

                </div>

            </div>


            {{-- RINGKASAN + WORKER --}}
            <div class="row g-4 summary-worker-row">

                {{-- RINGKASAN --}}
                <div class="col-md-6 summary-worker-col">

                    <div class="detail-card">

                        <div class="section-card">

                            <h2 class="section-title">
                                Ringkasan Pesanan
                            </h2>

                            <div class="section-desc">
                                Informasi singkat pesanan
                            </div>


                            {{-- KLIEN --}}
                            <div class="summary-item">

                                <div
                                    class="summary-icon"
                                    style="
                                        background:#eef2ff;
                                        color:#4f46e5;
                                    "
                                >
                                    <i class="bi bi-person"></i>
                                </div>

                                <div>

                                    <div class="label mb-0">
                                        Klien
                                    </div>

                                    <div class="value">
                                        {{ $pesanan->nama_pemesan ?? '-' }}
                                    </div>

                                </div>

                            </div>


                            {{-- LAYANAN --}}
                            <div class="summary-item">

                                <div
                                    class="summary-icon"
                                    style="
                                        background:#eff6ff;
                                        color:#2563eb;
                                    "
                                >
                                    <i class="bi bi-box-seam"></i>
                                </div>

                                <div>

                                    <div class="label mb-0">
                                        Layanan
                                    </div>

                                    <div class="value">
                                        {{ $pesanan->tefa->nama_produk ?? '-' }}
                                    </div>

                                </div>

                            </div>


                            {{-- TOTAL --}}
                            <div class="summary-item">

                                <div
                                    class="summary-icon"
                                    style="
                                        background:#ecfdf5;
                                        color:#059669;
                                    "
                                >
                                    <i class="bi bi-cash-stack"></i>
                                </div>

                                <div>

                                    <div class="label mb-0">
                                        Total
                                    </div>

                                    <div class="value">
                                        Rp {{ number_format($pesanan->total_harga ?? $pesanan->tefa->harga ?? 0, 0, ',', '.') }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- WORKER --}}
                <div class="col-md-6 summary-worker-col">

                    <div class="detail-card">

                        <div class="section-card">

                            <h2 class="section-title">
                                Worker
                            </h2>

                            <div class="section-desc">
                                Penanggung jawab pesanan
                            </div>


                            @if($pesanan->worker)

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="rounded-circle d-flex align-items-center justify-content-center fw-bold"
                                        style="
                                            width:38px;
                                            height:38px;
                                            background:#eef2ff;
                                            color:#4f46e5;
                                        "
                                    >
                                        {{ strtoupper(substr($pesanan->worker->nama, 0, 1)) }}
                                    </div>

                                    <div>

                                        <div class="value">
                                            {{ $pesanan->worker->nama }}
                                        </div>

                                        <div
                                            style="
                                                font-size:11px;
                                                color:#94a3b8;
                                            "
                                        >
                                            Worker
                                        </div>

                                    </div>

                                </div>

                            @else

                                <div class="worker-empty">

                                    <div class="worker-icon">

                                        <i class="bi bi-person-plus"></i>

                                    </div>

                                    <div
                                        style="
                                            font-size:13px;
                                            font-weight:600;
                                            color:#475569;
                                        "
                                    >
                                        Belum ditugaskan
                                    </div>

                                    <div
                                        style="
                                            font-size:11px;
                                            color:#94a3b8;
                                            margin-top:2px;
                                        "
                                    >
                                        Worker belum dipilih.
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- PROGRESS --}}
            @if($pesanan->progress && $pesanan->progress->count())

                @php
                    $progressTerakhir = $pesanan->progress->first();
                    $nilaiProgress = $progressTerakhir?->progress ?? 0;
                @endphp

                <div class="detail-card mt-4">

                    <div class="section-card">

                        <h2 class="section-title">
                            Progress Pengerjaan
                        </h2>

                        <div class="section-desc">
                            Perkembangan pengerjaan pesanan oleh Worker
                        </div>


                        <div class="progress-box">

                            <div class="d-flex justify-content-between align-items-center mb-2">

                                <span
                                    style="
                                        font-size:11px;
                                        color:#64748b;
                                        font-weight:600;
                                    "
                                >
                                    Progress
                                </span>

                                <span
                                    style="
                                        font-size:12px;
                                        color:#4f46e5;
                                        font-weight:700;
                                    "
                                >
                                    {{ $nilaiProgress }}%
                                </span>

                            </div>


                            <div
                                class="progress"
                                style="
                                    height:7px;
                                    background:#e2e8f0;
                                "
                            >

                                <div
                                    class="progress-bar"
                                    role="progressbar"
                                    style="
                                        width:{{ $nilaiProgress }}%;
                                        background:#4f46e5;
                                    "
                                    aria-valuenow="{{ $nilaiProgress }}"
                                    aria-valuemin="0"
                                    aria-valuemax="100"
                                ></div>

                            </div>


                            <div class="mt-3">

                                <div class="label mb-1">
                                    Tahap
                                </div>

                                <div class="info-value">
                                    {{ $progressTerakhir->tahap ?? '-' }}
                                </div>

                            </div>


                            @if($progressTerakhir->catatan)

                                <div class="mt-3">

                                    <div class="label mb-1">
                                        Catatan Worker
                                    </div>

                                    <div class="note-box">
                                        {{ $progressTerakhir->catatan }}
                                    </div>

                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            @endif


        </div>


        {{-- ========================= --}}
        {{-- KANAN --}}
        {{-- ========================= --}}
        <div class="col-lg-4">


            

            {{-- PEMBAYARAN --}}
            <div class="detail-card mb-4">

    <div class="section-card">

        <h2 class="section-title">
            Pembayaran
        </h2>

        <div class="section-desc">
            Kelola harga kesepakatan dan pembayaran klien
        </div>

        @php
            $hargaFinal = $pesanan->harga_final ?? 0;
            $nominalDibayar = $pesanan->nominal_dibayar ?? 0;
            $sisaPembayaran = max($hargaFinal - $nominalDibayar, 0);
        @endphp

        <form
            action="{{ route('admin.jurusan.pesanan.pembayaran', $pesanan->id_pesanan) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            {{-- HARGA KESEPAKATAN --}}
            <div class="mb-3">

                <label
                    for="harga_final"
                    class="label d-block"
                >
                    Harga Kesepakatan
                </label>

                <div class="input-group input-group-sm">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="harga_final"
                        id="harga_final"
                        class="form-control"
                        value="{{ old('harga_final', $hargaFinal) }}"
                        min="0"
                        required
                    >

                </div>

                <div
                    style="
                        font-size:10px;
                        color:#94a3b8;
                        margin-top:4px;
                    "
                >
                    Harga final setelah kesepakatan dengan klien.
                </div>

            </div>


            {{-- SUDAH DIBAYAR --}}
            <div class="mb-3">

                <label
                    class="label d-block"
                >
                    Sudah Dibayar
                </label>

                <div class="input-group input-group-sm">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="text"
                        id="sudahDibayar"
                        class="form-control"
                        value="{{ number_format($nominalDibayar, 0, ',', '.') }}"
                        readonly
                    >

                </div>

                <div
                    style="
                        font-size:10px;
                        color:#94a3b8;
                        margin-top:4px;
                    "
                >
                    Total pembayaran yang sudah diterima.
                </div>

            </div>


            {{-- PEMBAYARAN SEKARANG --}}
            <div class="mb-3">

                <label
                    for="pembayaran_sekarang"
                    class="label d-block"
                >
                    Pembayaran Sekarang
                </label>

                <div class="input-group input-group-sm">

                    <span class="input-group-text">
                        Rp
                    </span>

                    <input
                        type="number"
                        name="pembayaran_sekarang"
                        id="pembayaran_sekarang"
                        class="form-control"
                        value="{{ old('pembayaran_sekarang', 0) }}"
                        min="0"
                        required
                    >

                </div>

                <div
                    style="
                        font-size:10px;
                        color:#94a3b8;
                        margin-top:4px;
                    "
                >
                    Masukkan nominal yang dibayarkan klien saat ini.
                </div>

            </div>


            {{-- STATUS --}}
            <div class="mb-3">

                <label class="label d-block">
                    Status Pembayaran
                </label>

                <div
                    id="statusPembayaran"
                    class="fw-semibold"
                    style="
                        font-size:12px;
                        color:#64748b;
                    "
                >

                    @if($pesanan->status_pembayaran === 'lunas')

                        <span style="color:#059669;">
                            <i class="bi bi-check-circle me-1"></i>
                            Lunas
                        </span>

                    @elseif($pesanan->status_pembayaran === 'dp')

                        <span style="color:#d97706;">
                            <i class="bi bi-clock-history me-1"></i>
                            DP
                        </span>

                    @else

                        <span style="color:#dc2626;">
                            <i class="bi bi-circle me-1"></i>
                            Belum Bayar
                        </span>

                    @endif

                </div>

                <div
                    style="
                        font-size:10px;
                        color:#94a3b8;
                        margin-top:3px;
                    "
                >
                    Status ditentukan otomatis berdasarkan total pembayaran.
                </div>

            </div>


            {{-- SISA --}}
            <div
                class="mb-3"
                style="
                    background:#f8fafc;
                    border-radius:9px;
                    padding:10px 12px;">

                <div class="d-flex justify-content-between align-items-center">

                    <span
                        style="
                            font-size:11px;
                            color:#64748b;
                            font-weight:600;
                        "
                    >
                        Sisa Pembayaran
                    </span>

                    <strong
                        id="sisaPembayaran"
                        style="
                            font-size:13px;
                            color:#4f46e5;
                        "
                    >
                        Rp {{ number_format($sisaPembayaran, 0, ',', '.') }}
                    </strong>

                </div>

            </div>


            {{-- METODE --}}
            <div class="mb-3">

                <label
                    for="metode_pembayaran"
                    class="label d-block"
                >
                    Metode Pembayaran
                </label>

                <select
                    name="metode_pembayaran"
                    id="metode_pembayaran"
                    class="form-select form-select-sm"
                >

                    <option value="">
                        -- Pilih Metode --
                    </option>

                    <option
                        value="Cash"
                        {{ old('metode_pembayaran', $pesanan->metode_pembayaran) === 'Cash' ? 'selected' : '' }}
                    >
                        Cash
                    </option>

                    <option
                        value="Transfer"
                        {{ old('metode_pembayaran', $pesanan->metode_pembayaran) === 'Transfer' ? 'selected' : '' }}
                    >
                        Transfer
                    </option>

                    <option
                        value="QRIS"
                        {{ old('metode_pembayaran', $pesanan->metode_pembayaran) === 'QRIS' ? 'selected' : '' }}
                    >
                        QRIS
                    </option>

                </select>

            </div>


            {{-- TANGGAL --}}
            <div class="mb-3">

                <label
                    for="tanggal_pembayaran"
                    class="label d-block"
                >
                    Tanggal Pembayaran
                </label>

                <input
                    type="date"
                    name="tanggal_pembayaran"
                    id="tanggal_pembayaran"
                    class="form-control form-control-sm"
                    value="{{ old('tanggal_pembayaran', $pesanan->tanggal_pembayaran?->format('Y-m-d')) }}"
                >

            </div>


            {{-- CATATAN --}}
            <div class="mb-3">

                <label
                    for="catatan_pembayaran"
                    class="label d-block"
                >
                    Catatan Pembayaran
                </label>

                <textarea
                    name="catatan_pembayaran"
                    id="catatan_pembayaran"
                    class="form-control form-control-sm"
                    rows="3"
                    placeholder="Contoh: DP 50%, pelunasan, dll."
                >{{ old('catatan_pembayaran', $pesanan->catatan_pembayaran) }}</textarea>

            </div>


            {{-- SIMPAN --}}
            <button
                type="submit"
                class="btn action-btn"
                style="
                    background:#4f46e5;
                    color:white;
                "
            >
                <i class="bi bi-credit-card me-1"></i>
                Simpan Pembayaran
            </button>

        </form>

    </div>

</div>



            {{-- AKSI PESANAN --}}
            <div class="detail-card">

                <div class="section-card">

                    <h2 class="section-title">
                        Aksi Pesanan
                    </h2>

                    <div class="section-desc">
                        Kelola proses pesanan
                    </div>


                    @php

                        $noHp = $pesanan->no_hp_pemesan ?? '';

                        if (str_starts_with($noHp, '0')) {
                            $noHp = '62' . substr($noHp, 1);
                        }

                        $pesanWa = rawurlencode(
                            "Halo " .
                            ($pesanan->nama_pemesan ?? 'Kak') .
                            ", kami dari Admin Jurusan TeFa ingin mengonfirmasi pesanan #" .
                            str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) .
                            " (" .
                            ($pesanan->tefa->nama_produk ?? 'Layanan') .
                            ")."
                        );

                    @endphp


                    {{-- CHAT WA --}}
                    @if($noHp)

                        <a
                            href="https://wa.me/{{ $noHp }}?text={{ $pesanWa }}"
                            target="_blank"
                            class="btn action-btn mb-2"
                            style="
                                background:#ecfdf5;
                                color:#059669;
                            "
                        >

                            <i class="bi bi-whatsapp me-1"></i>
                            Chat WhatsApp

                        </a>

                    @endif


                    {{-- TOLAK --}}
                    @if($pesanan->status === 'diproses')

                        <form
                            action="{{ route('admin.jurusan.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menolak pesanan ini?')"
                            class="mb-2"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="status"
                                value="ditolak"
                            >

                            <button
                                type="submit"
                                class="btn action-btn"
                                style="
                                    background:#fef2f2;
                                    color:#dc2626;
                                "
                            >

                                <i class="bi bi-x-lg me-1"></i>
                                Tolak Pesanan

                            </button>

                        </form>

                    @endif


                    {{-- TERIMA & TUGASKAN --}}
                    @if($pesanan->status === 'diproses')

                        <button
                            type="button"
                            class="btn action-btn"
                            style="
                                background:#4f46e5;
                                color:white;
                            "
                            data-bs-toggle="modal"
                            data-bs-target="#assignWorkerModal"
                        >

                            <i class="bi bi-person-plus me-1"></i>
                            Terima & Tugaskan

                        </button>

                    @endif


                    {{-- SUDAH DITUGASKAN --}}
                    @if($pesanan->status === 'ditugaskan')

                        <div
                            class="text-center"
                            style="
                                background:#eef2ff;
                                color:#4f46e5;
                                border-radius:8px;
                                padding:10px;
                                font-size:11px;
                                font-weight:600;
                            "
                        >

                            <i class="bi bi-person-check me-1"></i>
                            Pesanan sudah ditugaskan

                        </div>

                    @endif


                    {{-- DALAM PENGERJAAN --}}
                    @if($pesanan->status === 'pengerjaan')

                        <div
                            class="text-center"
                            style="
                                background:#fffbeb;
                                color:#d97706;
                                border-radius:8px;
                                padding:10px;
                                font-size:11px;
                                font-weight:600;
                            "
                        >

                            <i class="bi bi-tools me-1"></i>
                            Pesanan sedang dikerjakan

                        </div>

                    @endif


                    {{-- REVIEW --}}
                    @if($pesanan->status === 'review')

                        <form
                            action="{{ route('admin.jurusan.pesanan.updateStatus', $pesanan->id_pesanan) }}"
                            method="POST"
                        >

                            @csrf

                            <input
                                type="hidden"
                                name="status"
                                value="selesai"
                            >

                            <button
                                type="submit"
                                class="btn action-btn"
                                style="
                                    background:#059669;
                                    color:white;
                                "
                            >

                                <i class="bi bi-check-lg me-1"></i>
                                Setujui & Selesaikan

                            </button>

                        </form>

                    @endif


                    {{-- SELESAI --}}
                    @if($pesanan->status === 'selesai')

                        <div
                            class="text-center"
                            style="
                                background:#ecfdf5;
                                color:#059669;
                                border-radius:8px;
                                padding:10px;
                                font-size:11px;
                                font-weight:600;
                            "
                        >

                            <i class="bi bi-check-circle me-1"></i>
                            Pesanan telah selesai

                        </div>

                    @endif


                    {{-- DITOLAK --}}
                    @if($pesanan->status === 'ditolak')

                        <div
                            class="text-center"
                            style="
                                background:#fef2f2;
                                color:#dc2626;
                                border-radius:8px;
                                padding:10px;
                                font-size:11px;
                                font-weight:600;
                            "
                        >

                            <i class="bi bi-x-circle me-1"></i>
                            Pesanan ditolak

                        </div>

                    @endif

                </div>

            </div>


        </div>

    </div>

</div>


{{-- ================================================= --}}
{{-- MODAL TERIMA & TUGASKAN WORKER --}}
{{-- ================================================= --}}

<div
    class="modal fade"
    id="assignWorkerModal"
    tabindex="-1"
    aria-labelledby="assignWorkerModalLabel"
    aria-hidden="true"
>

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5
                    class="modal-title fw-bold"
                    id="assignWorkerModalLabel"
                >

                    Terima & Tugaskan Pesanan

                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>

            </div>


            <form
                action="{{ url('/admin/jurusan/pesanan/' . $pesanan->id_pesanan . '/assign') }}"
                method="POST"
            >

                @csrf


                <div class="modal-body">


                    {{-- LAYANAN --}}
                    <div class="mb-3">

                        <label
                            class="form-label fw-bold"
                            style="font-size:13px;"
                        >
                            Layanan
                        </label>

                        <div
                            class="form-control bg-light"
                            style="font-size:13px;"
                        >

                            {{ $pesanan->tefa->nama_produk ?? '-' }}

                        </div>

                    </div>


                    {{-- WORKER --}}
                    <div class="mb-3">

                        <label
                            for="id_user_worker"
                            class="form-label fw-bold"
                            style="font-size:13px;"
                        >

                            Worker / Siswa Jurusan

                        </label>


                        <select
                            name="id_user_worker"
                            id="id_user_worker"
                            class="form-select"
                            required
                        >

                            <option
                                value=""
                                disabled
                                selected
                            >

                                -- Pilih Siswa / Worker --

                            </option>


                            @foreach($workers as $worker)

                                <option value="{{ $worker->id_user }}">

                                    {{ $worker->nama }}

                                </option>

                            @endforeach

                        </select>


                        <small
                            class="text-muted"
                            style="font-size:11px;"
                        >

                            Worker yang dipilih akan menerima tugas pengerjaan pesanan.

                        </small>

                    </div>


                    {{-- CATATAN --}}
                    <div class="mb-3">

                        <label
                            for="catatan_worker"
                            class="form-label fw-bold"
                            style="font-size:13px;"
                        >

                            Catatan / Instruksi Pengerjaan

                        </label>


                        <textarea
                            name="catatan_worker"
                            id="catatan_worker"
                            class="form-control"
                            rows="4"
                            placeholder="Masukkan instruksi khusus untuk Worker / Siswa..."
                        ></textarea>

                    </div>


                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >

                        <i class="bi bi-person-plus me-1"></i>
                        Simpan & Tugaskan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection