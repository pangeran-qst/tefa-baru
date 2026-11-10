
@extends('admin.tefa.layouts.app')

@section('title', 'Analitik & Statistik')

@section('content')

<style>
    /* ================= ANALITIK TEFA ================= */

    .tefa-analitik {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .tefa-analitik .dashboard-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .tefa-analitik .dashboard-description {
        font-size: 12px;
        color: #64748b;
    }

    /* ================= CONTENT CARD ================= */

    .tefa-analitik .tefa-content-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        height: 100%;
    }

    .tefa-analitik .tefa-card-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .tefa-analitik .tefa-card-description {
        font-size: 12px;
        color: #94a3b8;
        margin-bottom: 16px;
    }

    /* ================= CHART ================= */

    .tefa-analitik .tefa-chart-wrapper {
        height: 240px;
        position: relative;
    }

</style>


<div class="tefa-analitik">

    {{-- ================= HEADER ================= --}}

    <div class="mb-4">

        <h1 class="dashboard-title">
            Analitik & Statistik TEFA
        </h1>

        <p class="dashboard-description mb-0">
            Informasi aktivitas pesanan dan produk TEFA
        </p>

    </div>


    {{-- ================= GRAFIK 1 ================= --}}

    <div class="row g-4 mb-4">

        <div class="col-12">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Produk/Jasa Terlaris
                </h2>

                <p class="tefa-card-description">
                    5 produk atau jasa dengan jumlah pesanan terbanyak
                </p>

                <div class="tefa-chart-wrapper">
                    <canvas id="chartPopular"></canvas>
                </div>

            </div>

        </div>

    </div>


    {{-- ================= GRAFIK 2 ================= --}}

    <div class="row g-4 mb-4">

        <div class="col-12">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Tren Pesanan Bulanan
                </h2>

                <p class="tefa-card-description">
                    Jumlah pesanan masuk setiap bulan pada tahun ini
                </p>

                <div class="tefa-chart-wrapper">
                    <canvas id="chartBulanan"></canvas>
                </div>

            </div>

        </div>

    </div>


    {{-- ================= GRAFIK 3 ================= --}}

    <div class="row g-4 mb-4">

        <div class="col-12">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Distribusi Status Pesanan
                </h2>

                <p class="tefa-card-description">
                    Jumlah pesanan berdasarkan status pengerjaan
                </p>

                <div class="tefa-chart-wrapper">
                    <canvas id="chartStatus"></canvas>
                </div>

            </div>

        </div>

    </div>


    {{-- ================= GRAFIK 4 ================= --}}

    <div class="row g-4 mb-4">

        <div class="col-12">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Pesanan Antarjurusan
                </h2>

                <p class="tefa-card-description">
                    Jumlah pesanan berdasarkan jurusan
                </p>

                <div class="tefa-chart-wrapper">
                    <canvas id="chartJurusan"></canvas>
                </div>

            </div>

        </div>

    </div>

</div>


{{-- ================= CHART JS ================= --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    // ================= KONFIGURASI UMUM =================

    Chart.defaults.font.family = 'Inter, sans-serif';


    // ================= BAR CHART =================

    function buatBarChart(element, labels, data, label) {

        const canvas = document.getElementById(element);

        if (!canvas) return;

        new Chart(canvas, {

            type: 'bar',

            data: {

                labels: labels,

                datasets: [{

                    label: label,

                    data: data,

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


    // ================= GRAFIK 1: PRODUK TERLARIS =================

    buatBarChart(
        'chartPopular',
        @json($produkTerlaris->pluck('nama_produk')),
        @json($produkTerlaris->pluck('pesanans_count')),
        'Jumlah Pesanan'
    );


    // ================= GRAFIK 2: PESANAN BULANAN =================

    const chartBulanan = document.getElementById('chartBulanan');

    if (chartBulanan) {

        new Chart(chartBulanan, {

            type: 'line',

            data: {

                labels: @json($labelBulan),

                datasets: [{

                    label: 'Jumlah Pesanan',

                    data: @json($jumlahPesananBulanan),

                    borderColor: '#5850ec',

                    backgroundColor: 'rgba(88, 80, 236, 0.08)',

                    borderWidth: 2,

                    pointBackgroundColor: '#5850ec',

                    pointRadius: 4,

                    tension: 0.3,

                    fill: true

                }]

            },

            options: {

                responsive: true,

                maintainAspectRatio: false,

                plugins: {

                    legend: {
                        display: false
                    }

                },

                scales: {

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0,
                            stepSize: 1,
                            color: '#94a3b8'
                        },

                        grid: {
                            color: '#f1f5f9'
                        }
                    },

                    x: {
                        ticks: {
                            color: '#64748b'
                        },

                        grid: {
                            display: false
                        }
                    }

                }

            }

        });

    }


    // ================= GRAFIK 3: STATUS PESANAN =================

    buatBarChart(
        'chartStatus',
        @json($labelStatus),
        @json($jumlahStatus),
        'Jumlah Pesanan'
    );


    // ================= GRAFIK 4: ANTARJURUSAN =================

    buatBarChart(
        'chartJurusan',
        @json($labelJurusan),
        @json($jumlahPesananJurusan),
        'Jumlah Pesanan'
    );

});

</script>

@endsection
