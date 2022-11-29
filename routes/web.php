<?php

use App\Http\Controllers\BimbinganController;
use App\Http\Controllers\PengajuanController;
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

Route::get('/', [BimbinganController::class, 'index'])->name('bimbingan');

Route::post('/pengajuan', [PengajuanController::class, 'store'])->name('store_pengajuan');

Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan');

Route::get('/admin', [PengajuanController::class, 'edit'])->name('admin');

Route::group(['prefix' => '/admin/{pengajuan}', 'as' => 'approval.'], function () {
    Route::post('/accept', [PengajuanController::class, 'accept'])->name('accept');
    Route::post('/reject', [PengajuanController::class, 'reject'])->name('reject');
    Route::post('/cancel', [PengajuanController::class, 'cancel'])->name('cancel');
});
