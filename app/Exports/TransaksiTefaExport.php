<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\FromCollection;

class TransaksiTefaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function transaksiExcel(Request $request)
    {
        $tanggalDari = $request->tanggal_dari;
        $tanggalSampai = $request->tanggal_sampai;

        $query = Pesanan::with([
            'tefa',
            'user',
            'worker',
        ]);

        if ($tanggalDari) {
            $query->whereDate('tanggal_pesan', '>=', $tanggalDari);
        }

        if ($tanggalSampai) {
            $query->whereDate('tanggal_pesan', '<=', $tanggalSampai);
        }

        $transaksi = $query
            ->latest('tanggal_pesan')
            ->get();

        return Excel::download(
            new TransaksiJurusanExport($transaksi),
            'transaksi-tefa.xlsx'
    );
}
}
