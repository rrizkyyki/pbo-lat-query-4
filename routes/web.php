<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LelangController;
use App\Http\Controllers\MasyarakatController;
use App\Http\Controllers\BarangController;


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

Route::controller(LelangController::class)->prefix('lelang')->name('lelang.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('', 'store')->name('store');
    Route::get('edit/{id}', 'edit')->name('edit');
    Route::delete('edit/{id}', 'destroy')->name('destroy');
});

Route::controller(MasyarakatController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/', 'store');
    Route::delete('edit/{id}', 'destroy');
});

Route::controller(BarangController::class)->prefix('barang')->name('barang.')->group(function () {
    Route::get('', 'index')->name('index');
    Route::post('store', 'store')->name('store');
    // Route::get('edit/{id}', 'edit')->name('edit');
    Route::put('edit/{id}', 'update')->name('update');
    Route::delete('edit/{id}', 'destroy')->name('destroy');
});
