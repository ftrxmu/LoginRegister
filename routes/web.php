<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;

Route::get('/register', [AuthController::class, 'viewregister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'viewlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
    Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
    Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');
    Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
});

Route::middleware(['auth', 'role:pengguna'])->group(function () {
    Route::get('/home', [BukuController::class, 'showBukuList'])->name('home');
});
