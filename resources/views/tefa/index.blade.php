<h1>Daftar Produk / Layanan TEFA</h1>

@foreach ($tefas as $tefa)
    <div>
        <h3>{{ $tefa->nama_produk }}</h3>

        <p>Jurusan: {{ $tefa->jurusan }}</p>

        <p>{{ $tefa->deskripsi }}</p>

        <p>Harga: Rp {{ number_format($tefa->harga, 0, ',', '.') }}</p>
    </div>

    <hr>
@endforeach