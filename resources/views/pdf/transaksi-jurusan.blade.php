<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">

    <title>Laporan Transaksi Jurusan</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 11px;
        }

        .summary {
            margin-bottom: 15px;
        }

        .summary table {
            width: 100%;
        }

        .summary td {
            padding: 4px;
        }

        .label {
            width: 150px;
            font-weight: bold;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 7px;
            text-align: center;
            font-size: 9px;
        }

        .data-table td {
            border: 1px solid #cbd5e1;
            padding: 6px;
            font-size: 9px;
        }

        .center {
            text-align: center;
        }

        .right {
            text-align: right;
        }

        .footer {
            margin-top: 20px;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">

        <h1>LAPORAN TRANSAKSI JURUSAN</h1>

        <p>
            Jurusan: <strong>{{ $jurusanUser }}</strong>
        </p>

    </div>


    {{-- RINGKASAN --}}
    <div class="summary">

        <table>

            <tr>
                <td class="label">
                    Total Transaksi
                </td>

                <td>
                    Rp {{ number_format($totalTransaksi, 0, ',', '.') }}
                </td>
            </tr>

            <tr>
                <td class="label">
                    Total Sudah Dibayar
                </td>

                <td>
                    Rp {{ number_format($omset, 0, ',', '.') }}
                </td>
            </tr>

        </table>

    </div>


    {{-- DATA TRANSAKSI --}}
    <table class="data-table">

        <thead>
            <tr>

                <th width="5%">
                    No
                </th>

                <th width="9%">
                    Pesanan
                </th>

                <th width="14%">
                    Klien
                </th>

                <th width="17%">
                    Layanan
                </th>

                <th width="13%">
                    Harga Kesepakatan
                </th>

                <th width="12%">
                    Sudah Dibayar
                </th>

                <th width="12%">
                    Sisa
                </th>

                <th width="9%">
                    Status
                </th>

                <th width="9%">
                    Tanggal
                </th>

            </tr>
        </thead>

        <tbody>

            @forelse($transaksi as $pesanan)

                @php
                    $hargaFinal = $pesanan->harga_final ?? 0;
                    $sudahDibayar = $pesanan->nominal_dibayar ?? 0;
                    $sisa = max($hargaFinal - $sudahDibayar, 0);
                @endphp

                <tr>

                    <td class="center">
                        {{ $loop->iteration }}
                    </td>

                    <td class="center">
                        #{{ $pesanan->id_pesanan }}
                    </td>

                    <td>
                        {{ $pesanan->nama_pemesan }}
                    </td>

                    <td>
                        {{ $pesanan->tefa->nama_produk ?? '-' }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($hargaFinal, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($sudahDibayar, 0, ',', '.') }}
                    </td>

                    <td class="right">
                        Rp {{ number_format($sisa, 0, ',', '.') }}
                    </td>

                    <td class="center">

                        @if($pesanan->status_pembayaran === 'lunas')
                            Lunas
                        @elseif($pesanan->status_pembayaran === 'dp')
                            DP
                        @else
                            Belum Bayar
                        @endif

                    </td>

                    <td class="center">
                        {{ $pesanan->tanggal_pesan
                            ? $pesanan->tanggal_pesan->format('d/m/Y')
                            : '-' }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="9" class="center">
                        Belum ada transaksi.
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>


    <div class="footer">
        Laporan transaksi jurusan {{ $jurusanUser }}.
    </div>

</body>

</html>