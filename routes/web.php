<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StockTransactionController;

// Rute Autentikasi (Publik)
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Memerlukan Login (Admin & Staff)
Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Menu Transaksi Mutasi Stok (Dapat diakses Admin & Staff)
    Route::get('/transactions', [StockTransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/create', [StockTransactionController::class, 'create'])->name('transactions.create');
    Route::post('/transactions', [StockTransactionController::class, 'store'])->name('transactions.store');

    // Menu Produk (Melihat dan Menambah Produk)
    Route::resource('products', ProductController::class)->except(['destroy']);

    // Khusus Admin: Menghapus Produk
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
        ->middleware('role:admin')
        ->name('products.destroy');
});