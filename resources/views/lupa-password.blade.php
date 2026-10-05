<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - TEFA SMKN 4 Tanjungpinang</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" type="image/x-icon" href="logobg.png">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 min-h-screen flex items-center justify-center p-4 font-sans text-white relative">

    <!-- Container Utama Card (Glassmorphism Effect) -->
    <div class="w-full max-w-md bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-6 sm:p-8 shadow-2xl my-8">
        
        <!-- Header / Logo -->
        <div class="flex flex-col items-center text-center mb-6">
            <img src="logobg.png" alt="Logo SMKN 4 Tanjungpinang" class="h-30 w-auto max-w-[120px] object-contain mb-3">
            <h2 class="text-xl font-bold">Lupa Password</h2>
            <p class="text-xs text-blue-200 mt-1">Pulihkan akses akun Anda</p>
        </div>

        <!-- Box Opsi 1: Reset via Email / OTP -->
        <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-4">
            <div class="flex items-center gap-2 text-sm font-semibold text-white mb-3">
                <i data-lucide="mail" class="w-4 h-4 text-blue-300"></i>
                <span>Opsi 1: Reset via Email / OTP</span>
            </div>

            <form class="space-y-3">
                <div>
                    <label class="block text-xs font-medium text-blue-200 mb-1.5">Email Terdaftar</label>
                    <input type="email" placeholder="Masukkan email akun Anda" 
                        class="w-full px-4 py-2.5 bg-white/10 border border-white/20 rounded-lg text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                </div>

                <button type="submit" 
                    class="w-full py-2.5 bg-blue-600 hover:bg-blue-500 font-semibold rounded-lg text-sm transition duration-200 shadow-md shadow-blue-600/30">
                    Kirim Link Reset
                </button>
            </form>
        </div>

        <!-- Box Opsi 2: Bantuan Langsung Admin -->
        <div class="bg-white/5 border border-white/10 rounded-xl p-4 mb-6">
            <div class="flex items-center gap-2 text-sm font-semibold text-white mb-1.5">
                <i data-lucide="phone" class="w-4 h-4 text-blue-300"></i>
                <span>Opsi 2: Bantuan Langsung Admin</span>
            </div>

            <p class="text-[11px] text-blue-200/80 mb-3 leading-relaxed">
                Khusus Siswa/Worker yang lupa akun. Hubungi Admin TeFA melalui WhatsApp.
            </p>

            <a href="https://wa.me/" target="_blank" 
                class="w-full py-2.5 bg-emerald-500 hover:bg-emerald-400 text-white font-semibold rounded-lg text-sm transition duration-200 shadow-md shadow-emerald-500/30 flex items-center justify-center gap-2">
                <i data-lucide="phone" class="w-4 h-4"></i>
                <span>Hubungi Admin TeFA untuk Reset Akun</span>
            </a>
        </div>

        <!-- Kembali ke Login -->
        <div class="text-center">
            <a href="login.html" class="inline-flex items-center gap-1 text-xs text-blue-200 hover:text-white transition font-medium">
                <i data-lucide="chevron-left" class="w-4 h-4"></i>
                <span>Kembali ke Login</span>
            </a>
        </div>

    </div>

    <!-- Footer Copyright -->
    <div class="absolute bottom-3 text-center text-[10px] text-blue-300/50">
        &copy; 2024 Teaching Factory SMKN 4 Tanjungpinang. All rights reserved.
    </div>

    <!-- Script Inisialisasi Lucide Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>
</html>