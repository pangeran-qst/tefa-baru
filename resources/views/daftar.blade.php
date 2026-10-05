<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - TEFA SMKN 4 Tanjungpinang</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="icon" type="image/x-icon" href="logobg.png">
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 min-h-screen flex items-center justify-center p-4 font-sans text-white relative">

    <!-- Container Card (Glassmorphism Effect) -->
    <div class="w-full max-w-md bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 shadow-2xl my-8">
        
        <!-- Header / Logo -->
        <div class="flex flex-col items-center text-center mb-6">
            <img src="assets/images/favicon.png" alt="Logo" class="h-30 w-auto max-w-[120px] object-contain mb-3">
            <h2 class="text-xl font-bold">Daftar Akun</h2>
            <p class="text-xs text-blue-200 mt-1">Registrasi untuk klien / pelanggan umum</p>
        </div>

        <!-- Form -->
      <!-- Form Registrasi Laravel -->
        <form action="{{ route('daftar.proses') }}" method="POST" class="space-y-4">
            @csrf

            <!-- Nama Lengkap -->
            <div>
                <label for="nama" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="nama"
                    id="nama"
                    value="{{ old('nama') }}"
                    required
                    placeholder="Masukkan nama lengkap"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                >

                @error('nama')
                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nomor HP -->
            <div>
                <label for="no_hp" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Nomor WhatsApp / HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    id="no_hp"
                    value="{{ old('no_hp') }}"
                    placeholder="Contoh: 081234567890"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                >

                @error('no_hp')
                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="Masukkan alamat email"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                >

                @error('email')
                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Alamat -->
            <div>
                <label for="alamat" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    id="alamat"
                    rows="2"
                    placeholder="Masukkan alamat"
                    class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                >{{ old('alamat') }}</textarea>

                @error('alamat')
                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Password
                </label>

                <div class="relative">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        required
                        placeholder="Buat password"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition pr-10"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password', 'eyeOpen', 'eyeClosed')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-300/60 hover:text-white transition"
                    >
                        <svg id="eyeOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542-7z" />
                        </svg>

                        <svg id="eyeClosed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                        </svg>
                    </button>
                </div>

                @error('password')
                    <p class="text-red-300 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold mb-1.5 text-blue-100">
                    Konfirmasi Password
                </label>

                <div class="relative">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        required
                        placeholder="Ulangi password"
                        class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition pr-10"
                    >

                    <button
                        type="button"
                        onclick="togglePassword('password_confirmation', 'eyeOpenConfirm', 'eyeClosedConfirm')"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-300/60 hover:text-white transition"
                    >
                        <svg id="eyeOpenConfirm" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>

                        <svg id="eyeClosedConfirm" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Checkbox Terms -->
            <div class="flex items-start gap-2.5 pt-2">
                <input
                    type="checkbox"
                    id="terms"
                    required
                    class="mt-1 w-4 h-4 rounded border-white/30 bg-white/10 text-blue-600 focus:ring-blue-500 focus:ring-offset-0 cursor-pointer"
                >

                <label for="terms" class="text-xs text-blue-100 cursor-pointer leading-relaxed">
                    Saya menyetujui syarat & ketentuan TeFA SMKN 4 Tanjungpinang
                </label>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-500 font-semibold rounded-xl text-sm transition duration-200 shadow-lg shadow-blue-600/40 mt-4"
            >
                Daftar Akun
            </button>

            <!-- Login Link -->
            <div class="text-center text-xs text-blue-200 pt-2">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="font-bold text-white hover:underline">
                    Login di sini
                </a>
            </div>

        </form>
    </div>

    <!-- Footer Copyright -->
    <div class="absolute bottom-3 text-center text-[10px] text-blue-300/50">
        &copy; 2024 Teaching Factory SMKN 4 Tanjungpinang. All rights reserved.
    </div>

    <!-- Initialize Lucide Icons -->
   <script>
    function togglePassword(inputId, eyeOpenId, eyeClosedId) {
        const input = document.getElementById(inputId);
        const eyeOpen = document.getElementById(eyeOpenId);
        const eyeClosed = document.getElementById(eyeClosedId);

        if (input.type === 'password') {
            input.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            input.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }

    lucide.createIcons();
</script>
</body>
</html>