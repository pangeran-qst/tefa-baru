@extends('admin.tefa.layouts.app')

@section('title', 'Edit Produk')

@section('content')

<div class="container-fluid">

    <div class="mb-4">
        <h2 class="fw-bold">Edit Produk / Layanan</h2>
        <p class="text-muted">
            Perbarui informasi produk atau layanan TEFA.
        </p>
    </div>

    <div class="card shadow-sm border-0">

        <div class="card-body">

            <form action="{{ route('admin.tefa.produk.update', $tefa->id_produk) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- Jurusan -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Jurusan
                    </label>

                    <select name="jurusan" class="form-select" required>

                        @foreach(['RPL', 'TKJ', 'GIM', 'DKV', 'PSPT', 'ANIMASI'] as $jurusan)

                            <option value="{{ $jurusan }}"
                                {{ $tefa->jurusan == $jurusan ? 'selected' : '' }}>

                                {{ $jurusan }}

                            </option>

                        @endforeach

                    </select>

                </div>


                <!-- Nama Produk -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Nama Produk / Layanan
                    </label>

                    <input type="text"
                           name="nama_produk"
                           class="form-control"
                           value="{{ $tefa->nama_produk }}"
                           required>

                </div>


                <!-- Deskripsi -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Deskripsi
                    </label>

                    <textarea name="deskripsi"
                              class="form-control"
                              rows="4"
                              required>{{ $tefa->deskripsi }}</textarea>

                </div>


                <!-- Harga -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Harga
                    </label>

                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ $tefa->harga }}"
                           required>

                </div>


                <!-- Gambar -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Gambar
                    </label>

                    @if($tefa->gambar)

                        <div class="mb-3">

                            <img src="{{ asset('gambar/tefa/' . $tefa->gambar) }}"
                                 alt="{{ $tefa->nama_produk }}"
                                 style="width: 120px; height: 80px; object-fit: cover;"
                                 class="rounded border">

                        </div>

                    @endif

                    <input type="file"
                           name="gambar"
                           class="form-control"
                           accept=".jpg,.jpeg,.png,.webp">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar.
                    </small>

                </div>


                <!-- Status -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Status
                    </label>

                    <select name="status_aktif"
                            class="form-select"
                            required>

                        <option value="1"
                            {{ $tefa->status_aktif ? 'selected' : '' }}>
                            Aktif
                        </option>

                        <option value="0"
                            {{ !$tefa->status_aktif ? 'selected' : '' }}>
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                <div class="d-flex gap-2">

                    <a href="{{ route('admin.tefa.produk') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                    <button type="submit"
                            class="btn btn-primary">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection