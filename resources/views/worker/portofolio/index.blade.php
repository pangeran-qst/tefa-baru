@extends('worker.layouts.app')

@section('title', 'Portofolio Digital')

@section('content')

    <!-- HEADER -->
    <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3 mb-4">
        <div>
            <h1 class="page-title">Portofolio Digital</h1>
            <p class="page-description mb-0">
                Arsip project yang telah lolos Quality Control
            </p>
        </div>

        @php
            $nama = Auth::user()->nama ?? 'Worker';

            $inisial = collect(explode(' ', trim($nama)))
                ->filter()
                ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                ->take(2)
                ->implode('');
        @endphp

        <div class="d-flex align-items-center gap-3">
            <span class="text-xs text-muted">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </span>

            <div
                class="rounded-circle bg-primary text-white fw-bold d-flex align-items-center justify-content-center shadow"
                style="width: 32px; height: 32px; font-size: 11px;">
                {{ $inisial }}
            </div>
        </div>
    </div>


    <!-- ALERT -->
    <div class="alert alert-success d-flex align-items-center gap-2 mb-4">
        <span>🎉</span>
        <span>
            Ini adalah portofolio digital kamu. Semua project yang telah lolos QC tersimpan di sini.
        </span>
    </div>


    <!-- LIST PORTOFOLIO -->
    <div class="d-flex flex-column gap-3">

        @forelse($portofolio as $item)

            <div class="bg-white rounded-4 p-4 border shadow-sm d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3"
                style="border-color: #e2e8f0 !important;">

                <div>

                    <!-- BADGE -->
                    <div class="d-flex align-items-center gap-2 mb-2">

                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2">
                            {{ $item->tefa->jurusan ?? 'TEFA' }}
                        </span>

                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-2">
                            ✓ Lolos QC
                        </span>

                    </div>


                    <!-- NAMA PROJECT -->
                    <h3 class="fw-bold text-dark mb-1" style="font-size: 14px;">
                        {{ $item->tefa->nama_produk ?? $item->tefa->layanan ?? 'Layanan TEFA' }}
                    </h3>


                    <!-- INFO -->
                    <p class="text-muted mb-1" style="font-size: 12px;">
                        Pesanan #{{ $item->id_pesanan }}
                        · Klien:
                        <span class="fw-semibold text-dark">
                            {{ $item->nama_pemesan ?? $item->user->nama ?? '-' }}
                        </span>
                    </p>

                    <p class="text-muted mb-0" style="font-size: 11px;">
                        Selesai:
                        {{ $item->updated_at ? $item->updated_at->format('d M Y - H:i') : '-' }}
                    </p>

                </div>


                <!-- STATUS -->
                <div class="align-self-start align-self-md-center">

                    <span
                        class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-4 py-2">
                        ✓ Project Selesai
                    </span>

                </div>

            </div>

        @empty

            <!-- KALAU BELUM ADA PROJECT -->
            <div class="bg-white rounded-4 p-5 border shadow-sm text-center">

                <div class="fs-1 mb-3">
                    📁
                </div>

                <h3 class="fw-bold text-secondary" style="font-size: 14px;">
                    Belum ada project di portofolio
                </h3>

                <p class="text-muted mb-0" style="font-size: 12px;">
                    Project yang sudah selesai dan lolos QC akan otomatis muncul di sini.
                </p>

            </div>

        @endforelse

    </div>

@endsection