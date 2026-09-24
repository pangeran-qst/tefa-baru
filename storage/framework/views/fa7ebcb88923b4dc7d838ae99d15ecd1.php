<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <title>Katalog TEFA</title>

    <style>
        @page {
            margin: 30px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header {
            width: 100%;
            background: #4f46e5;
            color: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 25px;
        }

        .header-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .header-subtitle {
            font-size: 11px;
            color: #e0e7ff;
        }

        .header-info {
            margin-top: 15px;
            font-size: 10px;
            color: #e0e7ff;
        }

        /* JUDUL */
        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #0f172a;
        }

        /* PRODUK */
        .product {
            width: 100%;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            margin-bottom: 18px;
            padding: 14px;
            page-break-inside: avoid;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
        }

        .image-cell {
            width: 32%;
            vertical-align: top;
            padding-right: 15px;
        }

        .info-cell {
            width: 68%;
            vertical-align: top;
        }

        .product-image {
            width: 150px;
            height: 110px;
            object-fit: cover;
            border-radius: 8px;
        }

        .no-image {
            width: 150px;
            height: 110px;
            background: #f1f5f9;
            border-radius: 8px;
            text-align: center;
            padding-top: 45px;
            color: #94a3b8;
            font-size: 10px;
        }

        .product-name {
            font-size: 15px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 7px;
        }

        .badge {
            display: inline-block;
            background: #eef2ff;
            color: #4f46e5;
            padding: 4px 8px;
            border-radius: 5px;
            font-size: 9px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .description {
            font-size: 10px;
            line-height: 1.6;
            color: #64748b;
            margin-bottom: 10px;
        }

        .price {
            font-size: 14px;
            font-weight: bold;
            color: #4f46e5;
        }

        /* FOOTER */
        .footer {
            margin-top: 25px;
            padding-top: 12px;
            border-top: 1px solid #e2e8f0;
            text-align: center;
            font-size: 9px;
            color: #94a3b8;
        }
    </style>
</head>

<body>

    
    <div class="header">

        <div class="header-title">
            KATALOG LAYANAN TEFA
        </div>

        <div class="header-subtitle">
            Teaching Factory — SMKN 4
        </div>

        <div class="header-info">
            Katalog produk dan layanan dari berbagai jurusan
        </div>

    </div>


    
    <div class="section-title">
        Produk & Layanan
    </div>


    
    <?php $__empty_1 = true; $__currentLoopData = $tefas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tefa): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <div class="product">

            <table class="product-table">
                <tr>

                    
                    <td class="image-cell">

                        <?php if($tefa->gambar): ?>

                            <?php
                                $imagePath = public_path(
                                    'gambar/tefa/' . $tefa->gambar
                                );
                            ?>

                            <?php if(file_exists($imagePath)): ?>

                                <?php
                                    $mime = mime_content_type($imagePath);
                                    $imageData = base64_encode(
                                        file_get_contents($imagePath)
                                    );
                                ?>

                                <img
                                    src="data:<?php echo e($mime); ?>;base64,<?php echo e($imageData); ?>"
                                    class="product-image"
                                >

                            <?php else: ?>

                                <div class="no-image">
                                    Gambar tidak ditemukan
                                </div>

                            <?php endif; ?>

                        <?php else: ?>

                            <div class="no-image">
                                Tidak ada gambar
                            </div>

                        <?php endif; ?>

                    </td>


                    
                    <td class="info-cell">

                        <div class="product-name">
                            <?php echo e($tefa->nama_produk); ?>

                        </div>


                        <div class="badge">
                            <?php echo e($tefa->jurusan); ?>

                        </div>


                        <div class="description">
                            <?php echo e($tefa->deskripsi); ?>

                        </div>


                        <div class="price">
                            Rp <?php echo e(number_format($tefa->harga, 0, ',', '.')); ?>

                        </div>

                    </td>

                </tr>
            </table>

        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <div style="text-align:center; padding:40px; color:#94a3b8;">
            Belum ada produk atau layanan yang tersedia.
        </div>

    <?php endif; ?>


    
    <div class="footer">
        Katalog TEFA — SMKN 4
    </div>

</body>
</html><?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel-belajar-tefa baru lagi(2) gigithub/resources/views/pdf/katalog-tefa.blade.php ENDPATH**/ ?>