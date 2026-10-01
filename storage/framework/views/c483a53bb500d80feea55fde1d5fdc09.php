<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo $__env->yieldContent('title', 'Admin Jurusan'); ?></title>

    
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    
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

        /* Brand */

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 12px;

            padding: 12px 8px;
            margin-bottom: 16px;

            color: white;
            text-decoration: none;
        }

        .brand-logo {
            width: 40px;
            height: 40px;

            border-radius: 50%;

            background: #4f46e5;

            color: white;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 14px;
            font-weight: 700;

            box-shadow: 0 4px 12px rgba(79, 70, 229, .25);
        }

        .brand-title {
            color: white;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand-subtitle {
            color: #94a3b8;
            font-size: 12px;
            margin-top: 2px;
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

        .sidebar-menu .menu-title {
            color: #94a3b8;

            font-size: 11px;
            text-transform: uppercase;

            font-weight: 600;

            margin: 10px 10px 8px;
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

        /* Logout */

        .logout-form {
            margin-top: auto;
        }

        .logout-button {
            width: 100%;

            border: 0;
            background: transparent;

            color: #cbd5e1;

            display: flex;
            align-items: center;

            gap: 12px;

            padding: 10px 12px;

            border-radius: 12px;

            font-size: 12px;

            transition: .2s;
        }

        .logout-button:hover {
            background: rgba(51, 65, 85, .55);
            color: white;
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
        }

        .user-name {
            color: white;

            font-size: 11px;
            font-weight: 600;
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
        }

        .logout-icon:hover {
            color: white;
        }

        /* =====================================================
           MAIN
        ===================================================== */

        .main-content {
            margin-left: 256px;

            min-height: 100vh;

            background: #f1f5f9;
        }

        /* =====================================================
           TOPBAR
        ===================================================== */

        .topbar {
            height: 64px;

            background: white;

            border-bottom: 1px solid #e2e8f0;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 32px;
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

        .topbar-user:hover {
            background: #f1f5f9;
        }

        /* =====================================================
           CONTENT
        ===================================================== */

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
           CARD
        ===================================================== */

        .stat-card,
        .content-card {
            background: white;

            border: 1px solid rgba(226, 232, 240, .8);

            border-radius: 18px;

            box-shadow: 0 2px 6px rgba(15, 23, 42, .04);
        }

        .stat-card {
            border: 1px solid #e2e8f0;
        }

        .stat-icon {
            width: 48px;
            height: 48px;

            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 20px;
        }

        /* Button */

        .btn-primary {
            background: #4f46e5;
            border-color: #4f46e5;

            border-radius: 9px;
        }

        .btn-primary:hover {
            background: #4338ca;
            border-color: #4338ca;
        }

        /* =====================================================
           ALERT
        ===================================================== */

        .alert {
            border-radius: 12px;
        }

        /* =====================================================
           RESPONSIVE
        ===================================================== */

        @media (max-width: 768px) {

            .sidebar {
                width: 72px;

                padding: 12px;
            }

            .sidebar-brand {
                justify-content: center;
                padding: 10px 0;
            }

            .brand-logo {
                width: 40px;
                height: 40px;
            }

            .brand-title,
            .brand-subtitle,
            .school-card,
            .menu-text,
            .menu-title,
            .sidebar-user .user-info {
                display: none;
            }

            .sidebar-menu a {
                justify-content: center;

                padding: 12px;
            }

            .sidebar-menu a i {
                margin: 0;
            }

            .sidebar-user {
                justify-content: center;
            }

            .logout-icon {
                display: none;
            }

            .main-content {
                margin-left: 72px;
            }

            .content {
                padding: 20px;
            }

            .topbar {
                padding: 0 20px;
            }

        }

    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>

</head>

<body>

    

    <aside class="sidebar">

        
        <a href="<?php echo e(route('admin.jurusan.dashboard')); ?>"
            class="sidebar-brand">

            <div class="brand-logo">
                TF
            </div>

            <div>
                <div class="brand-title">
                    Tefa Platform
                </div>

                <div class="brand-subtitle">
                    Admin Jurusan
                </div>
            </div>

        </a>


        
        <!-- <div class="school-card">

            <div class="school-name">
                SMKN 4 Tanjungpinang
            </div>

            <div class="school-badge">
                Rekayasa Perangkat Lunak
            </div>

            <div class="school-leader">
                Ketua: Shinta Febrina, S.Kom
            </div>

        </div> -->


        
        <div class="sidebar-menu">

            
            <a href="<?php echo e(route('admin.jurusan.dashboard')); ?>" class="<?php echo e(request()->routeIs('admin.jurusan.dashboard') ? 'active' : ''); ?>">

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


            


            


            
            <a href="<?php echo e(route('admin.jurusan.pesanan')); ?>"
                class="<?php echo e(request()->routeIs('admin.jurusan.pesanan*') ? 'active' : ''); ?>">

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




            
            <a href="<?php echo e(route('admin.jurusan.pengguna')); ?>"
                class="<?php echo e(request()->routeIs('admin.jurusan.pengguna*') ? 'active' : ''); ?>">

                <i class="bi bi-people-fill"></i>

                <div class="menu-text">

                    <span>
                        Manajemen Pengguna
                    </span>

                    <small>
                        Akun & Struktur Org
                    </small>

                </div>

            </a>

        </div>


        
        <div class="sidebar-user">

            <div class="user-info">

                <div class="user-avatar">

                    <?php
                        $nama = Auth::user()->nama ?? 'Admin';
                        $inisial = collect(explode(' ', $nama))
                            ->map(fn($word) => strtoupper(substr($word, 0, 1)))
                            ->take(2)
                            ->implode('');
                    ?>

                    <?php echo e($inisial); ?>


                </div>

                <div>

                    <div class="user-name">
                        <?php echo e(Auth::user()->nama); ?>

                    </div>

                    <div class="user-role">
                        Admin Jurusan
                    </div>

                </div>

            </div>


            
            <form action="<?php echo e(route('logout')); ?>" method="POST">

                <?php echo csrf_field(); ?>

                <button
                    type="submit"
                    class="logout-icon"
                    title="Logout">

                    <i class="bi bi-box-arrow-right"></i>

                </button>

            </form>

        </div>

    </aside>


    

    <main class="main-content">


        
        <nav class="topbar">

            <div class="topbar-title">
                Dashboard AdminJurusan
            </div>


            <div class="dropdown">

                <button
                    class="topbar-user dropdown-toggle"
                    type="button"
                    data-bs-toggle="dropdown">

                    <i class="bi bi-person-circle me-2"></i>

                    <?php echo e(Auth::user()->nama); ?>


                </button>


                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <span class="dropdown-item-text text-muted">

                            <?php echo e(Auth::user()->email); ?>


                        </span>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <a class="dropdown-item" href="#">

                            <i class="bi bi-person me-2"></i>

                            Profil

                        </a>

                    </li>

                </ul>

            </div>

        </nav>


        
        <div class="content">


            
            <?php if(session('success')): ?>

                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert">

                    <i class="bi bi-check-circle me-2"></i>

                    <?php echo e(session('success')); ?>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            <?php endif; ?>


            
            <?php if(session('error')): ?>

                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert">

                    <i class="bi bi-exclamation-circle me-2"></i>

                    <?php echo e(session('error')); ?>


                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="alert">
                    </button>

                </div>

            <?php endif; ?>


            
            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </main>


    
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/admin/jurusan/layouts/app.blade.php ENDPATH**/ ?>