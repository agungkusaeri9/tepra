<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangJasaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenarikanDanaAnggaranController;
use App\Http\Controllers\PendanaanPenangananCovid19Controller;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PenyerapanAnggaranController;
use App\Http\Controllers\PermasalahanPbjController;
use App\Http\Controllers\PermasalahanPenarikanDanaAnggaranController;
use App\Http\Controllers\PermasalahanPendapatanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RealisasiPbjController;
use App\Http\Controllers\TargetPbjController;
use App\Http\Controllers\TriwulanController;
use App\Http\Controllers\UserController;
use App\Models\PermasalahanPendapatan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(['register' => false]);

// Route::get('/admin', function () {
//     Auth::logout();
// });


// group operator

Route::middleware('auth')->group(function () {
    // dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/change-password', [ChangePasswordController::class, 'index'])->name('change-password.index');
    Route::post('/change-password', [ChangePasswordController::class, 'update'])->name('change-password.update');


    Route::middleware('cekRole:operator')->group(function () {
        // users
        Route::resource('users', UserController::class)->except('show');

        // triwulans
        Route::resource('triwulans', TriwulanController::class)->except('show');

        // jenis-barang-jasa
        Route::resource('jenis-barang-jasa', JenisBarangJasaController::class)->except('show');
    });


    Route::middleware('cekRole:skpd,tim tepra')->group(function () {
        // pendapatan
        Route::resource('pendapatans', PendapatanController::class)->middleware('cekRole:skpd');

        // permasalahan-pendapatan
        Route::get('permasalahan-pendapatans/{id}/rekomendasi', [PermasalahanPendapatanController::class, 'rekomendasi'])->name('permasalahan-pendapatans.rekomendasi')->middleware('cekRole:tim tepra');
        Route::post('permasalahan-pendapatans/{id}/rekomendasi', [PermasalahanPendapatanController::class, 'rekomendasiStore'])->name('permasalahan-pendapatans.rekomendasi-store')->middleware('cekRole:tim tepra');
        Route::resource('permasalahan-pendapatans', PermasalahanPendapatanController::class)->except('show')->middleware('cekRole:skpd,tim tepra');

        // penarikan-dana-anggaran
        Route::resource('penarikan-dana-anggarans', PenarikanDanaAnggaranController::class)->middleware('cekRole:skpd');

        // permasalahan-penarikan-dana-anggaran
        Route::get('permasalahan-anggarans/{id}/rekomendasi', [PermasalahanPenarikanDanaAnggaranController::class, 'rekomendasi'])->name('permasalahan-anggarans.rekomendasi')->middleware('cekRole:tim tepra');
        Route::post('permasalahan-anggarans/{id}/rekomendasi', [PermasalahanPenarikanDanaAnggaranController::class, 'rekomendasiStore'])->name('permasalahan-anggarans.rekomendasi-store')->middleware('cekRole:tim tepra');
        Route::resource('permasalahan-anggarans', PermasalahanPenarikanDanaAnggaranController::class)->except('show')->middleware('cekRole:skpd,tim tepra');

        // penyerapan-anggarans
        Route::resource('penyerapan-anggarans', PenyerapanAnggaranController::class)->except('show')->middleware('cekRole:skpd');

        // pendanaan-penanganan-covid19
        Route::resource('pendanaan-penanganan-covid19', PendanaanPenangananCovid19Controller::class)->except('show')->middleware('cekRole:skpd');

        // target-pbjs
        Route::resource('target-pbjs', TargetPbjController::class)->middleware('cekRole:skpd');

        // realisasi-pbjs
        Route::resource('realisasi-pbjs', RealisasiPbjController::class)->middleware('cekRole:skpd');

        // permasalahan-pbj
        Route::get('permasalahan-pbjs/{id}/rekomendasi', [PermasalahanPbjController::class, 'rekomendasi'])->name('permasalahan-pbjs.rekomendasi')->middleware('cekRole:tim tepra');
        Route::post('permasalahan-pbjs/{id}/rekomendasi', [PermasalahanPbjController::class, 'rekomendasiStore'])->name('permasalahan-pbjs.rekomendasi-store')->middleware('cekRole:tim tepra');
        Route::resource('permasalahan-pbjs', PermasalahanPbjController::class)->except('show')->middleware('cekRole:skpd,tim tepra');

        Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::post('laporan/export-excel', [LaporanController::class, 'excel'])->name('laporan.export-excel');
    });
});
