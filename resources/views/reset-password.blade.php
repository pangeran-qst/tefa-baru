<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Reset Password</title>
  
  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Lucide Icons -->
  <script src="https://unpkg.com/lucide@latest"></script>
  
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body class="bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-950 min-h-screen flex items-center justify-center p-4 font-sans text-white relative">

  <!-- Container Card (Glassmorphism Effect) -->
  <div class="w-full max-w-md bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl p-8 shadow-2xl my-8">
    
    <!-- Header / Logo -->
    <div class="flex flex-col items-center text-center mb-6">
      <a href="{{'/'}}">
        <img src="assets/images/favicon.png" alt="Logo" class="h-30 w-auto max-w-[120px] object-contain mb-3">
      </a>
      <h2 class="text-xl font-bold">Reset Password</h2>
    </div>

    <!-- Form Reset Password Laravel -->
    <form action="{{ route('password.update') }}" method="POST" class="space-y-4">

        <!-- Area untuk menampilkan pesan error -->
      @if ($errors->any())
        <div class="bg-red-500/20 border border-red-500 text-red-100 px-4 py-3 rounded-xl text-sm mb-4">
          <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <!-- Area untuk menampilkan pesan sukses -->
      @if (session('status'))
        <div class="bg-green-500/20 border border-green-500 text-green-100 px-4 py-3 rounded-xl text-sm mb-4">
          {{ session('status') }}
        </div>
      @endif

      @csrf

      <!-- Wajib ada: Token keamanan dari URL -->
      <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">
      
      <!-- Wajib ada: Email dari URL -->
      <input type="hidden" name="email" value="{{ request()->email }}">

      <!-- Field Password Baru -->
      <div>
        <label for="password" class="block text-sm font-semibold mb-1.5 text-blue-100">Password Baru</label>
        <div class="relative">
          <input 
            type="password" 
            name="password" 
            id="password" 
            required 
            placeholder="Masukkan password baru" 
            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition pr-10"
          >
          <!-- Toggle Eye Icon 1 -->
          <button 
            type="button" 
            onclick="toggleVisibility('password', 'eyeOpen1', 'eyeClosed1')" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-300/60 hover:text-white transition"
            title="Lihat Password"
          >
            <!-- Mata Terbuka SVG -->
            <svg id="eyeOpen1" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Mata Tertutup SVG -->
            <svg id="eyeClosed1" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Field Konfirmasi Password Baru -->
      <div>
        <label for="password_confirmation" class="block text-sm font-semibold mb-1.5 text-blue-100">Konfirmasi Password Baru</label>
        <div class="relative">
          <input 
            type="password" 
            name="password_confirmation" 
            id="password_confirmation" 
            required 
            placeholder="Ulangi password baru" 
            class="w-full px-4 py-3 bg-white/10 border border-white/20 rounded-xl text-sm placeholder-blue-300/60 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition pr-10"
          >
          <!-- Toggle Eye Icon 2 -->
          <button 
            type="button" 
            onclick="toggleVisibility('password_confirmation', 'eyeOpen2', 'eyeClosed2')" 
            class="absolute right-3 top-1/2 -translate-y-1/2 text-blue-300/60 hover:text-white transition"
            title="Lihat Password"
          >
            <!-- Mata Terbuka SVG -->
            <svg id="eyeOpen2" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
            <!-- Mata Tertutup SVG -->
            <svg id="eyeClosed2" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858-5.908a10.018 10.018 0 014.122-.863c4.478 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21M3 3l18 18" />
            </svg>
          </button>
        </div>
      </div>

      <!-- Submit Button -->
      <button 
        type="submit" 
        class="w-full py-3 bg-blue-600 hover:bg-blue-500 font-semibold rounded-xl text-sm transition duration-200 shadow-lg shadow-blue-600/40 mt-4"
      >
        Simpan Password Baru
      </button>
      
      <!-- Link Kembali ke Login -->
      <div class="text-center text-xs text-blue-200 pt-2">
        Ingat password Anda?
        <a href="{{ route('login') }}" class="font-bold text-white hover:underline">
            Kembali ke Login
        </a>
      </div>

    </form>

  </div>

  <!-- JAVASCRIPT LOGIC TOGGLE PASSWORD DINAMIS -->
  <script>
    function toggleVisibility(inputId, openIconId, closedIconId) {
      const input = document.getElementById(inputId);
      const eyeOpen = document.getElementById(openIconId);
      const eyeClosed = document.getElementById(closedIconId);

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