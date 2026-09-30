<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://cdn.tailwindcss.com"></script>

  <title>Layanan & Produk RPL - TeFA SMKN 4 Tanjungpinang</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      background-color: #f8fafc;
      color: #334155;
    }


    /* Hero Section RPL */
    .hero {
      background-color: rgb(235, 172, 37);
      color: white;
      padding: 32px 8% 48px 8%;
    }

    .back-link {
      color: #ffffff;
      text-decoration: none;
      font-size: 14px;
      display: inline-block;
      margin-bottom: 24px;
    }

    .hero-title-container {
      display: flex;
      align-items: center;
      gap: 16px;
      margin-bottom: 24px;
    }

    .hero-icon {
      width: 56px;
      height: 56px;
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
    }

    .hero h1 {
      font-size: 28px;
      font-weight: bold;
    }

    .hero p {
      color: #ffffff;
      font-size: 14px;
    }

    .search-box {
      max-width: 400px;
      position: relative;
    }

    .search-box input {
      width: 100%;
      padding: 10px 16px 10px 38px;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      background-color: rgba(255, 255, 255, 0.15);
      color: white;
      outline: none;
      font-size: 14px;
    }

    .search-box input::placeholder {
      color: #ffffff;
    }

    .search-icon {
      position: absolute;
      left: 12px;
      top: 50%;
      transform: translateY(-50%);
      color: #ffffff;
    }

    /* Content Layout */
    .content-layout {
      display: flex;
      gap: 28px;
      max-width: 1200px;
      margin: 32px auto;
      padding: 0 20px;
    }

    /* Sidebar Navigation */
    .sidebar {
      width: 240px;
      background: white;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
      height: fit-content;
    }

    .sidebar-title {
      font-size: 12px;
      font-weight: 700;
      color: #64748b;
      letter-spacing: 0.5px;
      margin-bottom: 16px;
      text-transform: uppercase;
    }

    .sidebar-menu {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .sidebar-menu li a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 8px;
      text-decoration: none;
      color: #475569;
      font-size: 14px;
      font-weight: 600;
    }

    .sidebar-menu li.active a {
      background-color: rgb(58, 58, 237);
      color: white;
    }

    /* Services Grid */
    .services-grid {
      flex: 1;
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
      gap: 24px;
    }

    .service-card {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
      display: flex;
      flex-direction: column;
    }

    .service-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }

    .service-body {
      padding: 20px;
      display: flex;
      flex-direction: column;
      flex-grow: 1;
    }

    .service-body h3 {
      font-size: 18px;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .service-body p {
      font-size: 13px;
      color: #64748b;
      line-height: 1.5;
      margin-bottom: 20px;
      flex-grow: 1;
    }

    .service-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .price-label {
      font-size: 12px;
      color: #64748b;
    }

    .price-value {
      font-size: 16px;
      font-weight: bold;
      color: #000000;
    }

    .btn-detail {
      background-color: rgb(58, 58, 237);
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
    }

    /* Modal Styling */
    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(15, 23, 42, 0.6);
      backdrop-filter: blur(4px);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 1000;
    }

    .modal-overlay.active {
      display: flex;
    }

    .modal-card {
      background: white;
      border-radius: 16px;
      width: 90%;
      max-width: 480px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    }

    .modal-close {
      position: absolute;
      top: 16px;
      right: 16px;
      background: white;
      border: none;
      font-size: 18px;
      cursor: pointer;
      color: #64748b;
      width: 28px;
      height: 28px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      z-index: 2;
    }

    .modal-img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .modal-body {
      padding: 20px 24px 24px 24px;
    }

    .modal-body h3 {
      font-size: 20px;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .modal-desc {
      font-size: 13px;
      color: #64748b;
      margin-bottom: 20px;
      line-height: 1.5;
    }

    .spec-box {
      background-color: rgb(245, 243, 255);
      border-radius: 10px;
      padding: 16px;
      margin-bottom: 20px;
      display: flex;
      flex-direction: column;
      gap: 12px;
      font-size: 13px;
    }

    .spec-row {
      display: flex;
    }

    .spec-label {
      width: 100px;
      color: rgb(0, 0, 0);
      font-weight: 600;
    }

    .spec-value {
      flex: 1;
      color: #334155;
    }

    .btn-block {
      width: 100%;
      background-color: rgb(58, 58, 237);
      color: white;
      border: none;
      padding: 12px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      cursor: pointer;
    }

    .form-group {
      margin-bottom: 16px;
    }

    .form-group label {
      display: block;
      font-size: 13px;
      font-weight: 600;
      color: #334155;
      margin-bottom: 6px;
    }

    .form-group input, .form-group textarea {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      outline: none;
      font-size: 14px;
      background-color: #f8fafc;
    }

    .form-group textarea {
      resize: vertical;
      height: 80px;
    }


    /* Responsif Mobile */
    @media (max-width: 768px) {
    .content-layout {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
    }
    }
  </style>
</head>
<body>

    <header class="sticky top-0 z-[1000] flex items-center justify-between bg-white px-[5%] md:px-[8%] py-4 shadow-sm">
      {{-- LOGO --}}
      <a href="{{ url('/') }}" class="flex items-center gap-3">
          <img
              src="{{ asset('gambar/tefa/logo.png') }}"
              alt=""
              class="h-10 w-auto max-w-[120px] object-contain"
          >

          <div>
              <div class="text-[15px] font-bold leading-tight text-slate-900">
                  TeFA SMKN 4
              </div>

              <div class="text-xs text-blue-500">
                  Tanjungpinang
              </div>
          </div>
      </a>


      {{-- BAGIAN KANAN NAVBAR --}}
      <div class="flex items-center gap-4">

          {{-- NAVIGASI UTAMA --}}
          <nav id="navMenu"
              class="hidden absolute top-[72px] left-0 right-0 flex-col gap-2 bg-white px-[5%] py-4 shadow-lg md:static md:flex md:flex-row md:items-center md:gap-6 md:p-0 md:shadow-none">

              {{-- BERANDA --}}
              <a href="{{ url('/') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Beranda
              </a>

              {{-- LAYANAN --}}
              <a href="{{ route('katalog') }}"
                  class="rounded-md bg-blue-700 px-4 py-2 text-sm font-medium text-white">
                  Layanan
              </a>

              {{-- CEK TIKET --}}
              <a href="{{ route('cek.ticket') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Cek Tiket
              </a>

              {{-- KONTAK --}}
              <a href="{{ route('kontak') }}"
                  class="rounded-md px-4 py-2 text-sm font-medium text-slate-600 transition hover:bg-blue-700 hover:text-white">
                  Kontak
              </a>
          </nav>


          {{-- ICON PROFIL / USER --}}
          <div class="relative group">

              @if(Auth::check() && Auth::user()->role === 'client')
                  
                  {{-- 1. TAMPILAN JIKA USER CLIENT SUDAH LOGIN --}}
                  <button type="button"
                      class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-blue-700 text-white font-bold shadow-md transition hover:bg-blue-800"
                      aria-label="Profil">
                      {{-- Inisial Huruf Nama Client --}}
                      {{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}
                  </button>

                  {{-- DROPDOWN PROFIL CLIENT --}}
                  <div class="absolute right-0 top-full z-50 hidden pt-2 group-hover:block">
                      <div class="w-48 rounded-xl border border-slate-200 bg-white p-2 shadow-lg">

                          {{-- INFORMASI USER --}}
                          <div class="border-b border-slate-100 px-4 py-2">
                              <p class="text-sm font-semibold text-slate-900 truncate">
                                  {{ Auth::user()->nama }}
                              </p>
                              <p class="mt-0.5 text-xs text-slate-500 truncate">
                                  {{ Auth::user()->email }}
                              </p>
                          </div>

                          {{-- MENU PROFIL --}}
                          <a href="{{ route('client.dashboard') }}"
                              class="block rounded-lg px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-blue-50 hover:text-blue-700">
                              Profil Saya
                          </a>

                          {{-- LOGOUT --}}
                          <div class="mt-1 border-t border-slate-100 pt-1">
                              <form action="{{ route('logout') }}" method="POST">
                                  @csrf
                                  <button type="submit"
                                      class="w-full rounded-lg px-4 py-2.5 text-left text-sm font-medium text-red-600 transition hover:bg-red-50">
                                      Logout
                                  </button>
                              </form>
                          </div>

                      </div>
                  </div>

              @else

                  {{-- 2. TAMPILAN JIKA GUEST / BELUM LOGIN --}}
                  <a href="{{ route('login', ['redirect' => url()->current()]) }}"
                      class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 shadow-sm transition hover:bg-blue-700 hover:text-white"
                      title="Login"
                      aria-label="Login">

                      {{-- Icon Guest / User Normal --}}
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                          stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round"
                              d="M15.75 6.75a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.5 20.25a7.5 7.5 0 0 1 15 0" />
                      </svg>
                  </a>

              @endif

          </div>

      </div>

      {{-- TOMBOL MENU MOBILE --}}
      <button class="block md:hidden rounded-md bg-blue-700 px-3 py-2 text-lg text-white" onclick="toggleMenu()"
          aria-label="Buka Menu Navigasi">
          ☰
      </button>
  </header>

  <section class="hero">
    <a href="{{ route('katalog') }}" class="back-link">← Kembali ke Katalog</a>
    <div class="hero-title-container">
      <div class="hero-icon">💻</div>
      <div>
        <h1>Layanan & Produk RPL</h1>
        <p>Rekayasa Perangkat Lunak</p>
      </div>
    </div>
    <div class="search-box">
      <span class="search-icon">🔍</span>
      <input type="text" id="searchInput" placeholder="Cari layanan RPL..." onkeyup="filterServices()">
    </div>
  </section>

  <div class="content-layout">
    <aside class="sidebar">
      <div class="sidebar-title">Jurusan Lain</div>
      <ul class="sidebar-menu">
        <li class="active"><a href="{{ route('katalog.rpl') }}">RPL</a></li>
        <li><a href="{{ route('katalog.dkv') }}">DKV</a></li>
        <li><a href="{{ route('katalog.pspt') }}">PSPT</a></li>
        <li><a href="{{ route('katalog.tkj') }}">TKJ</a></li>
        <li><a href="{{ route('katalog.gim') }}">GIM</a></li>
        <li><a href="{{ route('katalog.animasi') }}">ANIMASI</a></li>
      </ul>
    </aside>

    <main class="services-grid" id="servicesGrid">

    @forelse($tefas as $tefa)

        <div class="service-card">

            {{-- FOTO DARI DATABASE --}}
            @if($tefa->gambar)
                <img
                    src="{{ asset('gambar/tefa/' . $tefa->gambar) }}"
                    alt="{{ $tefa->nama_produk }}"
                    class="service-img">
            @else
                <div
                    class="service-img"
                    style="display:flex; align-items:center; justify-content:center; background:#dbeafe; font-size:50px;">
                    💻
                </div>
            @endif

            <div class="service-body">

                {{-- NAMA PRODUK --}}
                <h3>
                    {{ $tefa->nama_produk }}
                </h3>

                {{-- DESKRIPSI --}}
                <p>
                    {{ $tefa->deskripsi }}
                </p>

                <div class="service-footer">

                    <div>
                        <div class="price-label">
                            Mulai dari
                        </div>

                        {{-- HARGA DARI DATABASE --}}
                        <div class="price-value">
                            Rp {{ number_format($tefa->harga, 0, ',', '.') }}
                        </div>
                    </div>

                    <button
                      class="btn-detail"
                      onclick="openDetailModal(
                          {{ $tefa->id_produk }},
                          @js($tefa->nama_produk),
                          @js($tefa->deskripsi),
                          'Layanan RPL',
                          'Hubungi kami untuk informasi lebih lanjut',
                          'Rp {{ number_format($tefa->harga, 0, ',', '.') }}',
                          @js($tefa->gambar ? asset('gambar/tefa/' . $tefa->gambar) : '')
                      )">
                      Detail Jasa
                  </button>
                </div>
            </div>
        </div>

    @empty

        <div style="grid-column: 1 / -1; text-align:center; padding:60px 20px; background:white; border-radius:12px;">
            <div style="font-size:50px;">💻</div>

            <h3 style="margin-top:15px; font-size:18px; color:#0f172a;">
                Belum Ada Layanan RPL
            </h3>

            <p style="margin-top:8px; color:#64748b;">
                Layanan RPL belum tersedia saat ini.
            </p>
        </div>

    @endforelse

    </main>
  </div>

  <div class="modal-overlay" id="detailModal">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('detailModal')">✕</button>
      <img id="detailImg" src="" alt="Detail Image" class="modal-img">
      <div class="modal-body">
        <h3 id="detailTitle">Layanan Pengembangan Software</h3>
        <p id="detailDesc" class="modal-desc">Pengembangan website, aplikasi, dan sistem sesuai kebutuhan.</p>
        
        <div class="spec-box">
          <div class="spec-row">
            <span class="spec-label">Spesifikasi</span>
            <span id="detailSpec" class="spec-value">Hubungi kami untuk informasi lebih lanjut</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Durasi</span>
            <span id="detailDuration" class="spec-value">Hubungi kami untuk informasi lebih lanjut</span>
          </div>
          <div class="spec-row">
            <span class="spec-label">Mulai dari</span>
            <span id="detailPrice" class="spec-value" style="font-weight: bold; color: #000000;"></span>
          </div>
        </div>

        <button class="btn-block" onclick="switchToFormModal()">Beli</button>
      </div>
    </div>
  </div>

  <div class="modal-overlay" id="formModal">
    <div class="modal-card">
      <button class="modal-close" onclick="closeModal('formModal')">✕</button>
      <div class="modal-body" style="padding-top: 24px;">
        <h3 style="font-size: 18px; color: #000000;">Form Pemesanan</h3>
        <p id="formServiceName" style="font-size: 13px; color: #000000; font-weight: 600; margin-bottom: 20px;">Layanan RPL</p>
        <form onsubmit="submitForm(event)">

          <div class="form-group">
              <label for="nama">Nama Lengkap</label>
              <input
                  type="text"
                  id="nama"
                  placeholder="Nama Anda"
                  required>
          </div>

          <div class="form-group">
              <label for="email">Email</label>
              <input
                  type="email"
                  id="email"
                  placeholder="nama@email.com"
                  required>
          </div>

          <div class="form-group">
              <label for="whatsapp">Nomor WhatsApp</label>
              <input
                  type="tel"
                  id="whatsapp"
                  placeholder="08xx-xxxx-xxxx"
                  required>
          </div>

          <div class="form-group">
              <label for="catatan">Catatan / Kebutuhan Proyek</label>
              <textarea
                  id="catatan"
                  placeholder="Ceritakan kebutuhan proyek Anda..."></textarea>
          </div>

          <button type="submit" class="btn-block">
              Kirim Pesanan
          </button>
      </form>
      </div>
    </div>
  </div>

  <footer class="mt-[60px] bg-blue-900 px-5 md:px-[8%] pt-10 pb-5 text-white">
        <div class="mb-10 flex flex-wrap justify-between gap-8">
        <div>
            <h3 class="mb-2 text-base md:text-lg font-bold">TeFA SMKN 4 Tanjungpinang</h3>
            <p class="text-xs text-blue-300">Teaching Factory</p>
            <p class="mt-3 max-w-[300px] text-xs text-slate-300">
            Produk dan jasa profesional karya siswa SMKN 4 Tanjungpinang yang terlatih dan bersertifikat.
            </p>
        </div>
        <div>
            <h4 class="mb-4 text-sm font-semibold">Kontak & Lokasi</h4>
            <ul class="space-y-2 text-xs md:text-sm text-slate-300">
            <li>📍 Jl. Nusantara No.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29157</li>
            <li>📞 0771-4440844 (WhatsApp CS)</li>
            <li>⏰ Senin–Jumat, 07.00–18.00 WIB</li>
            <li>🌐 tefa.smkn4tpi.sch.id</li>
            </ul>
        </div>
        </div>
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 border-t border-white/10 pt-5 text-center text-xs text-blue-300">
        <span>© 2026 TeFA SMKN 4 Tanjungpinang. Semua hak dilindungi.</span>
        <span>Dibuat dengan ❤️ oleh siswa-siswi TeFA</span>
        </div>
  </footer>

  <script>
    let currentService = {
      id_produk: '',
      title: '',
      desc: '',
      spec: '',
      duration: '',
      price: '',
      img: ''
    };

    function toggleMenu() {
        const nav = document.getElementById('navMenu');

        nav.classList.toggle('hidden');
        nav.classList.toggle('flex');
    }

    function openDetailModal(id_produk, title, desc, spec, duration, price, img) {
      currentService = { id_produk, title, desc, spec, duration, price, img };

      document.getElementById('detailTitle').innerText = title;
      document.getElementById('detailDesc').innerText = desc;
      document.getElementById('detailSpec').innerText = spec;
      document.getElementById('detailDuration').innerText = duration;
      document.getElementById('detailPrice').innerText = price;
      document.getElementById('detailImg').src = img;

      document.getElementById('detailModal').classList.add('active');
    }

    function closeModal(modalId) {
      document.getElementById(modalId).classList.remove('active');
    }

    function switchToFormModal() {
        closeModal('detailModal');

        document.getElementById('formServiceName').innerText =
            currentService.title;

        document.getElementById('formModal').classList.add('active');
    }

    function filterServices() {
      const input = document.getElementById('searchInput').value.toLowerCase();
      const cards = document.querySelectorAll('#servicesGrid .service-card');

      cards.forEach(card => {
        const title = card.querySelector('h3').innerText.toLowerCase();
        const desc = card.querySelector('p').innerText.toLowerCase();
        
        if (title.includes(input) || desc.includes(input)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }

    async function submitForm(e) {
      e.preventDefault();

      const nama = document.getElementById('nama').value;
      const email = document.getElementById('email').value;
      const wa = document.getElementById('whatsapp').value;
      const catatan = document.getElementById('catatan').value;

      try {
          const response = await fetch("{{ route('pesanan.store') }}", {
              method: "POST",
              headers: {
                  "Content-Type": "application/json",
                  "X-CSRF-TOKEN": "{{ csrf_token() }}",
                  "Accept": "application/json"
              },
              body: JSON.stringify({
                  id_produk: currentService.id_produk,
                  nama_pemesan: nama,
                  email_pemesan: email,
                  no_hp_pemesan: wa,
                  catatan_pesanan: catatan
              })
          });

          const data = await response.json();

          if (!response.ok) {
              alert(data.message || 'Pesanan gagal disimpan.');
              return;
          }

          alert('Pesanan berhasil dikirim!');

          closeModal('formModal');

      } catch (error) {
          console.error(error);
          alert('Terjadi kesalahan saat mengirim pesanan.');
      }
    }
  </script>
</body>
</html>