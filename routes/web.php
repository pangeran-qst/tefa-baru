<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTefaController;
use App\Http\Controllers\TefaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-proses', [AuthController::class, 'login'])
    ->name('login.proses');

    
//halaman utama
Route::get('/tefa', [TefaController::class, 'index']);

//katalog produk tefa
Route::get('/katalog', [TefaController::class, 'katalog'])
    ->name('katalog');

//katalog tkj
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


Route::get('/cek-ticket', [TefaController::class, 'cekTicket'])
    ->name('cek.ticket');


Route::get('/kontak', function () {
    return view('public.katalog.kontak');
})->name('kontak');




Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');



    // Dashboard Client / Pembeli
    Route::get('/profil', function () {
        return view('client.dashboard');
    })->name('client.dashboard');


    // Dashboard Admin Jurusan
    Route::get('/admin/jurusan', function () {
        return view('admin.jurusan.dashboard');
    })->name('admin.jurusan.dashboard');

    // Pesanan Admin Jurusan
    Route::get('/admin/jurusan/pesanan', function () {
        return view('admin.jurusan.pesanan.index');
    })->name('admin.jurusan.pesanan');

    Route::get('/admin/jurusan/pengguna', function () {
        return view('admin.jurusan.pengguna.index');
    })->name('admin.jurusan.pengguna');

    Route::get('/admin/jurusan/katalog', function () {
        return view('admin.jurusan.katalog.index');
    })->name('admin.jurusan.katalog');

    // Dashboard Worker
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


Route::post('/pesanan', [TefaController::class, 'storePesanan'])
    ->name('pesanan.store');



Route::middleware(['auth', 'admin.tefa'])
    ->prefix('admin/tefa')
    ->group(function () {

        //menyimpan data produk jurusan tefa
        Route::post('/jurusan', [AdminTefaController::class, 'storeJurusan'])
        ->name('admin.tefa.jurusan.store');

        // Dashboard Admin TEFA
        Route::get('/', [AdminTefaController::class, 'dashboard'])
            ->name('admin.tefa.dashboard');
        //untuk masuk ke produk tefa
        Route::get('/produk', [AdminTefaController::class, 'produk'])
            ->name('admin.tefa.produk');
        //Route untuk mencetak pdf
        Route::get('/katalog/cetak-pdf', [AdminTefaController::class, 'cetakKatalog'])
            ->name('admin.tefa.katalog.pdf');
        //tambah data baru untuk produk tefa
        Route::get('/produk/tambah', [AdminTefaController::class, 'createProduk'])
            ->name('admin.tefa.produk.create');
        //nyimpan data katalog produk Tefa
        Route::post('/produk', [AdminTefaController::class, 'storeProduk'])
            ->name('admin.tefa.produk.store');
        //edit data tefa
        Route::get('/produk/{id_produk}/edit', [AdminTefaController::class, 'editProduk'])
            ->name('admin.tefa.produk.edit');
        //menyimpan hasil edit (update)
        Route::put('/produk/{id_produk}', [AdminTefaController::class, 'updateProduk'])
            ->name('admin.tefa.produk.update');

        Route::get('/pesanan', [AdminTefaController::class, 'pesanan'])
            ->name('admin.tefa.pesanan');

        Route::delete('/produk/{id_produk}', [AdminTefaController::class, 'destroyProduk'])
            ->name('admin.tefa.produk.destroy');

        Route::get('/analitik', function () {
            return view('admin.tefa.analitik');
        })->name('admin.tefa.analitik');

        Route::get('/transaksi', function () {
            return view('admin.tefa.transaksi');
        })->name('admin.tefa.transaksi');

        Route::get('/pengguna', function () {
            return view('admin.tefa.pengguna');
        })->name('admin.tefa.pengguna');

        
    });
