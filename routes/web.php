<?php

use App\Models\PerbandinganKriteria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\SubKriteriaController;
use App\Http\Controllers\PerbandinganKriteriaController;

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [UserController::class, 'index'])->name('/');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard.index');
    Route::resource('/periode', PeriodeController::class)->except('show');
    Route::resource('/alternatif', AlternatifController::class)->except('show');
    Route::get('/alternatif/kriteria/{alternatif?}', [AlternatifController::class, 'kriteria'])->name('alternatif.kriteria');
    Route::post('/alternatif/kriteria', [AlternatifController::class, 'kriteria_store'])->name('alternatif.kriteria.store');
    Route::resource('/kriteria', KriteriaController::class)->parameters(['kriteria' => 'kriteria'])->except('show');
    Route::resource('/subkriteria', SubKriteriaController::class)->parameters(['subkriteria' => 'subkriteria'])->except('show');

    /** Perhitungan AHP */
    Route::resource('/perbandingan-kriteria', PerbandinganKriteriaController::class);
    Route::get('/password', [UserController::class, 'password'])->name('password.index');
    Route::put('/password', [UserController::class, 'password_update'])->name('password.update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});