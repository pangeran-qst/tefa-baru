
@extends('admin.tefa.layouts.app')

@section('title', 'CMS Katalog & Jurusan')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .tefa-analitik {
        font-family: 'Inter', sans-serif;
        color: #334155;
    }

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

    .tefa-table {
        width: 100%;
        text-align: left;
        font-size: 12px;
        border-collapse: collapse;
    }

    .tefa-table thead {
        color: #94a3b8;
        font-size: 10px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid #f1f5f9;
    }

    .tefa-table tbody tr {
        border-bottom: 1px solid #f8fafc;
        transition: background 0.2s;
    }

    .tefa-table tbody tr:hover {
        background: #f8fafc;
    }

    .tefa-table th {
        padding: 12px;
        white-space: nowrap;
    }

    .tefa-table td {
        padding: 14px 12px;
        vertical-align: middle;
    }

    .tefa-search {
        width: 100%;
        padding: 9px 14px 9px 36px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 12px;
        color: #334155;
        outline: none;
        transition: 0.2s;
    }

    .tefa-search:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .tab-switch {
        padding: 10px 16px;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        border-bottom: 2px solid transparent;
        transition: 0.2s;
        white-space: nowrap;
    }

    .tab-switch:hover {
        color: #4f46e5;
    }

    .tab-switch.active {
        color: #5850ec;
        border-bottom: 2px solid #5850ec;
        background: #ffffff;
    }

    @media (max-width: 768px) {
        .tefa-cms-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .tefa-cms-actions {
            width: 100%;
            flex-wrap: wrap;
        }
    }
</style>

<main class="flex-1 p-8 overflow-y-auto">

    <div class="tefa-analitik">

        {{-- HEADER --}}
        <div class="flex items-center justify-between mb-8 tefa-cms-header">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    CMS Katalog & ADMIN
                </h1>

                <p class="text-xs text-slate-500 mt-1">
                    Kelola data master jurusan dan katalog produk/jasa publik
                </p>
            </div>

            <div class="flex items-center gap-2 tefa-cms-actions">

                <button
                    type="button"
                    onclick="cetakKatalogPDF()"
                    class="bg-red-600 hover:bg-red-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2">

                    <i class="bi bi-file-earmark-pdf"></i>
                    Cetak PDF
                </button>

                <button
                    id="btn-tambah"
                    type="button"
                    onclick="tambahProduk()"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-4 py-2.5 rounded-xl shadow-sm transition flex items-center gap-2">

                    + Tambah Produk
                </button>

            </div>

        </div>


        {{-- TAB CMS --}}
        <div class="tefa-content-card mb-6 px-4 pt-2">

            <div class="flex gap-2 overflow-x-auto">

                <button
                    class="tab-switch"
                    data-tab="jurusan"
                    onclick="switchCmstab('jurusan')">
                    Data Jurusan
                </button>

                <button
                    class="tab-switch active"
                    data-tab="produk"
                    onclick="switchCmstab('produk')">
                    Katalog Produk
                </button>

                <button
                    class="tab-switch"
                    data-tab="portofolio"
                    onclick="switchCmstab('portofolio')">
                    Portofolio Produk
                </button>

            </div>

        </div>


        {{-- TAB PRODUK --}}
        <div id="tab-produk" class="cms-tab-content">

            <div class="tefa-content-card p-6 mb-6">

                <h2 class="tefa-card-title">
                    Data Katalog Produk
                </h2>

                <p class="tefa-card-description">
                    Kelola seluruh produk dan layanan dari setiap jurusan
                </p>

                <div class="relative mb-5 max-w-xs">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="search-produk"
                        placeholder="Cari produk..."
                        class="tefa-search">

                </div>

                <div class="overflow-x-auto">

                    <table id="table-produk" class="tefa-table">

                        <thead>
                            <tr>
                                <th>Nama Produk/Jasa</th>
                                <th>Jurusan</th>
                                <th>Rate Card</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($tefas as $tefa)

                                <tr>

                                    <td>
                                        <div class="flex items-center gap-3">

                                            @if ($tefa->gambar)
                                                <img
                                                    src="{{ asset('gambar/tefa/' . $tefa->gambar) }}"
                                                    alt="{{ $tefa->nama_produk }}"
                                                    class="w-12 h-12 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 flex-shrink-0">
                                                    🖼️
                                                </div>
                                            @endif

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

                                    <td>
                                        <span class="inline-flex px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 font-semibold text-[10px]">
                                            {{ $tefa->jurusan }}
                                        </span>
                                    </td>

                                    <td class="font-semibold text-slate-700">
                                        Rp {{ number_format($tefa->harga, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        @if ($tefa->status_aktif)
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-semibold text-[10px]">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-end gap-2">

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

                                        <div class="text-4xl mb-3">📦</div>

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


        {{-- TAB PORTOFOLIO --}}
        <div id="tab-portofolio" class="cms-tab-content hidden">

            <div class="tefa-content-card p-6 mb-6">

                <h2 class="tefa-card-title">
                    Data Portofolio Produk
                </h2>

                <p class="tefa-card-description">
                    Kelola hasil karya dan proyek dari setiap jurusan
                </p>

                <div class="relative mb-5 max-w-xs">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="search-portofolio"
                        placeholder="Cari portofolio..."
                        class="tefa-search">

                </div>

                <div class="overflow-x-auto">

                    <table id="table-portofolio" class="tefa-table">

                        <thead>
                            <tr>
                                <th>Judul Karya</th>
                                <th>Jurusan</th>
                                <th>Produk Terkait</th>
                                <th>Klien</th>
                                <th>Tahun</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($portofolios as $portofolio)

                                <tr>

                                    <td>
                                        <div class="flex items-center gap-3">

                                            @if ($portofolio->gambar)
                                                <img
                                                    src="{{ asset('gambar/portofolio/' . $portofolio->gambar) }}"
                                                    alt="{{ $portofolio->judul_karya }}"
                                                    class="w-12 h-12 rounded-xl object-cover border border-slate-200 flex-shrink-0">
                                            @else
                                                <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 flex-shrink-0">
                                                    🖼️
                                                </div>
                                            @endif

                                            <div class="min-w-0">
                                                <div class="font-semibold text-slate-800">
                                                    {{ $portofolio->judul_karya }}
                                                </div>

                                                <div class="text-[11px] text-slate-400 mt-1">
                                                    {{ Str::limit($portofolio->deskripsi, 50) }}
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <span class="inline-flex px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-600 font-semibold text-[10px]">
                                            {{ $portofolio->jurusan }}
                                        </span>
                                    </td>

                                    <td class="font-medium text-slate-700">
                                        {{ $portofolio->tefa->nama_produk ?? '-' }}
                                    </td>

                                    <td class="text-slate-600">
                                        {{ $portofolio->klien ?? '-' }}
                                    </td>

                                    <td class="text-slate-600">
                                        {{ $portofolio->tahun ?? '-' }}
                                    </td>

                                    <td>
                                        @if ($portofolio->status_aktif)
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-semibold text-[10px]">
                                                Tidak Aktif
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-end gap-2">

                                            <button
                                                type="button"
                                                onclick="editPortofolio(
                                                    {{ $portofolio->id_portofolio }},
                                                    {{ $portofolio->id_produk }},
                                                    @js($portofolio->jurusan),
                                                    @js($portofolio->judul_karya),
                                                    @js($portofolio->klien),
                                                    @js($portofolio->tahun),
                                                    @js($portofolio->deskripsi),
                                                    @js($portofolio->link_proyek),
                                                    {{ $portofolio->status_aktif ? 1 : 0 }},
                                                    @js($portofolio->gambar),
                                                    @js($portofolio->galeri_screenshot ?? [])
                                                )"
                                                class="px-3 py-1.5 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-600 text-[10px] font-semibold transition">
                                                Edit
                                            </button>

                                            <form
                                                action="{{ route('admin.tefa.portofolio.destroy', $portofolio->id_portofolio) }}"
                                                method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus portofolio ini?');">

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
                                    <td colspan="7" class="py-16 text-center">

                                        <div class="text-4xl mb-3">🖼️</div>

                                        <h3 class="text-sm font-semibold text-slate-800">
                                            Belum ada portofolio
                                        </h3>

                                        <p class="text-xs text-slate-400 mt-1">
                                            Tambahkan portofolio atau karya pertama.
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- TAB JURUSAN --}}
        <div id="tab-jurusan" class="cms-tab-content hidden">

            <div class="tefa-content-card p-6 mb-6">

                <h2 class="tefa-card-title">
                    Data Master Jurusan
                </h2>

                <p class="tefa-card-description">
                    Kelola informasi jurusan, ketua, jumlah worker, dan produk
                </p>

                <div class="relative mb-5 max-w-xs">

                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400 text-xs">
                        🔍
                    </span>

                    <input
                        type="text"
                        id="search-jurusan"
                        placeholder="Cari jurusan..."
                        class="tefa-search">

                </div>

                <div class="overflow-x-auto">

                    <table id="table-jurusan" class="tefa-table">

                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Jurusan</th>
                                <th>Ketua/Kajur</th>
                                <th>Worker</th>
                                <th>Produk</th>
                                <th>Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($jurusans as $jurusan)

                                <tr>

                                    <td>
                                        <span class="font-bold text-indigo-600">
                                            {{ $jurusan->kode }}
                                        </span>
                                    </td>

                                    <td class="font-semibold text-slate-800">
                                        {{ $jurusan->nama_jurusan }}
                                    </td>

                                    <td class="text-slate-600">
                                        {{ $jurusan->ketua_kajur }}
                                    </td>

                                    <td class="text-slate-600">
                                        {{ $jurusan->worker }}
                                    </td>

                                    <td class="text-slate-600">
                                        {{ $jurusan->produk }}
                                    </td>

                                    <td>
                                        @if ($jurusan->status)
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 font-semibold text-[10px]">
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex px-2.5 py-1 rounded-lg bg-slate-100 text-slate-500 font-semibold text-[10px]">
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="flex items-center justify-end gap-2">

                                            <button
                                                type="button"
                                                onclick="editJurusan(
                                                    {{ $jurusan->id_jurusan }},
                                                    @js($jurusan->kode),
                                                    @js($jurusan->nama_jurusan),
                                                    @js($jurusan->ketua_kajur),
                                                    {{ $jurusan->worker }},
                                                    {{ $jurusan->produk }},
                                                    {{ $jurusan->status ? 1 : 0 }}
                                                )"
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
                                    <td colspan="7" class="py-12 text-center text-slate-400">
                                        Belum ada data jurusan.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

</main>


{{-- MODAL TAMBAH PRODUK --}}
<div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProdukLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahProdukLabel">
                    Tambah Produk / Layanan
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.tefa.produk.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="GIM">GIM</option>
                                <option value="DKV">DKV</option>
                                <option value="PSPT">PSPT</option>
                                <option value="ANIMASI">ANIMASI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Produk / Layanan</label>
                            <input type="text" name="nama_produk" class="form-control" placeholder="Masukkan nama produk" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control" placeholder="0" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi produk atau layanan" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>
                        Simpan Produk
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL TAMBAH PORTOFOLIO --}}
<div class="modal fade" id="modalTambahPortofolio" tabindex="-1" aria-labelledby="modalTambahPortofolioLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahPortofolioLabel">
                    Tambah Portofolio Karya
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.tefa.portofolio.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan" id="jurusanPortofolio" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="GIM">GIM</option>
                                <option value="DKV">DKV</option>
                                <option value="PSPT">PSPT</option>
                                <option value="ANIMASI">ANIMASI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Produk Terkait</label>
                            <select name="id_produk" id="produkTerkaitPortofolio" class="form-select" required>
                                <option value="">Pilih Produk</option>

                                @foreach ($tefas as $tefa)
                                    <option
                                        value="{{ $tefa->id_produk }}"
                                        data-jurusan="{{ strtoupper(trim($tefa->jurusan)) }}">
                                        {{ $tefa->nama_produk }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Judul Karya</label>
                            <input type="text" name="judul_karya" class="form-control" placeholder="Masukkan judul karya" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Klien</label>
                            <input type="text" name="klien" class="form-control" placeholder="Nama klien (opsional)">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" class="form-control" placeholder="Contoh: 2026" min="2000" max="2100" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi Karya</label>
                            <textarea name="deskripsi" class="form-control" rows="4" placeholder="Masukkan deskripsi karya" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Gambar Utama</label>
                            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp" required>

                            <small class="text-muted">
                                Format JPG, JPEG, PNG, WEBP. Maksimal 2 MB.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Galeri Screenshot</label>
                            <input type="file" name="galeri_screenshot[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>

                            <small class="text-muted">
                                Bisa memilih beberapa gambar sekaligus. Maksimal 2 MB per gambar.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Link Proyek</label>
                            <input type="url" name="link_proyek" class="form-control" placeholder="https://contoh.com">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>
                        Simpan Portofolio
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL EDIT PORTOFOLIO --}}
<div class="modal fade" id="modalEditPortofolio" tabindex="-1" aria-labelledby="modalEditPortofolioLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPortofolioLabel">
                    Edit Portofolio Karya
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEditPortofolio" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Jurusan</label>
                            <select name="jurusan" id="edit_portofolio_jurusan" class="form-select" required>
                                <option value="">Pilih Jurusan</option>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="GIM">GIM</option>
                                <option value="DKV">DKV</option>
                                <option value="PSPT">PSPT</option>
                                <option value="ANIMASI">ANIMASI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Produk Terkait</label>
                            <select name="id_produk" id="edit_portofolio_produk" class="form-select" required>
                                <option value="">Pilih Produk</option>

                                @foreach ($tefas as $tefa)
                                    <option
                                        value="{{ $tefa->id_produk }}"
                                        data-jurusan="{{ strtoupper(trim($tefa->jurusan)) }}">
                                        {{ $tefa->nama_produk }}
                                    </option>
                                @endforeach

                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Judul Karya</label>
                            <input type="text" name="judul_karya" id="edit_portofolio_judul" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Klien</label>
                            <input type="text" name="klien" id="edit_portofolio_klien" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Tahun</label>
                            <input type="number" name="tahun" id="edit_portofolio_tahun" class="form-control" min="2000" max="2100">
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status_aktif" id="edit_portofolio_status" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi Karya</label>
                            <textarea name="deskripsi" id="edit_portofolio_deskripsi" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Gambar Utama</label>
                            <div id="edit_portofolio_gambar_lama" class="mb-2"></div>

                            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti gambar.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Galeri Screenshot</label>
                            <div id="edit_portofolio_galeri_lama" class="flex flex-wrap gap-2 mb-3"></div>

                            <input type="file" name="galeri_screenshot[]" class="form-control" accept=".jpg,.jpeg,.png,.webp" multiple>

                            <small class="text-muted">
                                Jika memilih gambar baru, galeri lama akan diganti.
                            </small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Link Proyek</label>
                            <input type="url" name="link_proyek" id="edit_portofolio_link" class="form-control" placeholder="https://contoh.com">
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL TAMBAH JURUSAN --}}
<div class="modal fade" id="modalTambahJurusan" tabindex="-1" aria-labelledby="modalTambahJurusanLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahJurusanLabel">
                    Tambah Jurusan
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin.tefa.jurusan.store') }}" method="POST">

                @csrf

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Kode Jurusan</label>
                            <input type="text" name="kode" class="form-control" placeholder="Contoh: RPL" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Jurusan</label>
                            <input type="text" name="nama_jurusan" class="form-control" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ketua / Kajur</label>
                            <input type="text" name="ketua_kajur" class="form-control" placeholder="Nama Ketua / Kajur" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Worker</label>
                            <input type="number" name="worker" class="form-control" placeholder="Jumlah worker" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Produk</label>
                            <input type="number" name="produk" class="form-control" placeholder="Jumlah produk" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>
                        Simpan Jurusan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL EDIT JURUSAN --}}
<div class="modal fade" id="modalEditJurusan" tabindex="-1" aria-labelledby="modalEditJurusanLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditJurusanLabel">
                    Edit Jurusan
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEditJurusan" method="POST">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Kode Jurusan</label>
                            <input type="text" id="edit_kode_jurusan" name="kode" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Jurusan</label>
                            <input type="text" id="edit_nama_jurusan" name="nama_jurusan" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Ketua / Kajur</label>
                            <input type="text" id="edit_ketua_kajur" name="ketua_kajur" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Worker</label>
                            <input type="number" id="edit_worker" name="worker" class="form-control" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Produk</label>
                            <input type="number" id="edit_produk_jurusan" name="produk" class="form-control" min="0" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select id="edit_status_jurusan" name="status" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-2"></i>
                        Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


{{-- MODAL EDIT PRODUK --}}
<div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="modalEditProdukLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalEditProdukLabel">
                    Edit Produk / Layanan
                </h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="formEditProduk" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Jurusan</label>
                            <select id="edit_jurusan" name="jurusan" class="form-select" required>
                                <option value="RPL">RPL</option>
                                <option value="TKJ">TKJ</option>
                                <option value="GIM">GIM</option>
                                <option value="DKV">DKV</option>
                                <option value="PSPT">PSPT</option>
                                <option value="ANIMASI">ANIMASI</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Nama Produk / Layanan</label>
                            <input type="text" id="edit_nama_produk" name="nama_produk" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Harga</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="edit_harga" name="harga" class="form-control" min="0" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select id="edit_status_aktif" name="status_aktif" class="form-select" required>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Deskripsi</label>
                            <textarea id="edit_deskripsi" name="deskripsi" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Gambar Produk</label>
                            <div id="edit_gambar_lama" class="mb-2"></div>

                            <input type="file" name="gambar" class="form-control" accept=".jpg,.jpeg,.png,.webp">

                            <small class="text-muted">
                                Kosongkan jika tidak ingin mengganti gambar.
                            </small>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <button type="submit" class="btn btn-primary">
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
        const tabPortofolio = document.getElementById('tab-portofolio');

        const buttons = document.querySelectorAll('.tab-switch');
        const btnTambah = document.getElementById('btn-tambah');

        tabJurusan.classList.add('hidden');
        tabProduk.classList.add('hidden');
        tabPortofolio.classList.add('hidden');

        buttons.forEach(button => {
            button.classList.remove('active');
        });

        if (tab === 'jurusan') {

            tabJurusan.classList.remove('hidden');

            buttons.forEach(button => {
                if (button.dataset.tab === 'jurusan') {
                    button.classList.add('active');
                }
            });

            btnTambah.innerHTML = '+ Tambah Jurusan';
            btnTambah.onclick = function () {
                tambahJurusan();
            };

        }

        if (tab === 'produk') {

            tabProduk.classList.remove('hidden');

            buttons.forEach(button => {
                if (button.dataset.tab === 'produk') {
                    button.classList.add('active');
                }
            });

            btnTambah.innerHTML = '+ Tambah Produk';
            btnTambah.onclick = function () {
                tambahProduk();
            };

        }

        if (tab === 'portofolio') {

            tabPortofolio.classList.remove('hidden');

            buttons.forEach(button => {
                if (button.dataset.tab === 'portofolio') {
                    button.classList.add('active');
                }
            });

            btnTambah.innerHTML = '+ Tambah Portofolio';
            btnTambah.onclick = function () {
                tambahPortofolio();
            };

        }

    }


    function cetakKatalogPDF() {
        window.open(
            "{{ route('admin.tefa.katalog.pdf') }}",
            "_blank"
        );
    }


    function tambahProduk() {

        const modalElement = document.getElementById('modalTambahProduk');
        const modal = new bootstrap.Modal(modalElement);

        modal.show();

    }


    function tambahPortofolio() {

        const modalElement = document.getElementById('modalTambahPortofolio');
        const modal = new bootstrap.Modal(modalElement);

        modal.show();

    }


    function tambahJurusan() {

        const modalElement = document.getElementById('modalTambahJurusan');
        const modal = new bootstrap.Modal(modalElement);

        modal.show();

    }


    function editPortofolio(
        id,
        idProduk,
        jurusan,
        judul,
        klien,
        tahun,
        deskripsi,
        linkProyek,
        statusAktif,
        gambar,
        galeri
    ) {

        const modalElement = document.getElementById('modalEditPortofolio');
        const modal = new bootstrap.Modal(modalElement);

        document.getElementById('edit_portofolio_jurusan').value = jurusan;
        document.getElementById('edit_portofolio_produk').value = idProduk;
        document.getElementById('edit_portofolio_judul').value = judul ?? '';
        document.getElementById('edit_portofolio_klien').value = klien ?? '';
        document.getElementById('edit_portofolio_tahun').value = tahun ?? '';
        document.getElementById('edit_portofolio_deskripsi').value = deskripsi ?? '';
        document.getElementById('edit_portofolio_link').value = linkProyek ?? '';
        document.getElementById('edit_portofolio_status').value = statusAktif;

        document.getElementById('formEditPortofolio').action =
            '/admin/tefa/portofolio/' + id;

        const gambarLama = document.getElementById('edit_portofolio_gambar_lama');

        if (gambar) {

            gambarLama.innerHTML = `
                <img
                    src="/gambar/portofolio/${gambar}"
                    alt="Gambar Portofolio"
                    style="width: 120px; height: 80px; object-fit: cover;"
                    class="rounded border">
            `;

        } else {

            gambarLama.innerHTML = '';

        }

        const galeriLama = document.getElementById('edit_portofolio_galeri_lama');

        galeriLama.innerHTML = '';

        if (Array.isArray(galeri) && galeri.length > 0) {

            galeri.forEach(function (file) {

                galeriLama.innerHTML += `
                    <img
                        src="/gambar/portofolio/${file}"
                        alt="Screenshot"
                        style="width: 80px; height: 60px; object-fit: cover;"
                        class="rounded border">
                `;

            });

        } else {

            galeriLama.innerHTML = `
                <span class="text-muted text-sm">
                    Tidak ada galeri screenshot.
                </span>
            `;

        }

        modal.show();

    }


    function editJurusan(id, kode, nama, ketua, worker, produk, status) {

        const modalElement = document.getElementById('modalEditJurusan');
        const modal = new bootstrap.Modal(modalElement);

        document.getElementById('edit_kode_jurusan').value = kode;
        document.getElementById('edit_nama_jurusan').value = nama;
        document.getElementById('edit_ketua_kajur').value = ketua;
        document.getElementById('edit_worker').value = worker;
        document.getElementById('edit_produk_jurusan').value = produk;
        document.getElementById('edit_status_jurusan').value = status;

        document.getElementById('formEditJurusan').action =
            '/admin/tefa/jurusan/' + id;

        modal.show();

    }


    function editProduk(id, jurusan, namaProduk, deskripsi, harga, statusAktif, gambar) {

        const modalElement = document.getElementById('modalEditProduk');
        const modal = new bootstrap.Modal(modalElement);

        document.getElementById('edit_jurusan').value = jurusan;
        document.getElementById('edit_nama_produk').value = namaProduk;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_harga').value = harga;
        document.getElementById('edit_status_aktif').value = statusAktif;

        document.getElementById('formEditProduk').action =
            '/admin/tefa/produk/' + id;

        const gambarLama = document.getElementById('edit_gambar_lama');

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


    function aktifkanPencarian(inputId, tableId) {

        const input = document.getElementById(inputId);

        if (!input) return;

        input.addEventListener('input', function () {

            const keyword = this.value.toLowerCase();

            const rows = document.querySelectorAll(
                `#${tableId} tbody tr`
            );

            rows.forEach(function (row) {

                const text = row.textContent.toLowerCase();

                row.style.display =
                    text.includes(keyword) ? '' : 'none';

            });

        });

    }


    document.addEventListener('DOMContentLoaded', function () {

        aktifkanPencarian('search-produk', 'table-produk');
        aktifkanPencarian('search-jurusan', 'table-jurusan');
        aktifkanPencarian('search-portofolio', 'table-portofolio');

        const params = new URLSearchParams(window.location.search);
        const tab = params.get('tab');

        switchCmstab(
            tab === 'portofolio'
                ? 'portofolio'
                : tab === 'jurusan'
                    ? 'jurusan'
                    : 'produk'
        );

    });


    document.addEventListener('DOMContentLoaded', function () {

        const jurusanSelect = document.getElementById('jurusanPortofolio');
        const produkSelect = document.getElementById('produkTerkaitPortofolio');

        if (!jurusanSelect || !produkSelect) return;

        const semuaProduk = Array.from(produkSelect.options)
            .filter(option => option.value !== '')
            .map(option => ({
                value: option.value,
                text: option.textContent.trim(),
                jurusan: option.dataset.jurusan
            }));

        function filterProduk() {

            const jurusanDipilih = jurusanSelect.value.trim().toUpperCase();

            produkSelect.innerHTML = '<option value="">Pilih Produk</option>';

            semuaProduk
                .filter(produk => produk.jurusan === jurusanDipilih)
                .forEach(produk => {

                    const option = document.createElement('option');

                    option.value = produk.value;
                    option.textContent = produk.text;

                    produkSelect.appendChild(option);

                });

            produkSelect.value = '';

        }

        jurusanSelect.addEventListener('change', filterProduk);

        filterProduk();

    });

</script>

@endsection
