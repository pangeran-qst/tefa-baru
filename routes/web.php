<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTefaController;
use App\Http\Controllers\AdminJurusanController;
use App\Http\Controllers\TefaController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/detail/{id_produk}', [TefaController::class, 'detail'])
    ->name('detail.produk');


Route::get('/login', function (Illuminate\Http\Request $request) {

    if ($request->has('redirect')) {
        session(['url.intended' => $request->query('redirect')]);
    }

    return view('login');

})->name('login');


Route::post('/login-proses', [AuthController::class, 'login'])
    ->name('login.proses');

Route::get('/daftar', function () {
    return view('daftar');
    })->name('daftar');

Route::post('/daftar-proses', [AuthController::class, 'register'])
    ->name('daftar.proses');


// ==============================
// KATALOG PRODUK TEFA
// ==============================

Route::get('/katalog', [TefaController::class, 'katalog'])
    ->name('katalog');

Route::get('/katalog/semua', [TefaController::class, 'semua'])
    ->name('katalog.semua');

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

Route::get('/detail/{id_produk}', [TefaController::class, 'detail'])
    ->name('detail.produk');

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
// PORTOFOLIO
// ==============================

// Route Utama Portofolio
Route::get('/portofolio', [TefaController::class, 'portofolio'])->name('portofolio');

// Route Portofolio Per Jurusan
Route::prefix('portofolio')->group(function () {
    Route::get('/semua', [TefaController::class, 'portofolioSemua'])->name('portofolio.semua');
    Route::get('/tkj', [TefaController::class, 'portofolioTkj'])->name('portofolio.tkj');
    Route::get('/gim', [TefaController::class, 'portofolioGim'])->name('portofolio.gim');
    Route::get('/animasi', [TefaController::class, 'portofolioAnimasi'])->name('portofolio.animasi');
    Route::get('/rpl', [TefaController::class, 'portofolioRpl'])->name('portofolio.rpl');
    Route::get('/dkv', [TefaController::class, 'portofolioDkv'])->name('portofolio.dkv');
    Route::get('/pspt', [TefaController::class, 'portofolioPspt'])->name('portofolio.pspt');
    
    // Daftar Karya berdasarkan Produk TeFA
    Route::get('/produk/{id}', [TefaController::class, 'portofolioProduk'])->name('portofolio.produk');
    
    // Detail Single Karya
    Route::get('/karya/{id}', [TefaController::class, 'detailKarya'])->name('portofolio.karya');
    
});

// ==============================
// AUTH
// ==============================

Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

        // PESANAN SAYA CLIENT
    Route::get('/klien/pesanan', [TefaController::class, 'pesananSaya'])
    ->name('client.pesanan'); 

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

    Route::get('/admin/jurusan/pesanan', [AdminJurusanController::class, 'index'])->name('admin.jurusan.pesanan');

    Route::post('/admin/jurusan/pesanan/{id}/update-status', [AdminJurusanController::class, 'updateStatus'])->name('admin.jurusan.pesanan.updateStatus');
    
    //admin jrusan menugaskan workernya
    Route::post('/admin/jurusan/pesanan/{id}/assign', [AdminJurusanController::class, 'assignWorker'])->name('admin.jurusan.pesanan.assign');

    Route::get('/admin/jurusan/pengguna', [AdminJurusanController::class, 'pengguna'])
        ->name('admin.jurusan.pengguna');

 


    // ==========================
    // DASHBOARD WORKER
    // ==========================

    Route::get('/worker', function () {
        return view('worker.dashboard');
    })->name('worker.dashboard');

    Route::get('/worker/tugasku', [WorkerController::class, 'tugasku'])
    ->name('worker.tugasku');
    
    Route::post('/worker/pesanan/{id}/terima', [WorkerController::class, 'terima'])
    ->name('worker.pesanan.terima');

    Route::post('/worker/pesanan/{id}/tolak', [WorkerController::class, 'tolak'])
        ->name('worker.pesanan.tolak');

    Route::post('/worker/pesanan/{id}/progress', [WorkerController::class, 'updateProgress'])
        ->name('worker.pesanan.progress');


    Route::post('/worker/pesanan/{id}/selesai', [WorkerController::class, 'selesai'])
        ->name('worker.pesanan.selesai');

    Route::get('/worker/portofolio', [WorkerController::class, 'portofolio'])
        ->name('worker.portofolio');

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

        // Simpan portofolio
        Route::post('/portofolio', [AdminTefaController::class, 'storePortofolio'])
            ->name('admin.tefa.portofolio.store');


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


        // Manajemen Pengguna
        Route::get('/pengguna', [AdminTefaController::class, 'pengguna'])
            ->name('admin.tefa.pengguna');

        // Simpan akun pengguna
        Route::post('/pengguna', [AdminTefaController::class, 'storePengguna'])
            ->name('admin.tefa.pengguna.store');

        Route::get('/pengguna/{id}/edit', [AdminTefaController::class, 'editPengguna'])
            ->name('admin.tefa.pengguna.edit');

        Route::put('/pengguna/{id}', [AdminTefaController::class, 'updatePengguna'])
            ->name('admin.tefa.pengguna.update');

        Route::delete('/pengguna/{id}', [AdminTefaController::class, 'destroyPengguna'])
            ->name('admin.tefa.pengguna.destroy');

    });