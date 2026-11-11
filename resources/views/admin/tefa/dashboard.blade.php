
@extends('admin.tefa.layouts.app')

@section('title', 'Dashboard Admin TEFA')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .tefa-dashboard {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    /* ================= STAT CARD ================= */

    .tefa-stat-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 20px;
        height: 100%;
        min-width: 0;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .tefa-stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 12px;
    }

    .tefa-stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        line-height: 1;
        width: 100%;
        max-width: 100%;
        height: 48px;
        display: flex;
        align-items: center;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: clip;
        letter-spacing: -0.03em;
    }

    .text-normal {
        font-size: 2.4rem;
    }

    .text-sedang {
        font-size: 1.8rem;
    }

    .text-kecil {
        font-size: 1.65rem;
    }

    .text-kecil-1 {
        font-size: 1.5rem;
    }

    .tefa-stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        margin-top: 6px;
    }

    .icon-amber {
        background: #fffbeb;
        color: #f59e0b;
    }

    .icon-purple {
        background: #faf5ff;
        color: #a855f7;
    }

    .icon-green {
        background: #ecfdf5;
        color: #10b981;
    }

    /* ================= CONTENT CARD ================= */

    .tefa-content-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
    }

    .tefa-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .tefa-card-description {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 16px;
    }

    /* ================= CHART ================= */

    .tefa-chart-wrapper {
        height: 240px;
        position: relative;
    }

</style>


{{-- MAIN CONTENT --}}
<main class="flex-1 p-8 overflow-y-auto">

    <div class="tefa-dashboard">

        {{-- ================= HEADER ================= --}}

        <div class="mb-8">

            <h1 class="text-2xl font-bold text-slate-800">
                Selamat datang kembali, {{ Auth::user()->nama }} 👋
            </h1>

            <p class="text-xs text-slate-500 mt-1">
                {{ \Carbon\Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}
            </p>

        </div>


        {{-- ================= STATISTIK ================= --}}

        <div class="row g-4 mb-6">

            {{-- CARD 1: TOTAL PESANAN --}}

            <div class="col-12 col-md-6 col-xl-3">

                <div class="tefa-stat-card">

                    <div class="tefa-stat-icon icon-amber">
                        📁
                    </div>

                    <div class="tefa-stat-number">
                        {{ $totalPesanan }}
                    </div>

                    <div class="tefa-stat-label">
                        Total Pesanan Masuk
                    </div>

                </div>

            </div>


            {{-- CARD 2: TOTAL OMSET --}}

            <div class="col-12 col-md-6 col-xl-3">

                <div class="tefa-stat-card">

                    <div class="tefa-stat-icon icon-purple">
                        ⚡
                    </div>

                    <div class="tefa-stat-number
                        @if($totalOmset >= 1000000000)
                            text-kecil-1
                        @elseif($totalOmset >= 100000000)
                            text-kecil
                        @elseif($totalOmset >= 10000000)
                            text-sedang
                        @else
                            text-normal
                        @endif">

                        Rp {{ number_format($totalOmset, 0, ',', '.') }}

                    </div>

                    <div class="tefa-stat-label">
                        Total Omset / Kas BLUD
                    </div>

                </div>

            </div>


            {{-- CARD 3: PROJECT AKTIF --}}

            <div class="col-12 col-md-6 col-xl-3">

                <div class="tefa-stat-card">

                    <div class="tefa-stat-icon icon-amber">
                        👷
                    </div>

                    <div class="tefa-stat-number">
                        {{ $projectAktif }}
                    </div>

                    <div class="tefa-stat-label">
                        Jumlah Project Aktif
                    </div>

                </div>

            </div>


            {{-- CARD 4: PROJECT SELESAI --}}

            <div class="col-12 col-md-6 col-xl-3">

                <div class="tefa-stat-card">

                    <div class="tefa-stat-icon icon-green">
                        ✅
                    </div>

                    <div class="tefa-stat-number">
                        {{ $projectSelesai }}
                    </div>

                    <div class="tefa-stat-label">
                        Total Project Selesai
                    </div>

                </div>

            </div>

        </div>


        {{-- ================= GRAFIK ================= --}}

        <div class="mb-6">

            <div class="tefa-content-card p-6">

                <h2 class="tefa-card-title">
                    Produk/Jasa Terlaris
                </h2>

                <p class="tefa-card-description">
                    Jumlah pesanan untuk setiap produk atau jasa
                </p>

                <div class="tefa-chart-wrapper">
                    <canvas id="barChart"></canvas>
                </div>

            </div>

        </div>

    </div>

</main>


{{-- ================= CHART JS ================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // BAR CHART PRODUK TERLARIS

    const barElement = document.getElementById('barChart');

    if (barElement) {

        Chart.defaults.font.family = 'Inter, sans-serif';

        new Chart(barElement, {

            type: 'bar',

            data: {

                // Nama produk dari database
                labels: @json($produkTerlaris->pluck('nama_produk')),

                datasets: [{

                    label: 'Jumlah Pesanan',

                    // Jumlah pesanan masing-masing produk
                    data: @json($produkTerlaris->pluck('pesanans_count')),

                    backgroundColor: '#5850ec',

                    borderRadius: 6,

                    barThickness: 34

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    },

                    tooltip: {

                        callbacks: {

                            label: function(context) {
                                return context.parsed.y + ' Pesanan';
                            }

                        }

                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        ticks: {

                            precision: 0,

                            stepSize: 1,

                            color: '#94a3b8',

                            font: {
                                size: 11
                            }

                        },

                        grid: {
                            color: '#f1f5f9'
                        }

                    },

                    x: {

                        ticks: {

                            color: '#64748b',

                            font: {
                                size: 11
                            }

                        },

                        grid: {
                            display: false
                        }

                    }

                }

            }

        });

    }

});

</script>

@endsection
