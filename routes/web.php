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
    Route::post('/edit-data/{id_pegawai}',  [AdminController::class, 'prosesEditDataPegawaiById'])->name('pegawai-edit-data-proses');
});

Route::prefix('/piket')->group(function () {

    Route::get('/lihat-data', [AdminController::class, 'viewDataPiket'])->name('piket-view-data');

    Route::get('/input-data', [AdminController::class, 'inputDataPiket'])->name('piket-input-data');
    Route::post('/input-data', [AdminController::class, 'prosesInputDataPiket'])->name('piket-input-data-proses');

    Route::get('/edit-data', [AdminController::class, 'editDataPiket'])->name('piket-edit-data');

    Route::get('/edit-data/{id_piket}', [AdminController::class, 'editDataPiketById'])->name('piket-edit-data-by-id');
    Route::put('/edit-data/{id_piket}', [AdminController::class, 'editDataPiketById'])->name('piket-edit-data-by-id');

    Route::get('/delete-data/{id_piket}',[AdminController::class, 'deleteDataPiketById'])->name('piket-delete-data-by-id');
});

Route::get('/dashboard', [AdminController::class, 'viewDashboard'])->name('dashboard');

Route::get('/tabel-data', function () {
    return view('content.table-data');
});

Route::prefix('/algoritma')->group(function () {
    Route::get('memetika', [AdminController::class, 'viewAlgoritmaMemetika'])->name('view-memetika');

    Route::get('neuro-fuzzy', [AdminController::class, 'viewAlgoritmaNeuroFuzzy'])->name('view-neuro-fuzzy');
});
