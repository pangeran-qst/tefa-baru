<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiJurusanExport implements FromCollection, WithHeadings, WithColumnWidths, WithStyles
{
    protected $transaksi;

    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function collection()
    {
        return $this->transaksi->map(function ($pesanan) {

            // Harga final
            $hargaFinal = ($pesanan->harga_final === null || $pesanan->harga_final === '')
                ? '0'
                : (string) $pesanan->harga_final;

            // Nominal dibayar
            $sudahDibayar = ($pesanan->nominal_dibayar === null || $pesanan->nominal_dibayar === '')
                ? '0'
                : (string) $pesanan->nominal_dibayar;

            // Sisa pembayaran
            $sisa = max(
                (int) $hargaFinal - (int) $sudahDibayar,
                0
            );

            $sisa = (string) $sisa;

            if ($pesanan->status_pembayaran === 'lunas') {
                $statusPembayaran = 'Lunas';
            } elseif ($pesanan->status_pembayaran === 'dp') {
                $statusPembayaran = 'DP';
            } else {
                $statusPembayaran = 'Belum Bayar';
            }

            return [
                $pesanan->id_pesanan,
                $pesanan->nama_pemesan,
                $pesanan->tefa->nama_produk ?? '-',
                $hargaFinal,
                $sudahDibayar,
                $sisa,
                $statusPembayaran,
                $pesanan->tanggal_pesan
                    ? $pesanan->tanggal_pesan->format('d/m/Y')
                    : '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No. Pesanan',
            'Klien',
            'Layanan',
            'Harga Kesepakatan',
            'Sudah Dibayar',
            'Sisa Pembayaran',
            'Status Pembayaran',
            'Tanggal Pesanan',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 14,
            'B' => 20,
            'C' => 32,
            'D' => 20,
            'E' => 18,
            'F' => 20,
            'G' => 20,
            'H' => 18,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical' => 'center',
                    'wrapText' => true,
                ],
            ],

            'A:H' => [
                'alignment' => [
                    'vertical' => 'center',
                    'wrapText' => true,
                ],
            ],
        ];
    }
}