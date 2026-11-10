<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Jurusan - TeFA')</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />

    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Font --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f1f5f9;
            color: #475569;
            font-family: 'Inter', sans-serif;
        }

        /* =====================================================
           SIDEBAR
        ===================================================== */

        .sidebar {
            width: 256px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            background: #1b1e3d;
            color: #cbd5e1;
            padding: 16px;
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        /* School Card */

        .school-card {
            background: #25294e;
            border: 1px solid rgba(148, 163, 184, .15);
            border-radius: 14px;
            padding: 12px;
            margin-bottom: 24px;
        }

        .school-name {
            color: white;
            font-size: 12px;
            font-weight: 600;
        }

        .school-badge {
            display: inline-block;
            background: rgba(49, 46, 129, .6);
            color: #a5b4fc;
            font-size: 10px;
            font-weight: 500;
            padding: 3px 8px;
            border-radius: 5px;
            margin-top: 6px;
        }

        .school-leader {
            color: #94a3b8;
            font-size: 11px;
            margin-top: 6px;
        }

        /* Menu */

        .sidebar-menu {
            display: flex;
            flex-direction: column;
            gap: 4px;
            flex: 1;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cbd5e1;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 12px;
            transition: all .2s ease;
        }

        .sidebar-menu a:hover {
            background: rgba(51, 65, 85, .55);
            color: white;
        }

        .sidebar-menu a.active {
            background: #4f46e5;
            color: white;
            box-shadow: 0 8px 18px rgba(79, 70, 229, .28);
        }

        .sidebar-menu a i {
            width: 22px;
            text-align: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .menu-text {
            min-width: 0;
        }

        .menu-text span {
            display: block;
            font-size: 12px;
            font-weight: 600;
            line-height: 1.3;
        }

        .menu-text small {
            display: block;
            color: #94a3b8;
            font-size: 10px;
            margin-top: 2px;
        }

        .sidebar-menu a.active .menu-text small {
            color: #c7d2fe;
        }

        /* User Footer */

        .sidebar-user {
            border-top: 1px solid rgba(148, 163, 184, .15);
            padding-top: 14px;
            margin-top: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 9px;
            min-width: 0;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #3730a3;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            flex-shrink: 0;
        }

        .user-name {
            color: white;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            color: #94a3b8;
            font-size: 10px;
        }

        .logout-icon {
            color: #94a3b8;
            border: 0;
            background: transparent;
            font-size: 14px;
            cursor: pointer;
        }

        .logout-icon:hover {
            color: white;
        }

        /* =====================================================
           MAIN & TOPBAR
        ===================================================== */

        .main-content {
            margin-left: 256px;
            min-height: 100vh;
            background: #f1f5f9;
        }

        .topbar {
            height: 64px;
            background: white;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 10px;
            min-width: 0;
        }

        .topbar-title {
            color: #0f172a;
            font-size: 14px;
            font-weight: 600;
        }

        .topbar-user {
            background: #f8fafc;
            border: 0;
            border-radius: 10px;
            padding: 8px 14px;
            color: #0f172a;
            font-size: 13px;
        }

        .content {
            padding: 32px;
        }

        .page-title {
            color: #0f172a;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .page-description {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 24px;
        }

        /* =====================================================
           CARD & TOMBOL HAMBURGER MOBILE
        ===================================================== */

        .stat-card,
        .content-card {
            background: white;
            border: 1px solid rgba(226, 232, 240, .8);
            border-radius: 18px;
            box-shadow: 0 2px 6px rgba(15, 23, 42, .04);
        }

        .mobile-menu-btn {
            display: none;
            border: none;
            background: #f1f5f9;
            color: #1e293b;
            width: 38px;
            height: 38px;
            border-radius: 9px;
            font-size: 21px;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            cursor: pointer;
        }

        .sidebar-overlay {
            display: none;
        }

        /* RESPONSIVE MOBILE (100% Identik dengan Admin TEFA) */
        @media (max-width: 768px) {
            .sidebar {
                width: 256px;
                transform: translateX(-100%);
                transition: transform .3s ease;
                overflow-y: auto;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, .5);
                z-index: 999;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .mobile-menu-btn {
                display: inline-flex;
            }

            .topbar {
                height: 60px;
                padding: 0 15px;
                gap: 10px;
            }

            .topbar-left {
                display: flex;
                align-items: center;
                gap: 10px;
                min-width: 0;
            }

            .topbar-title {
                font-size: 13px;
            }

            .topbar-user {
                padding: 7px 9px;
                font-size: 11px;
                max-width: 145px;
                overflow: hidden;
                text-overflow: ellipsis;
                white-space: nowrap;
            }

            .content {
                padding: 20px 15px;
            }

            .page-title {
                font-size: 24px;
            }

            .page-description {
                font-size: 12px;
            }

            .table-responsive {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .table-responsive > .table {
                min-width: 650px;
                white-space: nowrap;
            }

            .content-card,
            .stat-card {
                border-radius: 14px;
            }
        }

        @media (max-width: 400px) {
            .content {
                padding: 16px 12px;
            }

            .page-title {
                font-size: 21px;
            }

            .topbar {
                padding: 0 12px;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    {{-- =====================================================
         SIDEBAR
    ====================================================== --}}
    <aside class="sidebar">

        {{-- SCHOOL / JURUSAN INFO DINAMIS DARI DATABASE --}}
        <div class="school-card">
            <div class="school-name">
                ADMIN JURUSAN
            </div>
            <div class="school-badge">
                {{ Auth::user()->jurusan ?? 'Jurusan Belum Diatur' }}
            </div>
        </div>

        {{-- MENU --}}
        <div class="sidebar-menu">

            {{-- Dashboard --}}
            <a href="{{ route('admin.jurusan.dashboard') }}" class="{{ request()->routeIs('admin.jurusan.dashboard') ? 'active' : '' }}">

                <i class="bi bi-bar-chart-fill"></i>

                <div class="menu-text">

                    <span>
                        Dashboard
                    </span>

                    <small>
                        Ringkasan & Analitik
                    </small>

                </div>

            </a>


            


            


            {{-- Manajemen Pesanan --}}
            <a href="{{ route('admin.jurusan.pesanan') }}"
                class="{{ request()->routeIs('admin.jurusan.pesanan*') ? 'active' : '' }}">

                <i class="bi bi-receipt"></i>

                <div class="menu-text">

                    <span>
                        Manajemen Pesanan
                    </span>

                    <small>
                        Kelola Semua Pesanan
                    </small>

                </div>

            </a>




            {{-- Manajemen Pengguna --}}
            <a href="{{ route('admin.jurusan.pengguna') }}"
                class="{{ request()->routeIs('admin.jurusan.pengguna*') ? 'active' : '' }}">

                <i class="bi bi-people-fill"></i>

                <div class="menu-text">

                    <span>
                        Manajemen Pengguna
                    </span>

                    <small>
                        Data Worker Jurusan
                    </small>

                </div>

            </a>

            {{-- Transaksi --}}
            <a href="{{ route('admin.jurusan.transaksi') }}"
                class="{{ request()->routeIs('admin.jurusan.transaksi*') ? 'active' : '' }}">

                <i class="bi bi-wallet2"></i>

                <div class="menu-text">

                    <span>
                        Transaksi
                    </span>

                    <small>
                        Data Transaksi & Status Pembayaran
                    </small>

                </div>

            </a>


                    

        </div>

        {{-- USER FOOTER --}}
        <div class="sidebar-user">
            <div class="user-info">
                <div class="user-avatar">
                    @php
                        $nama = Auth::user()->nama ?? 'Admin';
                        $inisial = collect(explode(' ', $nama))
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    @endphp
                    {{ $inisial }}
                </div>
                <div style="min-width: 0;">
                    <div class="user-name">{{ Auth::user()->nama }}</div>
                    <div class="user-role">Admin Jurusan</div>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-icon" title="Logout">
                    <i class="bi bi-box-arrow-right"></i>
                </button>
            </form>
        </div>

    </aside>

    {{-- =====================================================
         MAIN CONTENT
    ====================================================== --}}
    <main class="main-content">

        {{-- TOPBAR --}}
        <nav class="topbar">
            <div class="topbar-left">
                {{-- Tombol Hamburger Mobile (Ukurannya sama persis dengan Admin TEFA) --}}
                <button type="button"
                    class="mobile-menu-btn"
                    id="mobileMenuBtn"
                    aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>

                <div class="topbar-title">
                    Dashboard Admin Jurusan
                </div>
            </div>
        </nav>

        {{-- PAGE CONTENT --}}
        <div class="content">
            @yield('content')
        </div>

    </main>

    {{-- =====================================================
         SCRIPT KONTROL SIDEBAR MOBILE
    ====================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.createElement('div');
            overlay.className = 'sidebar-overlay';
            document.body.appendChild(overlay);

            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarLinks = document.querySelectorAll('.sidebar-menu a');

            function toggleSidebar() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }

            function closeSidebar() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }

            if (mobileMenuBtn) {
                mobileMenuBtn.addEventListener('click', toggleSidebar);
            }

            if (overlay) {
                overlay.addEventListener('click', closeSidebar);
            }

            sidebarLinks.forEach(link => {
                link.addEventListener('click', closeSidebar);
            });
        });
    </script>

</body>
</html>