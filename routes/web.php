<?php

use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeriodeController;

Route::group(['middleware' => 'guest'], function() {
    Route::get('/', [UserController::class, 'index'])->name('/');
    Route::post('/login', [UserController::class, 'login'])->name('login');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
    Route::get('/', fn() => view('admin.dashboard.index'))->name('dashboard.index');
    Route::resource('/periode', PeriodeController::class)->except('show');
    Route::resource('/alternatif', AlternatifController::class)->except('show');
    Route::resource('/kriteria', KriteriaController::class)->parameters(['kriteria' => 'kriteria'])->except('show');
    Route::get('/password', [UserController::class, 'password'])->name('password.index');
    Route::put('/password', [UserController::class, 'password_update'])->name('password.update');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});