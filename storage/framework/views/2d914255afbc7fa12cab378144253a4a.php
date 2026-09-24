<?php $__env->startSection('title', 'Dashboard Admin TEFA'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* ================= DASHBOARD TEFA ================= */

    .tefa-dashboard {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

    .tefa-dashboard .dashboard-title {
        font-size: 24px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }

    .tefa-dashboard .dashboard-description {
        font-size: 12px;
        color: #64748b;
    }

    /* ================= STAT CARD ================= */

    .tefa-stat-card {
        background: #ffffff;
        border: 1px solid rgba(226, 232, 240, 0.8);
        border-radius: 16px;
        padding: 20px;
        height: 100%;
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
        font-size: 30px;
        line-height: 1;
        font-weight: 800;
        color: #1e293b;
    }

    .tefa-stat-label {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        margin-top: 6px;
    }

    .tefa-stat-note {
        display: inline-block;
        font-size: 11px;
        font-weight: 600;
        margin-top: 8px;
    }

    .icon-amber {
        background: #fffbeb;
        color: #f59e0b;
    }

    .icon-purple {
        background: #faf5ff;
        color: #a855f7;
    }

    .icon-blue {
        background: #eff6ff;
        color: #3b82f6;
    }

    .icon-green {
        background: #ecfdf5;
        color: #10b981;
    }

    .text-green {
        color: #059669;
    }

    .text-purple {
        color: #9333ea;
    }

    .text-blue {
        color: #2563eb;
    }

    .text-amber {
        color: #f59e0b;
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

    /* ================= DISPOSISI ================= */

    .tefa-order-item {
        background: rgba(248, 250, 252, 0.6);
        border: 1px solid #f1f5f9;
        border-radius: 12px;
        padding: 14px;
    }

    .tefa-order-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .tefa-order-number {
        font-size: 12px;
        font-weight: 700;
        color: #4f46e5;
    }

    .tefa-order-name {
        color: #334155;
    }

    .tefa-order-description {
        font-size: 12px;
        color: #64748b;
        margin-top: 2px;
    }

    .tefa-order-time {
        font-size: 11px;
        color: #94a3b8;
    }

    .tefa-btn-disposisi {
        background: #4f46e5;
        color: #ffffff;
        border: none;
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.2s;
        text-decoration: none;
    }

    .tefa-btn-disposisi:hover {
        background: #4338ca;
        color: #ffffff;
    }

    .tefa-badge-danger {
        background: #fff1f2;
        color: #f43f5e;
        border: 1px solid #ffe4e6;
        font-size: 12px;
        font-weight: 600;
        padding: 5px 12px;
        border-radius: 999px;
    }

    /* ================= AKTIVITAS ================= */

    .tefa-activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .tefa-activity-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-top: 6px;
        flex-shrink: 0;
    }

    .tefa-activity-text {
        font-size: 12px;
        color: #475569;
        line-height: 1.45;
    }

    .tefa-activity-time {
        font-size: 10px;
        color: #94a3b8;
        margin-top: 2px;
    }

    .dot-green {
        background: #10b981;
    }

    .dot-indigo {
        background: #6366f1;
    }

    .dot-purple {
        background: #a855f7;
    }

    .dot-amber {
        background: #f59e0b;
    }

    .dot-gray {
        background: #94a3b8;
    }
</style>


<div class="tefa-dashboard">

    

    <div class="mb-4">

        <h1 class="dashboard-title">
            Selamat datang kembali 
            
        </h1>

        <p class="dashboard-description mb-0">
            Senin, 25 Agustus 2026
        </p>

    </div>


    

    <div class="row g-4 mb-4">


        

        <div class="col-12 col-md-6 col-xl-3">

            <div class="tefa-stat-card">

                <div class="tefa-stat-icon icon-amber">
                    📁
                </div>

                <div class="tefa-stat-number">
                    47
                </div>

                <div class="tefa-stat-label">
                    Total Pesanan Masuk
                </div>

                <span class="tefa-stat-note text-green">
                    +8 hari ini
                </span>

            </div>

        </div>


        

        <div class="col-12 col-md-6 col-xl-3">

            <div class="tefa-stat-card">

                <div class="tefa-stat-icon icon-purple">
                    ⚡
                </div>

                <div class="tefa-stat-number">
                    Rp 24,7 Jt
                </div>

                <div class="tefa-stat-label">
                    Total Omset / Kas BLUD
                </div>

                <span class="tefa-stat-note text-purple">
                    Bulan Agustus
                </span>

            </div>

        </div>


        

        <div class="col-12 col-md-6 col-xl-3">

            <div class="tefa-stat-card">

                <div class="tefa-stat-icon icon-amber">
                    👷
                </div>

                <div class="tefa-stat-number">
                    17
                </div>

                <div class="tefa-stat-label">
                    Jumlah Project Aktif
                </div>

                <span class="tefa-stat-note text-blue">
                    Sedang berjalan
                </span>

            </div>

        </div>


        

        <div class="col-12 col-md-6 col-xl-3">

            <div class="tefa-stat-card">

                <div class="tefa-stat-icon icon-green">
                    ✅
                </div>

                <div class="tefa-stat-number">
                    61
                </div>

                <div class="tefa-stat-label">
                    Total Project Selesai
                </div>

                <span class="tefa-stat-note text-amber">
                    Lolos QC
                </span>

            </div>

        </div>

    </div>


    

    <div class="row g-4 mb-4">


        

        <div class="col-12 col-lg-7">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Produk/Jasa Terlaris
                </h2>

                <p class="tefa-card-description">
                    Total order per kategori layanan
                </p>

                <div class="tefa-chart-wrapper">

                    <canvas id="barChart"></canvas>

                </div>

            </div>

        </div>


        

        <div class="col-12 col-lg-5">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Rata-rata Kecepatan Pengerjaan
                </h2>

                <p class="tefa-card-description">
                    Dalam hari per project
                </p>

                <div class="tefa-chart-wrapper">

                    <canvas id="lineChart"></canvas>

                </div>

            </div>

        </div>

    </div>


    

    <div class="row g-4">


        

        <div class="col-12 col-lg-7">

            <div class="tefa-content-card p-4">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>

                        <h2 class="tefa-card-title">
                            Pesanan Butuh Disposisi
                        </h2>

                        <p class="tefa-card-description mb-0">
                            Tindak segera pesanan baru
                        </p>

                    </div>

                    <span class="tefa-badge-danger">
                        2 Mendesak
                    </span>

                </div>


                <div class="d-flex flex-column gap-3">


                    

                    <div class="tefa-order-item">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-start gap-3">

                                <span
                                    class="tefa-order-dot"
                                    style="background:#f43f5e;">
                                </span>

                                <div>

                                    <div class="tefa-order-number">

                                        #TF-2892

                                        <span class="tefa-order-name">
                                            PT Digital Nusantara
                                        </span>

                                    </div>

                                    <p class="tefa-order-description mb-0">
                                        Web Dev — Company Profile
                                    </p>

                                </div>

                            </div>


                            <div class="d-flex align-items-center gap-3">

                                <span class="tefa-order-time">
                                    10 menit lalu
                                </span>

                                <a
                                    href="<?php echo e(route('admin.tefa.pesanan')); ?>"
                                    class="tefa-btn-disposisi">

                                    Disposisi

                                </a>

                            </div>

                        </div>

                    </div>


                    

                    <div class="tefa-order-item">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-start gap-3">

                                <span
                                    class="tefa-order-dot"
                                    style="background:#f43f5e;">
                                </span>

                                <div>

                                    <div class="tefa-order-number">

                                        #TF-2891

                                        <span class="tefa-order-name">
                                            CV Tanjung Kreatif
                                        </span>

                                    </div>

                                    <p class="tefa-order-description mb-0">
                                        UI/UX Design — Mobile App
                                    </p>

                                </div>

                            </div>


                            <div class="d-flex align-items-center gap-3">

                                <span class="tefa-order-time">
                                    2 jam lalu
                                </span>

                                <a
                                    href="<?php echo e(route('admin.tefa.pesanan')); ?>"
                                    class="tefa-btn-disposisi">

                                    Disposisi

                                </a>

                            </div>

                        </div>

                    </div>


                    

                    <div class="tefa-order-item">

                        <div class="d-flex align-items-center justify-content-between">

                            <div class="d-flex align-items-start gap-3">

                                <span
                                    class="tefa-order-dot"
                                    style="background:#cbd5e1;">
                                </span>

                                <div>

                                    <div class="tefa-order-number">

                                        #TF-2890

                                        <span class="tefa-order-name">
                                            Dinas Pendidikan Kota
                                        </span>

                                    </div>

                                    <p class="tefa-order-description mb-0">
                                        Sistem Informasi Sekolah
                                    </p>

                                </div>

                            </div>


                            <div class="d-flex align-items-center gap-3">

                                <span class="tefa-order-time">
                                    4 jam lalu
                                </span>

                                <a
                                    href="<?php echo e(route('admin.tefa.pesanan')); ?>"
                                    class="tefa-btn-disposisi">

                                    Disposisi

                                </a>

                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </div>


        

        <div class="col-12 col-lg-5">

            <div class="tefa-content-card p-4">

                <h2 class="tefa-card-title">
                    Aktivitas Terkini
                </h2>

                <p class="tefa-card-description">
                    Log sistem real-time
                </p>


                <div class="d-flex flex-column gap-4">


                    

                    <div class="tefa-activity-item">

                        <span class="tefa-activity-dot dot-green"></span>

                        <div>

                            <p class="tefa-activity-text mb-0">
                                Pesanan #TF-2891 dari PT Riau Kreatif disetujui
                            </p>

                            <span class="tefa-activity-time">
                                09:14
                            </span>

                        </div>

                    </div>


                    

                    <div class="tefa-activity-item">

                        <span class="tefa-activity-dot dot-indigo"></span>

                        <div>

                            <p class="tefa-activity-text mb-0">
                                Pembayaran DP 50% dikonfirmasi — Project #TF-2887
                            </p>

                            <span class="tefa-activity-time">
                                08:52
                            </span>

                        </div>

                    </div>


                    

                    <div class="tefa-activity-item">

                        <span class="tefa-activity-dot dot-purple"></span>

                        <div>

                            <p class="tefa-activity-text mb-0">
                                Project #TF-2843 selesai QC oleh Guru RPL
                            </p>

                            <span class="tefa-activity-time">
                                08:31
                            </span>

                        </div>

                    </div>


                    

                    <div class="tefa-activity-item">

                        <span class="tefa-activity-dot dot-amber"></span>

                        <div>

                            <p class="tefa-activity-text mb-0">
                                Pesanan baru #TF-2890 dari CV Maju Bersama
                            </p>

                            <span class="tefa-activity-time">
                                Yesterday
                            </span>

                        </div>

                    </div>


                    

                    <div class="tefa-activity-item">

                        <span class="tefa-activity-dot dot-gray"></span>

                        <div>

                            <p class="tefa-activity-text mb-0">
                                Laporan BLUD Bulan Juli diekspor oleh Admin
                            </p>

                            <span class="tefa-activity-time">
                                Yesterday
                            </span>

                        </div>

                    </div>


                </div>

            </div>

        </div>

    </div>

</div>




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    // ================= BAR CHART =================

    const barElement = document.getElementById('barChart');

    if (barElement) {

        new Chart(barElement, {

            type: 'bar',

            data: {

                labels: [
                    'UI/UX Design',
                    'Web Dev',
                    'Mobile App',
                    'Sistem Info',
                    'API Service',
                    'QA Testing'
                ],

                datasets: [{

                    data: [
                        25,
                        18,
                        13,
                        11,
                        7,
                        5
                    ],

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
                    }

                },

                scales: {

                    y: {

                        beginAtZero: true,

                        max: 24,

                        ticks: {

                            stepSize: 6,

                            color: '#94a3b8',

                            font: {
                                size: 10
                            }

                        },

                        grid: {
                            color: '#f1f5f9'
                        }

                    },

                    x: {

                        ticks: {

                            color: '#94a3b8',

                            font: {
                                size: 10
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


    // ================= LINE CHART =================

    const lineElement = document.getElementById('lineChart');

    if (lineElement) {

        new Chart(lineElement, {

            type: 'line',

            data: {

                labels: [
                    'Mar',
                    'Apr',
                    'Mei',
                    'Jun',
                    'Jul',
                    'Agu'
                ],

                datasets: [{

                    data: [
                        6.3,
                        5.9,
                        7.1,
                        6.4,
                        5.1,
                        5.6
                    ],

                    borderColor: '#10b981',

                    backgroundColor: 'rgba(16, 185, 129, 0.08)',

                    fill: true,

                    tension: 0.4,

                    pointBackgroundColor: '#10b981',

                    pointRadius: 4

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

                        min: 4,

                        max: 8,

                        ticks: {

                            stepSize: 1,

                            color: '#94a3b8',

                            font: {
                                size: 10
                            }

                        },

                        grid: {
                            color: '#f1f5f9'
                        }

                    },

                    x: {

                        ticks: {

                            color: '#94a3b8',

                            font: {
                                size: 10
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

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.tefa.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/tefa/dashboard.blade.php ENDPATH**/ ?>