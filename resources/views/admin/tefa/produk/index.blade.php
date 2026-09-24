@extends('admin.tefa.layouts.app')

@section('title', 'CMS Katalog & Jurusan')

@section('content')



    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    {{-- ========================================
         HTML CMS DARI FRONTEND LU
         ======================================== --}}

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                CMS Katalog & ADMIN
            </h1>

            <p class="text-xs text-slate-500 mt-0.5">
                Kelola data master jurusan dan katalog produk/jasa publik
            </p>
        </div>

        <div class="flex items-center gap-2">

            {{-- TOMBOL CETAK PDF --}}
            <button
                type="button"
                onclick="cetakKatalogPDF()"
                class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-lg shadow-red-600/20 transition flex items-center gap-2"
            >
                <i class="bi bi-file-earmark-pdf"></i>
                Cetak PDF
            </button>

            {{-- TOMBOL TAMBAH --}}
            <button
                id="btn-tambah"
                type="button"
                class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-lg shadow-indigo-600/20 transition flex items-center gap-2"
                onclick="tambahProduk()"
            >
                + Tambah Produk
            </button>

        </div>

    </div>


    



    {{-- TAB CMS --}}

    <div class="flex gap-2 border-b border-slate-200 mb-6">

        <button
            class="tab-switch px-4 py-2.5 text-xs font-semibold rounded-t-xl transition text-slate-500"
            
            data-tab="jurusan" 
            onclick="switchCmstab('jurusan')">

            Data Jurusan

        </button>

        <button
            class="tab-switch active px-4 py-2.5 text-xs font-semibold rounded-t-xl transition text-indigo-600 border-b-2 border-indigo-600 bg-white"
            data-tab="produk"
            onclick="switchCmstab('produk')">

            Katalog Produk

        </button>

    </div>


    {{-- ISI CMS PRODUK --}}

    <div id="tab-produk" class="cms-tab-content block">

        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">

            {{-- SEARCH CMS --}}

            <div class="relative mb-5 max-w-xs">

                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                    🔍
                </span>

                <input
                    type="text"
                    id="search-produk"
                    placeholder="Cari produk..."
                    class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">

            </div>


            {{-- TABEL CMS --}}

            <div class="overflow-x-auto">

                <table id="table-produk" class="w-full text-left text-xs">

                    <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[10px] tracking-wider">

                        <tr>

                            <th class="pb-3 px-3">
                                Nama Produk/Jasa
                            </th>

                            <th class="pb-3 px-3">
                                Jurusan
                            </th>

                            <th class="pb-3 px-3">
                                Rate Card
                            </th>

                            <th class="pb-3 px-3">
                                Status
                            </th>

                            <th class="pb-3 px-3 text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                <tbody>

                        @forelse ($tefas as $tefa)

                        <tr class="border-b border-slate-50 hover:bg-slate-50 transition">

                            {{-- PRODUK + GAMBAR --}}

                            <td class="py-4 px-3">

                                <div class="flex items-center gap-3">

                                    {{-- GAMBAR PRODUK --}}

                                    @if ($tefa->gambar)

                                        <img
                                            src="{{ asset('gambar/tefa/' . $tefa->gambar) }}"
                                            alt="{{ $tefa->nama_produk }}"
                                            class="w-12 h-12 rounded-xl object-cover border border-slate-200 flex-shrink-0">

                                    @else

                                        <div
                                            class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 flex-shrink-0">

                                            🖼️

                                        </div>

                                    @endif


                                    {{-- INFORMASI PRODUK --}}

                                    <div class="min-w-0">

                                        <div class="font-semibold text-slate-800">

                                            {{ $tefa->nama_produk }}

                                        </div>

                                        <div class="text-[11px] text-slate-400 mt-1">

                                            {{ Str::limit($tefa->deskripsi, 50) }}

                                        </div>

                                    </div>

                                </div>

                            </td>


                            {{-- JURUSAN --}}

                            <td class="py-4 px-3">

                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 font-semibold text-[10px]">

                                    {{ $tefa->jurusan }}

                                </span>

                            </td>


                            {{-- HARGA --}}

                            <td class="py-4 px-3 font-semibold text-slate-700">

                                Rp {{ number_format($tefa->harga, 0, ',', '.') }}

                            </td>


                            {{-- STATUS --}}

                            <td class="py-4 px-3">

                                @if ($tefa->status_aktif)

                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">

                                        Aktif

                                    </span>

                                @else

                                    <span
                                        class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-semibold text-[10px]">

                                        Tidak Aktif

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}

                            <td class="py-4 px-3">

                                <div class="flex items-center justify-end gap-2">


                                    {{-- EDIT --}}

                                    <button
                                        type="button"
                                        onclick="editProduk(
                                            {{ $tefa->id_produk }},
                                            @js($tefa->jurusan),
                                            @js($tefa->nama_produk),
                                            @js($tefa->deskripsi),
                                            {{ $tefa->harga }},
                                            {{ $tefa->status_aktif ? 1 : 0 }},
                                            @js($tefa->gambar)
                                        )"
                                        class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">

                                        Edit

                                    </button>


                                    {{-- HAPUS --}}

                                    <form
                                        action="{{ route('admin.tefa.produk.destroy', $tefa->id_produk) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus produk ini?');">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-[10px] font-semibold transition">

                                            Hapus

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="5" class="py-16 text-center">

                                <div class="text-4xl mb-3">
                                    📦
                                </div>

                                <h3 class="text-sm font-semibold text-slate-800">
                                    Belum ada produk
                                </h3>

                                <p class="text-xs text-slate-400 mt-1">
                                    Tambahkan produk atau layanan pertama.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- ========================================
     TAB DATA JURUSAN
     ======================================== --}}

<div id="tab-jurusan" class="cms-tab-content hidden">

    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6">

        {{-- SEARCH JURUSAN --}}

        <div class="relative mb-5 max-w-xs">

            <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                🔍
            </span>

            <input
                type="text"
                id="search-jurusan"
                placeholder="Cari jurusan..."
                class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">

        </div>


        {{-- TABLE JURUSAN --}}

        <div class="overflow-x-auto">

            <table id="table-jurusan" class="w-full text-left text-xs">

                <thead class="border-b border-slate-100 text-slate-400 font-semibold uppercase text-[10px] tracking-wider">

                    <tr>

                        <th class="pb-3 px-3">
                            Kode
                        </th>

                        <th class="pb-3 px-3">
                            Nama Jurusan
                        </th>

                        <th class="pb-3 px-3">
                            Ketua/Kajur
                        </th>

                        <th class="pb-3 px-3">
                            Worker
                        </th>

                        <th class="pb-3 px-3">
                            Produk
                        </th>

                        <th class="pb-3 px-3">
                            Status
                        </th>

                        <th class="pb-3 px-3 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

    @forelse ($jurusans as $jurusan)

        <tr class="hover:bg-slate-50 transition">

            {{-- KODE --}}

            <td class="py-3.5 px-3">

                <span class="font-bold text-indigo-600">
                    {{ $jurusan->kode }}
                </span>

            </td>


            {{-- NAMA JURUSAN --}}

            <td class="py-3.5 px-3 font-semibold text-slate-800">

                {{ $jurusan->nama_jurusan }}

            </td>


            {{-- KETUA / KAJUR --}}

            <td class="py-3.5 px-3 text-slate-600">

                {{ $jurusan->ketua_kajur }}

            </td>


            {{-- WORKER --}}

            <td class="py-3.5 px-3 text-slate-600">

                {{ $jurusan->worker }}

            </td>


            {{-- PRODUK --}}

            <td class="py-3.5 px-3 text-slate-600">

                {{ $jurusan->produk }}

            </td>


            {{-- STATUS --}}

            <td class="py-3.5 px-3">

                @if ($jurusan->status)

                    <span
                        class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">

                        Aktif

                    </span>

                @else

                    <span
                        class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-semibold text-[10px]">

                        Nonaktif

                    </span>

                @endif

            </td>


            {{-- AKSI --}}

            <td class="py-3.5 px-3">

                <div class="flex items-center justify-end">

                    <button
                        type="button"
                        class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">

                        Edit

                    </button>


                    <button
                        type="button"
                        class="px-3 py-1.5 rounded-lg bg-red-50 hover:bg-red-100 text-red-600 text-[10px] font-semibold transition">

                        Hapus

                    </button>

                </div>

            </td>

        </tr>

    @empty

        <tr>

            <td
                colspan="7"
                class="py-12 text-center text-slate-400">

                Belum ada data jurusan.

            </td>

        </tr>

    @endforelse

</tbody>

            </table>

        </div>

    </div>

</div>


    {{-- ========================================
     MODAL TAMBAH PRODUK
     ALUR LARAVEL TETAP
     ======================================== --}}

<div class="modal fade"
     id="modalTambahProduk"
     tabindex="-1"
     aria-labelledby="modalTambahProdukLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modalTambahProdukLabel">
                    Tambah Produk / Layanan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            <form
                action="{{ route('admin.tefa.produk.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf


                <div class="modal-body">

                    <div class="row g-3">


                        {{-- JURUSAN --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <select
                                name="jurusan"
                                class="form-select"
                                required>

                                <option value="">
                                    Pilih Jurusan
                                </option>

                                <option value="RPL">
                                    RPL
                                </option>

                                <option value="TKJ">
                                    TKJ
                                </option>

                                <option value="GIM">
                                    GIM
                                </option>

                                <option value="DKV">
                                    DKV
                                </option>

                                <option value="PSPT">
                                    PSPT
                                </option>

                                <option value="ANIMASI">
                                    ANIMASI
                                </option>

                            </select>

                        </div>


                        {{-- NAMA PRODUK --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Produk / Layanan
                            </label>

                            <input
                                type="text"
                                name="nama_produk"
                                class="form-control"
                                placeholder="Masukkan nama produk"
                                required>

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Harga
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    name="harga"
                                    class="form-control"
                                    placeholder="0"
                                    min="0"
                                    required>

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status_aktif"
                                class="form-select"
                                required>

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-12">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                                placeholder="Masukkan deskripsi produk atau layanan"
                                required></textarea>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-12">

                            <label class="form-label">
                                Gambar Produk
                            </label>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </small>

                        </div>


                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-2"></i>

                        Simpan Produk

                    </button>

                </div>


            </form>

        </div>

    </div>

</div> {{-- penutup modalTambahProduk --}}


{{-- ========================================
     MODAL TAMBAH JURUSAN
     ======================================== --}}

<div class="modal fade"
     id="modalTambahJurusan"
     tabindex="-1"
     aria-labelledby="modalTambahJurusanLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modalTambahJurusanLabel">
                    Tambah Jurusan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            <form action="{{ route('admin.tefa.jurusan.store') }}" method="POST">

                @csrf

                @csrf

                <div class="modal-body">

                    <div class="row g-3">

                        {{-- KODE --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Kode Jurusan
                            </label>

                            <input
                                type="text"
                                name="kode"
                                class="form-control"
                                placeholder="Contoh: RPL"
                                required>

                        </div>


                        {{-- NAMA JURUSAN --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Jurusan
                            </label>

                            <input
                                type="text"
                                name="nama_jurusan"
                                class="form-control"
                                placeholder="Contoh: Rekayasa Perangkat Lunak"
                                required>

                        </div>


                        {{-- KETUA / KAJUR --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Ketua / Kajur
                            </label>

                            <input
                                type="text"
                                name="ketua_kajur"
                                class="form-control"
                                placeholder="Nama Ketua / Kajur"
                                required>

                        </div>


                        {{-- WORKER --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Worker
                            </label>

                            <input
                                type="number"
                                name="worker"
                                class="form-control"
                                placeholder="Jumlah worker"
                                min="0"
                                required>

                        </div>


                        {{-- PRODUK --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Produk
                            </label>

                            <input
                                type="number"
                                name="produk"
                                class="form-control"
                                placeholder="Jumlah produk"
                                min="0"
                                required>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                name="status"
                                class="form-select"
                                required>

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Nonaktif
                                </option>

                            </select>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>

                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-2"></i>

                        Simpan Jurusan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

{{-- ========================================
     MODAL EDIT PRODUK
     ======================================== --}}

<div class="modal fade"
     id="modalEditProduk"
     tabindex="-1"
     aria-labelledby="modalEditProdukLabel"
     aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title" id="modalEditProdukLabel">
                    Edit Produk / Layanan
                </h5>

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                </button>

            </div>


            <form
                id="formEditProduk"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')


                <div class="modal-body">

                    <div class="row g-3">

                        {{-- JURUSAN --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Jurusan
                            </label>

                            <select
                                id="edit_jurusan"
                                name="jurusan"
                                class="form-select"
                                required>

                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="GIM">GIM</option>
                                <option value="DKV">DKV</option>
                                <option value="PSPT">PSPT</option>
                                <option value="ANIMASI">ANIMASI</option>

                            </select>

                        </div>


                        {{-- NAMA PRODUK --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Nama Produk / Layanan
                            </label>

                            <input
                                type="text"
                                id="edit_nama_produk"
                                name="nama_produk"
                                class="form-control"
                                required>

                        </div>


                        {{-- HARGA --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Harga
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    id="edit_harga"
                                    name="harga"
                                    class="form-control"
                                    min="0"
                                    required>

                            </div>

                        </div>


                        {{-- STATUS --}}

                        <div class="col-md-6">

                            <label class="form-label">
                                Status
                            </label>

                            <select
                                id="edit_status_aktif"
                                name="status_aktif"
                                class="form-select"
                                required>

                                <option value="1">
                                    Aktif
                                </option>

                                <option value="0">
                                    Tidak Aktif
                                </option>

                            </select>

                        </div>


                        {{-- DESKRIPSI --}}

                        <div class="col-12">

                            <label class="form-label">
                                Deskripsi
                            </label>

                            <textarea
                                id="edit_deskripsi"
                                name="deskripsi"
                                class="form-control"
                                rows="4"
                                required></textarea>

                        </div>


                        {{-- GAMBAR --}}

                        <div class="col-12">

                            <label class="form-label">
                                Gambar Produk
                            </label>

                            <div id="edit_gambar_lama"
                                 class="mb-2">
                            </div>

                            <input
                                type="file"
                                name="gambar"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti gambar.
                            </small>

                        </div>

                    </div>

                </div>


                <div class="modal-footer">

                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">

                        Batal

                    </button>


                    <button
                        type="submit"
                        class="btn btn-primary">

                        <i class="bi bi-save me-2"></i>

                        Simpan Perubahan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script>
    function switchCmstab(tab) {

        const tabJurusan = document.getElementById('tab-jurusan');
        const tabProduk = document.getElementById('tab-produk');

        const buttons = document.querySelectorAll('.tab-switch');

        const btnTambah = document.getElementById('btn-tambah');


        // Sembunyikan semua tab

        tabJurusan.classList.add('hidden');
        tabProduk.classList.add('hidden');


        // Reset style tombol tab

        buttons.forEach(button => {

            button.classList.remove(
                'active',
                'text-indigo-600',
                'border-b-2',
                'border-indigo-600',
                'bg-white'
            );

            button.classList.add('text-slate-500');

        });


        // ========================================
        // TAB DATA JURUSAN
        // ========================================

        if (tab === 'jurusan') {

            tabJurusan.classList.remove('hidden');


            buttons.forEach(button => {

                if (button.dataset.tab === 'jurusan') {

                    button.classList.remove('text-slate-500');

                    button.classList.add(
                        'active',
                        'text-indigo-600',
                        'border-b-2',
                        'border-indigo-600',
                        'bg-white'
                    );

                }

            });


            // Ubah tombol atas

            btnTambah.innerHTML = '+ Tambah Jurusan';

            btnTambah.onclick = function () {

                tambahJurusan();

            };

        }


        // ========================================
        // TAB KATALOG PRODUK
        // ========================================

        if (tab === 'produk') {

            tabProduk.classList.remove('hidden');


            buttons.forEach(button => {

                if (button.dataset.tab === 'produk') {

                    button.classList.remove('text-slate-500');

                    button.classList.add(
                        'active',
                        'text-indigo-600',
                        'border-b-2',
                        'border-indigo-600',
                        'bg-white'
                    );

                }

            });


            // Ubah tombol atas

            btnTambah.innerHTML = '+ Tambah Produk';

            btnTambah.onclick = function () {

                tambahProduk();

            };

        }

    }


    function cetakKatalogPDF() {
        window.open(
            "{{ route('admin.tefa.katalog.pdf') }}",
            "_blank"
        );
    }


    // ========================================
    // MODAL TAMBAH PRODUK
    // ========================================

    function tambahProduk() {

        const modalElement =
            document.getElementById('modalTambahProduk');

        const modal =
            new bootstrap.Modal(modalElement);

        modal.show();

    }

    function tambahJurusan() {

        const modalElement =
            document.getElementById('modalTambahJurusan');

        const modal =
            new bootstrap.Modal(modalElement);

        modal.show();
    }

    // ========================================
    // MODAL EDIT PRODUK
    // ========================================

    function editProduk(id, jurusan, namaProduk, deskripsi, harga, statusAktif, gambar) {

        const modalElement = document.getElementById('modalEditProduk');

        const modal = new bootstrap.Modal(modalElement);


        // Isi form

        document.getElementById('edit_jurusan').value = jurusan;

        document.getElementById('edit_nama_produk').value = namaProduk;

        document.getElementById('edit_deskripsi').value = deskripsi;

        document.getElementById('edit_harga').value = harga;

        document.getElementById('edit_status_aktif').value = statusAktif;


        // Set action form

        document.getElementById('formEditProduk').action =
            '/admin/tefa/produk/' + id;


        // Gambar lama

        const gambarLama =
            document.getElementById('edit_gambar_lama');

        if (gambar) {

            gambarLama.innerHTML = `
                <img
                    src="/gambar/tefa/${gambar}"
                    alt="Gambar Produk"
                    style="width: 100px; height: 70px; object-fit: cover;"
                    class="rounded border">
            `;

        } else {

            gambarLama.innerHTML = '';

        }


        modal.show();
    }


    // ========================================
    // SEARCH PRODUK
    // ========================================

    document.getElementById('search-produk').addEventListener('input', function () {

        const keyword = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#table-produk tbody tr'
        );

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display =
                text.includes(keyword) ? '' : 'none';

        });

    });


    // ========================================
    // SEARCH JURUSAN
    // ========================================

    document.getElementById('search-jurusan').addEventListener('input', function () {

        const keyword = this.value.toLowerCase();

        const rows = document.querySelectorAll(
            '#table-jurusan tbody tr'
        );

        rows.forEach(function (row) {

            const text = row.textContent.toLowerCase();

            row.style.display =
                text.includes(keyword) ? '' : 'none';

        });

    });


    // ========================================
    // TAB DEFAULT
    // ========================================

    document.addEventListener('DOMContentLoaded', function () {

        switchCmstab('produk');

    });
</script> 


@endsection