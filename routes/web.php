<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTefaController;
use App\Http\Controllers\TefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/detail/{id_produk}', [TefaController::class, 'detail'])
    ->name('detail.produk');

Route::get('/klien/dashboard}',  function () {
    return view('client.pesanan.index');
})->name('client.pesanan');


Route::get('/login', function (Illuminate\Http\Request $request) {

    if ($request->has('redirect')) {
        session(['url.intended' => $request->query('redirect')]);
    }

    return view('login');

})->name('login');


Route::post('/login-proses', [AuthController::class, 'login'])
    ->name('login.proses');


// ==============================
// KATALOG PRODUK TEFA
// ==============================

Route::get('/katalog', [TefaController::class, 'katalog'])
    ->name('katalog');

Route::get('/katalog/tkj', [TefaController::class, 'tkj'])
    ->name('katalog.tkj');

Route::get('/katalog/gim', [TefaController::class, 'gim'])
    ->name('katalog.gim');

Route::get('/katalog/animasi', [TefaController::class, 'animasi'])
    ->name('katalog.animasi');

Route::get('/katalog/rpl', [TefaController::class, 'rpl'])
    ->name('katalog.rpl');

Route::get('/katalog/dkv', [TefaController::class, 'dkv'])
    ->name('katalog.dkv');

Route::get('/katalog/pspt', [TefaController::class, 'pspt'])
    ->name('katalog.pspt');


// ==============================
// CEK TIKET
// ==============================

Route::get('/cek-ticket', [TefaController::class, 'cekTicket'])
    ->name('cek.ticket');


// ==============================
// KONTAK
// ==============================

Route::get('/kontak', function () {
    return view('public.katalog.kontak');
})->name('kontak');


// ==============================
// AUTH
// ==============================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    // ==========================
    // DASHBOARD CLIENT
    // ==========================

    Route::get('/profil', function () {
        return view('client.dashboard');
    })->name('client.dashboard');


    // ==========================
    // DASHBOARD ADMIN JURUSAN
    // ==========================

    Route::get('/admin/jurusan', function () {
        return view('admin.jurusan.dashboard');
    })->name('admin.jurusan.dashboard');

    Route::get('/admin/jurusan/pesanan', function () {
        return view('admin.jurusan.pesanan.index');
    })->name('admin.jurusan.pesanan');

    Route::get('/admin/jurusan/pengguna', function () {
        return view('admin.jurusan.pengguna.index');
    })->name('admin.jurusan.pengguna');

 


    // ==========================
    // DASHBOARD WORKER
    // ==========================

    Route::get('/worker', function () {
        return view('worker.dashboard');
    })->name('worker.dashboard');

    Route::get('/worker/tugasku', function () {
        return view('worker.tugasku.index');
    })->name('worker.tugasku');

    Route::get('/worker/portofolio', function () {
        return view('worker.portofolio.index');
    })->name('worker.portofolio');

});


// ==============================
// PESANAN
// ==============================

Route::post('/pesanan', [TefaController::class, 'storePesanan'])
    ->name('pesanan.store');


// ==============================
// ADMIN TEFA
// ==============================

Route::middleware(['auth', 'admin.tefa'])
    ->prefix('admin/tefa')
    ->group(function () {

        // Menyimpan data produk jurusan TEFA
        Route::post('/jurusan', [AdminTefaController::class, 'storeJurusan'])
            ->name('admin.tefa.jurusan.store');


        // Dashboard Admin TEFA
        Route::get('/', [AdminTefaController::class, 'dashboard'])
            ->name('admin.tefa.dashboard');


        // Produk TEFA
        Route::get('/produk', [AdminTefaController::class, 'produk'])
            ->name('admin.tefa.produk');


        // Cetak katalog PDF
        Route::get('/katalog/cetak-pdf', [AdminTefaController::class, 'cetakKatalog'])
            ->name('admin.tefa.katalog.pdf');


        // Tambah produk
        Route::get('/produk/tambah', [AdminTefaController::class, 'createProduk'])
            ->name('admin.tefa.produk.create');


        // Simpan produk
        Route::post('/produk', [AdminTefaController::class, 'storeProduk'])
            ->name('admin.tefa.produk.store');


        // Edit produk
        Route::get('/produk/{id_produk}/edit', [AdminTefaController::class, 'editProduk'])
            ->name('admin.tefa.produk.edit');


        // Update produk
        Route::put('/produk/{id_produk}', [AdminTefaController::class, 'updateProduk'])
            ->name('admin.tefa.produk.update');


        // Daftar pesanan
        Route::get('/pesanan', [AdminTefaController::class, 'pesanan'])
            ->name('admin.tefa.pesanan');


        // Detail pesanan
        Route::get('/pesanan/{id_pesanan}', [AdminTefaController::class, 'detailPesanan'])
            ->name('admin.tefa.pesanan.detail');


        // Proses pesanan
        Route::post('/pesanan/{id_pesanan}/proses', [AdminTefaController::class, 'prosesPesanan'])
            ->name('admin.tefa.pesanan.proses');


        // Hapus produk
        Route::delete('/produk/{id_produk}', [AdminTefaController::class, 'destroyProduk'])
            ->name('admin.tefa.produk.destroy');


        // Analitik
        Route::get('/analitik', function () {
            return view('admin.tefa.analitik');
        })->name('admin.tefa.analitik');


        // Transaksi
        Route::get('/transaksi', function () {
            return view('admin.tefa.transaksi');
        })->name('admin.tefa.transaksi');


        // Pengguna
        Route::get('/pengguna', function () {
            return view('admin.tefa.pengguna');
        })->name('admin.tefa.pengguna');

    });