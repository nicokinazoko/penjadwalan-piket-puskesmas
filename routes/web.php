<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::fallback(function () {
    return view('content.error-page.404');
});
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/pegawai')->group(function () {

    Route::get('/lihat-data',  [AdminController::class, 'viewDataPegawai'])->name('pegawai-view-data');

    Route::get('/input-data',  [AdminController::class, 'inputDataPegawai'])->name('pegawai-input-data');
    Route::post('/input-data',  [AdminController::class, 'prosesInputDataPegawai'])->name('pegawai-input-data-proses');

    Route::get('/edit-data',  [AdminController::class, 'editDataPegawai'])->name('pegawai-edit-data');


    Route::get('/edit-data/{id_pegawai}', [AdminController::class, 'editDataPegawaiById'])->name('pegawai-edit-data-by-id');
    Route::patch('/edit-data/{id_pegawai}',  [AdminController::class, 'prosesEditDataPegawaiById'])->name('pegawai-edit-data-proses');

    Route::get('/delete-data/{id_pegawai}', [AdminController::class, 'deleteDataPegawaiByID'])->name('pegawai-delete-data');
});

Route::prefix('/piket')->group(function () {

    Route::get('/lihat-data', [AdminController::class, 'viewDataPiket'])->name('piket-view-data');

    Route::get('/input-data', [AdminController::class, 'inputDataPiket'])->name('piket-input-data');
    Route::post('/input-data', [AdminController::class, 'prosesInputDataPiket'])->name('piket-input-data-proses');

    Route::get('/edit-data', [AdminController::class, 'editDataPiket'])->name('piket-edit-data');

    Route::get('/edit-data/{id_piket}', [AdminController::class, 'editDataPiketById'])->name('piket-edit-data-by-id');
    Route::patch('/edit-data/{id_piket}', [AdminController::class, 'prosesEditDataPiketById'])->name('piket-edit-data-by-id-proses');

    Route::get('/delete-data/{id_piket}', [AdminController::class, 'deleteDataPiketById'])->name('piket-delete-data-by-id');
});

Route::get('/dashboard', [AdminController::class, 'viewDashboard'])->name('dashboard');

Route::get('/tabel-data', function () {
    return view('content.table-data');
});

Route::prefix('/algoritma')->group(function () {

    // ========================= Memetika =========================
    // untuk input data jadwal
    Route::get('memetika', [AdminController::class, 'viewAlgoritmaMemetika'])->name('view-memetika');

    // untuk proses data jadwal
    Route::post('memetika', [AdminController::class, 'prosesAlgoritmaMemetika'])->name('proses-memetika');

    // untuk lihat hasil proses
    Route::get('memetika/hasil', [AdminController::class, 'hasilProsesAlgoritmaMemetika'])->name('hasil-algoritma-memetika');

    // untuk lihat data dari db memetika
    Route::get('memetika/lihat-data', [AdminController::class, 'viewDataHasilAlgoritmaMemetika'])->name('view-data-algoritma-memetika');

    // untuk lihat hasil proses sebelum simpan ke db memetika
    Route::post('memetika/hasil', [AdminController::class, 'prosesSimpanHasilPenjadwalan'])->name('proses-simpan-data-algoritma-memetika');

    // untuk lihat data penjadwalan memetika dari tanggal pembuatan
    Route::get('memetika/lihat-data/{tanggal_pembuatan}', [AdminController::class, 'getDataPenjadwalanByTanggalPembuatan'])->name('view-data-penjadwalan-algoritma-memetika');

    // untuk lihat data dari tanggal piket dan tanggal penjadwalan
    Route::get('memetika/edit-data/{tanggal_piket}/{id_penjadwalan_memetika}', [AdminController::class, 'editDataPenjadwalanByIdPenjadwalanMemetika'])->name('edit-data-penjadwalan-algoritma-memetika');
    Route::get('neuro-fuzzy/edit-data/{tanggal_piket}/{id_penjadwalan_neuro_fuzzy}', [AdminController::class, 'editDataPenjadwalanByIdPenjadwalanNeuroFuzzy'])->name('edit-data-penjadwalan-algoritma-neuro-fuzzy');

    // untuk simpan data hasil edit data memetika
    Route::patch('memetika/edit-data/{id_penjadwalan_memetika}', [AdminController::class, 'prosesEditDataPenjadwalanByIdPenjadwalanMemetika'])->name('edit-data-penjadwalan-algoritma-memetika-proses');

    // untuk hapus data memetika
    Route::get('memetika/{tanggal_pembuatan}', [AdminController::class, 'deleteDataPenjadwalanMemetikaByTanggalPembuatanJadwal'])->name('delete-data-penjadwalan-memetika');



    // ========================= Neuro Fuzzy =========================

    // lihat form neuro fuzzy
    Route::get('neuro-fuzzy', [AdminController::class, 'viewAlgoritmaNeuroFuzzy'])->name('view-neuro-fuzzy');

    // untuk proses neuro fuzzy
    Route::post('neuro-fuzzy', [AdminController::class, 'prosesAlgoritmaNeuroFuzzy'])->name('proses-neuro-fuzzy');

    // untuk lihat hasil proses sebelum simpan ke db neuro fuzzy
    Route::post('neuro-fuzzy/hasil', [AdminController::class, 'prosesSimpanHasilPenjadwalan'])->name('proses-simpan-data-algoritma-neuro-fuzzy');

    // untuk lihat data dari db neuro fuzzy
    Route::get('neuro-fuzzy/lihat-data', [AdminController::class, 'viewDataHasilAlgoritmaNeuroFuzzy'])->name('view-data-algoritma-neuro-fuzzy');

    // untuk lihat data penjadwalan neuro fuzzy dari tanggal pembuatan
    Route::get('neuro-fuzzy/lihat-data/{tanggal_pembuatan}', [AdminController::class, 'getDataPenjadwalanByTanggalPembuatanNeuroFuzzy'])->name('view-data-penjadwalan-algoritma-neuro-fuzzy');


    // untuk hapus data penjadwalan neuro fuzzy
    Route::get('neuro-fuzzy/{tanggal_pembuatan}', [AdminController::class, 'deleteDataPenjadwalanByTanggalPembuatanJadwal'])->name('delete-data-penjadwalan-neuro-fuzzy');

    // untuk lihat data dari tanggal piket dan tanggal penjadwalan
    Route::get('neuro-fuzzy/edit-data/{tanggal_piket}/{id_penjadwalan_neuro_fuzzy}', [AdminController::class, 'editDataPenjadwalanByIdPenjadwalanNeuroFuzzy'])->name('edit-data-penjadwalan-algoritma-neuro-fuzzy');

    // untuk simpan data hasil edit data memetika
    Route::patch('neuro-fuzzy/edit-data/{id_penjadwalan_neuro_fuzzy}', [AdminController::class, 'prosesEditDataPenjadwalanByIdPenjadwalanNeuroFuzzy'])->name('edit-data-penjadwalan-algoritma-neuro-fuzzy-proses');




    // ========================= Genetika =========================

    // untuk input data algoritma genetika
    Route::get('genetika', [AdminController::class, 'viewAlgoritmaGenetika'])->name('view-genetika');

    // untuk proses genetika
    Route::post('genetika', [AdminController::class, 'prosesAlgoritmaGenetika'])->name('proses-genetika');

    // untuk lihat hasil proses sebelum simpan ke db genetika
    Route::post('genetika/hasil', [AdminController::class, 'prosesSimpanHasilPenjadwalanGenetika'])->name('proses-simpan-data-algoritma-genetika');

    // untuk lihat data dari db genetika
    Route::get('genetika/lihat-data', [AdminController::class, 'viewDataHasilAlgoritmaGenetika'])->name('view-data-algoritma-genetika');

    // untuk lihat data penjadwalan genetika dari tanggal pembuatan
    Route::get('genetika/lihat-data/{tanggal_pembuatan}', [AdminController::class, 'getDataPenjadwalanByTanggalPembuatanGenetika'])->name('view-data-penjadwalan-algoritma-genetika');

    // untuk hapus data penjadwalan neuro fuzzy
    Route::get('genetika/{tanggal_pembuatan}', [AdminController::class, 'deleteDataPenjadwalanByTanggalPembuatanJadwalGenetika'])->name('delete-data-penjadwalan-genetika');
});
