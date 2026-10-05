<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Katalog TEFA</title>

    <style>
        /* =====================================================
           PAGE (MARGIN ATAS & BAWAH DIPANGKAS)
        ===================================================== */
        @page {
            size: A4 portrait;
            margin: 100px 22px 40px 22px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: DejaVu Sans, sans-serif;
            background: #ffffff;
            color: #0f172a;
        }

        /* =====================================================
           HEADER (TETAP SAMA SEPERTI AWAL)
        ===================================================== */
        .header {
            position: fixed;
            top: -100px;
            left: -22px;
            right: -22px;
            height: 85px;
            background: #064a9b;
            color: white;
        }

        .header-top {
            height: 20px;
            background: #073f82;
            text-align: right;
            padding: 5px 22px;
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 0.8px;
        }

        .header-main {
            height: 65px;
            padding: 0 22px;
        }

        .header-table {
            width: 100%;
            height: 65px;
            border-collapse: collapse;
        }

        .header-logo-cell {
            width: 55px;
            vertical-align: middle;
            text-align: left;
        }

        .header-logo {
            width: 42px;
            height: 42px;
            display: block;
        }

        .header-text-cell {
            vertical-align: middle;
            padding-left: 8px;
        }

        .school-name {
            font-size: 8px;
            font-weight: bold;
            letter-spacing: 0.5px;
            margin-bottom: 1px;
        }

        .catalog-title {
            font-size: 18px;
            font-weight: bold;
            line-height: 18px;
        }

        .catalog-subtitle {
            font-size: 7px;
            font-weight: bold;
            letter-spacing: 0.4px;
        }

        /* =====================================================
           WRAPPER KONTENER BIRU (PADDING & MARGIN DIKECILIN)
        ===================================================== */
        .page-wrapper {
            background: #eaf4ff;
            border-radius: 12px;
            padding: 4px;
            margin-bottom: 0px;
            margin-top: 20px;
        }

        .catalog-page {
            width: 100%;
        }

        .product-grid {
            width: 100%;
            border-collapse: separate;
            border-spacing: 4px 4px;
        }

        .product-cell {
            width: 33.33%;
            vertical-align: top;
        }

        /* =====================================================
           PRODUCT CARD (TETAP SAMA SEPERTI KODE KAMU)
        ===================================================== */
        .product {
            background: #ffffff;
            border: 1px solid #cbdff2;
            border-radius: 8px;
            padding: 8px;
            min-height: 0;
            page-break-inside: avoid;
        }

        .jurusan {
            display: inline-block;
            background: #0754a6;
            color: #ffffff;
            border-radius: 8px;
            padding: 3px 8px;
            font-size: 8px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .image-wrapper {
            width: 100%;
            height: 135px;
            background: #f1f5f9;
            border-radius: 7px;
            text-align: center;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 135px;
            border-radius: 7px;
            display: block;
        }

        .no-image {
            width: 100%;
            height: 135px;
            background: #e2e8f0;
            border-radius: 7px;
            text-align: center;
            padding-top: 55px;
            color: #64748b;
            font-size: 9px;
        }

        .product-name {
            font-size: 12px;
            font-weight: bold;
            color: #064a9b;
            margin-top: 6px;
            margin-bottom: 4px;
            line-height: 14px;
            height: 28px;
            overflow: hidden;
        }

        .description {
            font-size: 9.2px;
            color: #475569;
            line-height: 12px;
            height: 36px;
            overflow: hidden;
        }

        .price-line {
            border-top: 1px solid #dbe7f2;
            margin-top: 6px;
            padding-top: 5px;
        }

        .price {
            font-size: 12.5px;
            font-weight: bold;
            color: #064a9b;
        }

        .empty {
            text-align: center;
            padding: 50px 20px;
            color: #64748b;
            font-size: 11px;
        }

        /* =====================================================
           FOOTER (TETAP SAMA SEPERTI AWAL)
        ===================================================== */
        .footer {
            position: fixed;
            bottom: -40px;
            left: -22px;
            right: -22px;
            height: 40px;
            background: #073f82;
            color: white;
            padding: 6px 22px;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }

        .footer-left {
            width: 50%;
            vertical-align: middle;
        }

        .footer-right {
            width: 50%;
            vertical-align: middle;
            text-align: right;
        }

        .footer-title {
            font-size: 7px;
            font-weight: bold;
            line-height: 8px;
        }

        .footer-text {
            font-size: 6px;
            color: #dbeafe;
            margin-top: 1px;
            line-height: 7px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

{{-- HEADER FIXED --}}
<div class="header">
    <div class="header-top">
        TEFA &nbsp; • &nbsp; SMK N 4 &nbsp; • &nbsp; TANJUNG PINANG
    </div>

    @php
        $logoPath = public_path('gambar/tefa/logo.png');
        $logoData = null;
        $logoMime = null;

        if (file_exists($logoPath)) {
            $logoMime = mime_content_type($logoPath);
            $logoData = base64_encode(file_get_contents($logoPath));
        }
    @endphp

    <div class="header-main">
        <table class="header-table">
            <tr>
                <td class="header-logo-cell">
                    @if ($logoData)
                        <img src="data:{{ $logoMime }};base64,{{ $logoData }}" class="header-logo">
                    @endif
                </td>
                <td class="header-text-cell">
                    <div class="school-name">
                        TEFA SMK N 4 TANJUNG PINANG
                    </div>
                    <div class="catalog-title">
                        KATALOG
                    </div>
                    <div class="catalog-subtitle">
                        PRODUK DAN LAYANAN
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

{{-- FOOTER FIXED --}}
<div class="footer">
    <table class="footer-table">
        <tr>
            <td class="footer-left">
                <div class="footer-title">
                    ☎ &nbsp; +62 812-3456-7890
                </div>
                <div class="footer-text">
                    Hubungi kami untuk informasi lebih lanjut
                </div>
            </td>
            <td class="footer-right">
                <div class="footer-title">
                    ⌖ &nbsp; Jl. Nusantara No.KM.14
                </div>
                <div class="footer-text">
                    Tanjung Pinang, Kepulauan Riau
                </div>
            </td>
        </tr>
    </table>
</div>

{{-- PRODUK --}}
@if ($tefas->count())

    @foreach ($tefas->chunk(9) as $pageProducts)

    <div class="page-wrapper">
        <div class="catalog-page">
            <table class="product-grid">
                <tbody>
                    @foreach ($pageProducts->chunk(3) as $chunk)
                        <tr>
                            @foreach ($chunk as $tefa)
                                <td class="product-cell">
                                    <div class="product">
                                        <div class="jurusan">
                                            {{ $tefa->jurusan }}
                                        </div>

                                        <div class="image-wrapper">
                                            @if ($tefa->gambar)
                                                @php
                                                    $imagePath = public_path('gambar/tefa/' . $tefa->gambar);
                                                @endphp

                                                @if (file_exists($imagePath))
                                                    @php
                                                        $mime = mime_content_type($imagePath);
                                                        $imageData = base64_encode(file_get_contents($imagePath));
                                                    @endphp
                                                    <img src="data:{{ $mime }};base64,{{ $imageData }}" class="product-image">
                                                @else
                                                    <div class="no-image">Gambar tidak ditemukan</div>
                                                @endif
                                            @else
                                                <div class="no-image">Tidak ada gambar</div>
                                            @endif
                                        </div>

                                        <div class="product-name">
                                            {{ $tefa->nama_produk }}
                                        </div>

                                        <div class="description">
                                            {{ $tefa->deskripsi }}
                                        </div>

                                        <div class="price-line">
                                            <div class="price">
                                                Rp{{ number_format($tefa->harga, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            @endforeach

                            @if ($chunk->count() < 3)
                                @for ($i = $chunk->count(); $i < 3; $i++)
                                    <td class="product-cell"></td>
                                @endfor
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if (!$loop->last)
        <div class="page-break"></div>
    @endif

@endforeach

@else
    <div class="empty">
        Belum ada produk atau layanan yang tersedia.
    </div>
@endif

</body>
</html>