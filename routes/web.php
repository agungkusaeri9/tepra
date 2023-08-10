<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisBarangJasaController;
use App\Http\Controllers\PenarikanDanaAnggaranController;
use App\Http\Controllers\PendanaanPenangananCovid19Controller;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\PenyerapanAnggaranController;
use App\Http\Controllers\PermasalahanPenarikanDanaAnggaranController;
use App\Http\Controllers\PermasalahanPendapatanController;
use App\Http\Controllers\ProfileController;
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



    // users
    Route::resource('users', UserController::class)->except('show');

    // triwulans
    Route::resource('triwulans', TriwulanController::class)->except('show');

    // jenis-barang-jasa
    Route::resource('jenis-barang-jasa', JenisBarangJasaController::class)->except('show');

    // pendapatan
    Route::resource('pendapatans', PendapatanController::class);

    // permasalahan-pendapatan
    Route::resource('permasalahan-pendapatans', PermasalahanPendapatanController::class)->except('show');

    // penarikan-dana-anggaran
    Route::resource('penarikan-dana-anggarans', PenarikanDanaAnggaranController::class);

    // permasalahan-penarikan-dana-anggaran
    Route::resource('permasalahan-anggarans', PermasalahanPenarikanDanaAnggaranController::class)->except('show');

    // penyerapan-anggarans
    Route::resource('penyerapan-anggarans', PenyerapanAnggaranController::class)->except('show');

    // pendanaan-penanganan-covid19
    Route::resource('pendanaan-penanganan-covid19', PendanaanPenangananCovid19Controller::class)->except('show');
});
