<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengeluaranController;

// Public routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Protected routes
// Route::middleware('auth')->group(function () {
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/pengeluaran-index', [PengeluaranController::class, 'indexPengeluaran'])
    ->name('pengeluaran.index');
Route::post('/pengeluaran-store', [PengeluaranController::class, 'storePengeluaran'])
    ->name('pengeluaran.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });