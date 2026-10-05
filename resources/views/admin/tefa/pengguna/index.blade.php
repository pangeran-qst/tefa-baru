@extends('admin.tefa.layouts.app')

@section('title', 'Dashboard Admin TEFA')

@section('content')
  
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>



  <!-- MAIN CONTENT -->
  <main class="flex-1 p-8 overflow-y-auto">
    <!-- Header Area -->
    <div class="flex justify-between items-start mb-6">
      <div>
        <h1 class="text-2xl font-bold text-slate-800">Manajemen Pengguna</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola akun dan lihat bagan organisasi TeFA</p>
      </div>

      <button
        type="button"
        onclick="openTambahPengguna()"
        class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-xl text-xs font-semibold flex items-center gap-2 shadow-sm transition">
        + Tambah Pengguna
      </button>
    </div>

    <!-- Main Navigation Tabs -->
    <div class="flex items-center bg-slate-200/60 p-1 rounded-xl w-fit mb-6 text-xs font-semibold text-slate-600">
      <button id="tab-kelola" class="px-5 py-2 rounded-lg bg-indigo-600 text-white shadow-sm transition">
        Kelola Akun
      </button>
    </div>

    <!-- VIEW 1: KELOLA AKUN -->
    <div id="view-kelola-akun" class="space-y-6">
      <!-- Sub-filter Role -->
      <div class="flex gap-2 text-xs font-semibold">

        <button type="button"
            id="btn-semua"
            onclick="switchUserTab('semua')"
            class="user-tab-btn px-5 py-2 rounded-xl bg-indigo-600 text-white shadow-sm transition">
            Semua
        </button>

        <button type="button"
            id="btn-admin_jurusan"
            onclick="switchUserTab('admin_jurusan')"
            class="user-tab-btn px-5 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition">
            Admin Jurusan
        </button>

        <button type="button"
            id="btn-worker"
            onclick="switchUserTab('worker')"
            class="user-tab-btn px-5 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition">
            Worker
        </button>

    </div>

      <!-- Table Container -->
      <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <table class="w-full table-fixed text-left text-xs "> 
          <thead class="bg-slate-50/50 border-b border-slate-200 text-slate-400 uppercase font-semibold">
            <tr>
              <th class="py-4 px-6 w-[18%] text-left">Nama Lengkap</th>
              <th class="py-4 px-6 w-[25%] text-left">Email</th>
              <th class="py-4 px-6 w-[15%] text-left">Role</th>
              <th class="py-4 px-6 w-[11%] text-left">Jurusan</th>
              <th class="py-4 px-6 w-[11%] text-left">Kelas</th>
              <th class="py-4 px-6 w-[10%] text-left">Status</th>
              <th class="py-4 px-6 w-[12%] text-center">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100 text-slate-600 font-medium">

            @forelse($users as $user)

                <tr data-role="{{ $user->role }}" class="user-row hover:bg-slate-50/80 transition-colors" class="hover:bg-slate-50/80 transition-colors">

                    {{-- Nama --}}
                    <td class="py-4 px-6">
                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-full bg-indigo-600 text-white font-bold flex items-center justify-center text-xs">
                                {{ strtoupper(substr($user->nama, 0, 1)) }}
                            </div>

                            <span class="font-semibold text-slate-800">
                                {{ $user->nama }}
                            </span>

                        </div>
                    </td>

                    {{-- Email --}}
                    <td class="py-4 px-6 whitespace-nowrap text-slate-500">
                      {{ $user->email }}
                    </td>

                    {{-- Role --}}
                    <td class="py-4 px-4">
                      @if($user->role === 'admin_tefa')
                          <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-violet-100 text-violet-800">
                              Admin TEFA
                          </span>

                      @elseif($user->role === 'admin_jurusan')
                          <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-blue-100 text-blue-700">
                              Admin Jurusan
                          </span>

                      @elseif($user->role === 'worker')
                          <span class="px-2.5 py-1 rounded-md text-[11px] font-semibold bg-emerald-100 text-emerald-700">
                              Worker
                          </span>
                      @endif
                  </td>

                    {{-- Jurusan --}}
                    <td class="py-4 px-4">

                        @if($user->jurusan)

                            <span class="px-2 py-0.5 rounded text-[11px] font-bold bg-slate-100 text-indigo-600">
                                {{ $user->jurusan }}
                            </span>

                        @else

                            <span class="text-slate-400">
                                -
                            </span>

                        @endif

                    </td>


                    {{-- Kelas --}}
                    <td class="py-4 px-15">
                        @if($user->kelas)
                            <span class="text-slate-700">
                                {{ $user->kelas }}
                            </span>
                        @else
                            <span class="text-slate-400">
                                -
                            </span>
                        @endif
                    </td>

                    {{-- Status --}}
                    <td class="py-4 px-4">

                        @if($user->role === 'worker')

                            <span class="font-bold text-emerald-600">
                                Available
                            </span>

                        @else

                            <span class="font-bold text-emerald-600">
                                Aktif
                            </span>

                        @endif

                    </td>

                    {{-- Aksi --}}
                    <td class="py-4 px-6 text-center space-x-2">

                        <button
                          type="button"
                          onclick="openEditPengguna({{ $user->id_user }})"
                          class="px-3 py-1 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-lg text-xs transition">
                          Edit
                        </button>

                        <form
                          action="{{ route('admin.tefa.pengguna.destroy', $user->id_user) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Yakin ingin menghapus akun {{ $user->nama }}?')">

                          @csrf
                          @method('DELETE')

                          <button
                              type="submit"
                              class="px-3 py-1 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg text-xs transition">
                              Hapus
                          </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>
                    <td colspan="7" class="py-10 text-center text-slate-400">
                        Belum ada akun Admin Jurusan atau Worker.
                    </td>
                </tr>

            @endforelse

        </tbody>
        </table>
      </div>
    </div>

    <!-- VIEW 2: BAGAN ORGANISASI -->
    <div id="view-bagan-organisasi" class="hidden bg-white p-8 rounded-2xl border border-slate-200/80 shadow-sm">
      <h2 class="text-center font-bold text-slate-700 tracking-wide text-xs mb-10 uppercase">
        Struktur Organisasi Teaching Factory — SMKN 4 Tanjungpinang
      </h2>

      <div class="flex flex-col items-center">
        <!-- Top Leader -->
        <div class="bg-indigo-600 text-white text-center px-8 py-4 rounded-2xl shadow-md min-w-[200px]">
          <p class="text-xs opacity-80">Ketua TeFA</p>
          <p class="font-bold text-sm">Bu Neni, S.Pd</p>
        </div>

        <!-- Vertical Connector Line -->
        <div class="w-0.5 h-8 bg-slate-300"></div>

        <!-- Horizontal Connector Line -->
        <div class="w-full max-w-4xl border-t-2 border-slate-300 relative"></div>

        <!-- Departments Grid -->
        <div class="grid grid-cols-6 gap-4 w-full max-w-5xl mt-8">
          <!-- RPL -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">RPL</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Ahmad Fauzi</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">12</p>
            </div>
          </div>

          <!-- DKV -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">DKV</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Sari Dewi</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">10</p>
            </div>
          </div>

          <!-- PSPT -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">PSPT</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Rudi Hartono</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">8</p>
            </div>
          </div>

          <!-- TKJ -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">TKJ</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Rina Susanti</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">9</p>
            </div>
          </div>

          <!-- GIM -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">GIM</p>
              <p class="text-[11px] text-slate-500 mt-1">Bpk. Eko Prasetyo</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">7</p>
            </div>
          </div>

          <!-- ANIMASI -->
          <div class="flex flex-col items-center gap-3">
            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-3 text-center w-full">
              <p class="font-bold text-indigo-700 text-xs">ANIMASI</p>
              <p class="text-[11px] text-slate-500 mt-1">Ibu Dewi Kartika</p>
            </div>
            <div class="bg-slate-50 border border-slate-200 rounded-xl p-3 text-center w-full">
              <p class="text-[10px] text-slate-400 uppercase">Workers</p>
              <p class="font-bold text-slate-800 text-sm">6</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- MODAL TAMBAH PENGGUNA -->
  <div id="modal-tambah-pengguna"
      class="hidden fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm items-center justify-center p-4">

      <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl overflow-hidden">

          <!-- HEADER -->
          <div class="px-6 py-5 border-b border-slate-200 flex items-start justify-between">
              <div>
                  <h2 class="text-lg font-bold text-slate-800">
                      Tambah Pengguna
                  </h2>

                  <p class="text-xs text-slate-500 mt-1">
                      Buat akun Admin Jurusan atau Worker
                  </p>
              </div>

              <button type="button"
                  onclick="closeTambahPengguna()"
                  class="text-slate-400 hover:text-slate-600 text-xl leading-none">
                  &times;
              </button>
          </div>


          <!-- FORM -->
          <form action="{{ route('admin.tefa.pengguna.store') }}"
                method="POST">

              @csrf

              <!-- BODY -->
              <div class="px-6 py-4 space-y-4 max-h-[60vh] overflow-y-auto">

                  <!-- NAMA -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Nama Lengkap
                      </label>

                      <input type="text"
                          name="nama"
                          value="{{ old('nama') }}"
                          placeholder="Masukkan nama lengkap"
                          autocomplete="off"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>


                  <!-- EMAIL -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Email
                      </label>

                      <input type="email"
                          name="email"
                          value="{{ old('email') }}"
                          placeholder="contoh@email.com"
                          autocomplete="off"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>


                  <!-- PASSWORD -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Password
                      </label>

                      <input type="password"
                          name="password"
                          placeholder="Minimal 5 karakter"
                          autocomplete="new-password"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>


                  <!-- ROLE -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Role
                      </label>

                      <select name="role"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 bg-white
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">

                          <option value="">Pilih Role</option>
                          <option value="admin_jurusan"
                              {{ old('role') == 'admin_jurusan' ? 'selected' : '' }}>
                              Admin Jurusan
                          </option>

                          <option value="worker"
                              {{ old('role') == 'worker' ? 'selected' : '' }}>
                              Worker
                          </option>
                      </select>
                  </div>


                  <!-- JURUSAN -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Jurusan
                      </label>

                      <select name="jurusan"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 bg-white
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">

                          <option value="">Pilih Jurusan</option>

                          <option value="RPL">RPL</option>
                          <option value="TKJ">TKJ</option>
                          <option value="GIM">GIM</option>
                          <option value="DKV">DKV</option>
                          <option value="PSPT">PSPT</option>
                          <option value="ANIMASI">ANIMASI</option>

                      </select>
                  </div>

                  {{-- KELAS --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Kelas
                      </label>

                      <input
                          type="text"
                          name="kelas"
                          value="{{ old('kelas') }}"
                          placeholder="Contoh: XI RPL 1"
                          autocomplete="off"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>


                  <!-- NO HP -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          No. HP
                          <span class="font-normal text-slate-400">(opsional)</span>
                      </label>

                      <input type="text"
                          name="no_hp"
                          value="{{ old('no_hp') }}"
                          placeholder="08xxxxxxxxxx"
                          autocomplete="off"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>


                  <!-- ALAMAT -->
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Alamat
                          <span class="font-normal text-slate-400">(opsional)</span>
                      </label>

                      <textarea
                          name="alamat"
                          rows="3"
                          placeholder="Masukkan alamat"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 resize-none
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">{{ old('alamat') }}</textarea>
                  </div>

              </div>


              <!-- FOOTER -->
              <div class="px-6 py-4 border-t border-slate-200 bg-slate-50
                          flex justify-end gap-3">

                  <button type="button"
                      onclick="closeTambahPengguna()"
                      class="px-4 py-2.5 rounded-xl border border-slate-200
                            bg-white text-slate-600 text-xs font-semibold
                            hover:bg-slate-100 transition">
                      Batal
                  </button>

                  <button type="submit"
                      class="px-5 py-2.5 rounded-xl bg-indigo-600
                            hover:bg-indigo-700 text-white text-xs
                            font-semibold shadow-sm transition">
                      Tambah Pengguna
                  </button>

              </div>

          </form>

      </div>
  </div>

  {{-- MODAL EDIT PENGGUNA --}}
  <div
      id="modalEditPengguna"
      class="hidden fixed inset-0 z-50 bg-slate-900/50 backdrop-blur-sm items-center justify-center p-4">

      <div class="bg-white w-full max-w-xl rounded-2xl shadow-xl overflow-hidden">

          {{-- HEADER --}}
          <div class="px-6 py-5 border-b border-slate-200 flex items-start justify-between">

              <div>
                  <h2 class="text-lg font-bold text-slate-800">
                      Edit Pengguna
                  </h2>

                  <p class="text-xs text-slate-500 mt-1">
                      Perbarui data akun pengguna
                  </p>
              </div>

              <button
                  type="button"
                  onclick="closeEditPengguna()"
                  class="text-slate-400 hover:text-slate-600 text-xl leading-none">
                  &times;
              </button>

          </div>

          {{-- FORM --}}
          <form
              id="formEditPengguna"
              method="POST">

              @csrf
              @method('PUT')

              {{-- BODY --}}
              <div class="px-6 py-4 space-y-4 max-h-[60vh] overflow-y-auto">

                  {{-- NAMA --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Nama Lengkap
                      </label>

                      <input
                          type="text"
                          id="edit_nama"
                          name="nama"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>

                  {{-- EMAIL --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Email
                      </label>

                      <input
                          type="email"
                          id="edit_email"
                          name="email"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>

                  {{-- ROLE --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Role
                      </label>

                      <select
                          id="edit_role"
                          name="role"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 bg-white
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">

                          <option value="admin_jurusan">
                              Admin Jurusan
                          </option>

                          <option value="worker">
                              Worker
                          </option>

                      </select>
                  </div>

                  {{-- JURUSAN --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Jurusan
                      </label>

                      <select
                          id="edit_jurusan"
                          name="jurusan"
                          required
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 bg-white
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">

                          <option value="RPL">RPL</option>
                          <option value="TKJ">TKJ</option>
                          <option value="GIM">GIM</option>
                          <option value="DKV">DKV</option>
                          <option value="PSPT">PSPT</option>
                          <option value="ANIMASI">ANIMASI</option>

                      </select>
                  </div>

                  {{-- KELAS --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Kelas
                      </label>

                      <input
                          type="text"
                          id="edit_kelas"
                          name="kelas"
                          required
                          class="w-full px-3 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>

                  {{-- NO HP --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          No. HP
                          <span class="font-normal text-slate-400">(opsional)</span>
                      </label>

                      <input
                          type="text"
                          id="edit_no_hp"
                          name="no_hp"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500">
                  </div>

                  {{-- ALAMAT --}}
                  <div>
                      <label class="block text-xs font-semibold text-slate-700 mb-1.5">
                          Alamat
                          <span class="font-normal text-slate-400">(opsional)</span>
                      </label>

                      <textarea
                          id="edit_alamat"
                          name="alamat"
                          rows="3"
                          class="w-full px-4 py-3 rounded-xl border border-slate-200
                                text-sm text-slate-700 resize-none
                                focus:outline-none focus:ring-2 focus:ring-indigo-500
                                focus:border-indigo-500"></textarea>
                  </div>

              </div>

              {{-- FOOTER --}}
              <div class="px-6 py-4 border-t border-slate-200 bg-slate-50
                          flex justify-end gap-3">

                  <button
                      type="button"
                      onclick="closeEditPengguna()"
                      class="px-4 py-2.5 rounded-xl border border-slate-200
                            bg-white text-slate-600 text-xs font-semibold
                            hover:bg-slate-100 transition">
                      Batal
                  </button>

                  <button
                      type="submit"
                      class="px-5 py-2.5 rounded-xl bg-indigo-600
                            hover:bg-indigo-700 text-white text-xs
                            font-semibold shadow-sm transition">
                      Simpan Perubahan
                  </button>

              </div>

          </form>

      </div>
  </div>

  <script>
    function switchUserTab(role) {

        // Ambil semua baris pengguna
        const rows = document.querySelectorAll('.user-row');

        // Tampilkan/sembunyikan berdasarkan role
        rows.forEach(row => {

            if (role === 'semua') {
                row.classList.remove('hidden');
            } else {
                if (row.dataset.role === role) {
                    row.classList.remove('hidden');
                } else {
                    row.classList.add('hidden');
                }
            }

        });


        // Reset semua tombol menjadi INAKTIF
        document.querySelectorAll('.user-tab-btn').forEach(btn => {

            btn.className =
                "user-tab-btn px-5 py-2 rounded-xl bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 transition";

        });


        // Tombol yang sedang aktif
        const activeBtn = document.getElementById('btn-' + role);

        if (activeBtn) {

            activeBtn.className =
                "user-tab-btn px-5 py-2 rounded-xl bg-indigo-600 text-white shadow-sm transition";

        }
    }

    // =========================
    // MODAL TAMBAH PENGGUNA
    // =========================

    function openTambahPengguna() {

        const modal = document.getElementById('modal-tambah-pengguna');

        if (!modal) {
            console.error('Modal tambah pengguna tidak ditemukan!');
            return;
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }


    function closeTambahPengguna() {

        const modal = document.getElementById('modal-tambah-pengguna');

        if (!modal) {
            return;
        }

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }


    function openEditPengguna(id) {
      const modal = document.getElementById('modalEditPengguna');
      const form = document.getElementById('formEditPengguna');

      const users = @json($users);
      const user = users.find(user => user.id_user == id);

      if (!user) {
          console.error('Data pengguna tidak ditemukan!');
          return;
      }

      form.action = `/admin/tefa/pengguna/${id}`;

      document.getElementById('edit_nama').value = user.nama || '';
      document.getElementById('edit_email').value = user.email || '';
      document.getElementById('edit_role').value = user.role || '';
      document.getElementById('edit_jurusan').value = user.jurusan || '';
      document.getElementById('edit_kelas').value = user.kelas || '';
      document.getElementById('edit_no_hp').value = user.no_hp || '';
      document.getElementById('edit_alamat').value = user.alamat || '';

      modal.classList.remove('hidden');
      modal.classList.add('flex');
    }

    function closeEditPengguna() {
        const modal = document.getElementById('modalEditPengguna');

        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

  </script>

  


 @endsection