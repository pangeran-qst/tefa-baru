<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Laporan Transaksi TEFA</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .periode {
            text-align: center;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #4f46e5;
            color: white;
            padding: 7px;
            border: 1px solid #ddd;
        }

        td {
            padding: 7px;
            border: 1px solid #ddd;
        }

        .text-right {
            text-align: right;
        }

        .total {
            margin-top: 15px;
            width: 100%;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }
    </style>
</head>

<body>

    <h1>LAPORAN TRANSAKSI TEFA</h1>

    <div class="periode">
        @if($tanggalDari || $tanggalSampai)
            Periode:
            {{ $tanggalDari ? date('d/m/Y', strtotime($tanggalDari)) : 'Awal' }}
            -
            {{ $tanggalSampai ? date('d/m/Y', strtotime($tanggalSampai)) : 'Sekarang' }}
        @else
            Semua Transaksi
        @endif
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Invoice</th>
                <th>Klien</th>
                <th>Layanan</th>
                <th>Jurusan</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>Dibayar</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
            @forelse($transaksi as $pesanan)

                <tr>
                    <td>{{ $loop->iteration }}</td>

                    <td>
                        INV-{{ date('Y', strtotime($pesanan->tanggal_pesan)) }}-
                        {{ str_pad($pesanan->id_pesanan, 4, '0', STR_PAD_LEFT) }}
                    </td>

                    <td>
                        {{ $pesanan->nama_pemesan ?? '-' }}
                    </td>

                    <td>
                        {{ $pesanan->tefa->nama_produk ?? '-' }}
                    </td>

                    <td>
                        {{ $pesanan->tefa->jurusan ?? '-' }}
                    </td>

                    <td>
                        {{ $pesanan->tanggal_pesan
                            ? $pesanan->tanggal_pesan->format('d/m/Y')
                            : '-' }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($pesanan->harga_final ?? 0, 0, ',', '.') }}
                    </td>

                    <td class="text-right">
                        Rp {{ number_format($pesanan->nominal_dibayar ?? 0, 0, ',', '.') }}
                    </td>

                    <td>
                        {{ ucfirst(str_replace('_', ' ', $pesanan->status_pembayaran ?? 'belum_bayar')) }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="9" style="text-align:center;">
                        Tidak ada transaksi.
                    </td>
                </tr>

            @endforelse
        </tbody>
    </table>

    <div class="total">
        Total Nilai Transaksi:
        Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
        <br>

        Total Pembayaran:
        Rp {{ number_format($omset, 0, ',', '.') }}
    </div>

</body>
</html>