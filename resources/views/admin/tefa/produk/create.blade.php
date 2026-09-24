<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk | Admin TEFA</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">
</head>

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">

            <a class="navbar-brand fw-bold" href="{{ route('admin.tefa.dashboard') }}">
                TEFA
            </a>

            <span class="text-white">
                Admin TEFA
            </span>

        </div>
    </nav>


    {{-- Content --}}
    <div class="container py-5">

        <div class="row justify-content-center">

            <div class="col-lg-8">

                {{-- Header --}}
                <div class="mb-4">

                    <a href="{{ route('admin.tefa.produk') }}"
                        class="text-decoration-none">
                        ← Kembali ke Produk
                    </a>

                    <h2 class="fw-bold mt-3 mb-1">
                        Tambah Produk / Layanan
                    </h2>

                    <p class="text-muted">
                        Tambahkan produk atau layanan baru ke dalam katalog TEFA.
                    </p>

                </div>


                {{-- Error --}}
                @if ($errors->any())

                    <div class="alert alert-danger">

                        <strong>Terjadi kesalahan:</strong>

                        <ul class="mb-0 mt-2">

                            @foreach ($errors->all() as $error)

                                <li>{{ $error }}</li>

                            @endforeach

                        </ul>

                    </div>

                @endif


                {{-- Form Card --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4 p-md-5">

                        <form action="{{ route('admin.tefa.produk.store') }}"
                            method="POST"
                            enctype="multipart/form-data">

                            @csrf


                            {{-- Jurusan --}}
                            <div class="mb-4">

                                <label for="jurusan"
                                    class="form-label fw-semibold">

                                    Jurusan

                                </label>

                                <select
                                    name="jurusan"
                                    id="jurusan"
                                    class="form-select @error('jurusan') is-invalid @enderror"
                                    required>

                                    <option value="">
                                        -- Pilih Jurusan --
                                    </option>

                                    @foreach ([
                                        'RPL',
                                        'TKJ',
                                        'GIM',
                                        'DKV',
                                        'PSPT',
                                        'ANIMASI'
                                    ] as $jurusan)

                                        <option
                                            value="{{ $jurusan }}"
                                            {{ old('jurusan') == $jurusan ? 'selected' : '' }}>

                                            {{ $jurusan }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('jurusan')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Nama Produk --}}
                            <div class="mb-4">

                                <label for="nama_produk"
                                    class="form-label fw-semibold">

                                    Nama Produk / Layanan

                                </label>

                                <input
                                    type="text"
                                    name="nama_produk"
                                    id="nama_produk"
                                    value="{{ old('nama_produk') }}"
                                    class="form-control @error('nama_produk') is-invalid @enderror"
                                    placeholder="Contoh: Pembuatan Website">

                                @error('nama_produk')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Deskripsi --}}
                            <div class="mb-4">

                                <label for="deskripsi"
                                    class="form-label fw-semibold">

                                    Deskripsi

                                </label>

                                <textarea
                                    name="deskripsi"
                                    id="deskripsi"
                                    rows="5"
                                    class="form-control @error('deskripsi') is-invalid @enderror"
                                    placeholder="Jelaskan produk atau layanan yang ditawarkan...">{{ old('deskripsi') }}</textarea>

                                @error('deskripsi')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Harga --}}
                            <div class="mb-4">

                                <label for="harga"
                                    class="form-label fw-semibold">

                                    Harga

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input
                                        type="number"
                                        name="harga"
                                        id="harga"
                                        value="{{ old('harga') }}"
                                        class="form-control @error('harga') is-invalid @enderror"
                                        placeholder="Contoh: 2000000"
                                        min="0">

                                </div>

                                @error('harga')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Gambar --}}
                            <div class="mb-4">

                                <label for="gambar"
                                    class="form-label fw-semibold">

                                    Gambar Produk

                                </label>

                                <input
                                    type="file"
                                    name="gambar"
                                    id="gambar"
                                    class="form-control @error('gambar') is-invalid @enderror"
                                    accept=".jpg,.jpeg,.png,.webp">

                                <div class="form-text">
                                    Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </div>

                                @error('gambar')

                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Status --}}
                            <div class="mb-4">

                                <label for="status_aktif"
                                    class="form-label fw-semibold">

                                    Status Produk

                                </label>

                                <select
                                    name="status_aktif"
                                    id="status_aktif"
                                    class="form-select">

                                    <option value="1"
                                        {{ old('status_aktif', '1') == '1' ? 'selected' : '' }}>

                                        Aktif

                                    </option>

                                    <option value="0"
                                        {{ old('status_aktif') == '0' ? 'selected' : '' }}>

                                        Tidak Aktif

                                    </option>

                                </select>

                                <div class="form-text">
                                    Produk aktif akan dapat ditampilkan kepada client.
                                </div>

                            </div>


                            {{-- Buttons --}}
                            <div class="d-flex justify-content-end gap-2 pt-3 border-top">

                                <a href="{{ route('admin.tefa.produk') }}"
                                    class="btn btn-light border">

                                    Batal

                                </a>

                                <button type="submit"
                                    class="btn btn-primary px-4">

                                    Simpan Produk

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>

</html>