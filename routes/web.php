<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\SalaController;
use App\Http\Controllers\ReservaController;

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/dash', [DashController::class, 'index'])->name('dash');
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::resource('reservas', ReservaController::class);

    Route::group(['middleware' => ['role:A']], function () {
        Route::resource('salas', SalaController::class);
        Route::get('/salas/{id}/reservas', [SalaController::class, 'reservasPorSala'])->name('sala.reservas');
    });

});