<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\AdminTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\MenuController;

// Auth routes (guest)
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/dashboard-admin', [DashboardController::class, 'admin']);


    // Supplier & Barang Masuk
    Route::get('/admin/suplier-barang-masuk', [BarangMasukController::class, 'index']);
    Route::post('/admin/supplier', [SupplierController::class, 'store']);
    Route::put('/admin/supplier/{id}', [SupplierController::class, 'update']);
    Route::delete('/admin/supplier/{id}', [SupplierController::class, 'destroy']);

    Route::post('/admin/barang-masuk', [BarangMasukController::class, 'store']);
    Route::delete('/admin/barang-masuk/{id}', [BarangMasukController::class, 'destroy']);

    // Bahan Baku
    Route::get('/admin/bahan-baku', [BahanBakuController::class, 'index']);
    Route::post('/admin/bahan-baku', [BahanBakuController::class, 'store']);
    Route::put('/admin/bahan-baku/{id}', [BahanBakuController::class, 'update']);
    Route::delete('/admin/bahan-baku/{id}', [BahanBakuController::class, 'destroy']);

    // Laporan Transaksi
    Route::get('/admin/transaksi', [AdminTransaksiController::class, 'index']);
    
    // Detail Laporan Dashboard
    Route::get('/admin/laporan/{type}', [\App\Http\Controllers\ReportController::class, 'index']);
});

// Kasir routes (Bisa diakses Kasir dan Admin)
Route::middleware(['auth', 'role:kasir,admin'])->group(function () {

    Route::get('/dashboard-kasir', [DashboardController::class, 'kasir']);

    Route::get('/menu-makanan', [MenuController::class, 'makanan']);
    Route::get('/menu-minuman', [MenuController::class, 'minuman']);

    // Produk (Digunakan oleh Menu Makanan & Minuman)
    Route::post('/produk', [ProdukController::class, 'store']);
    Route::put('/produk/{id}', [ProdukController::class, 'update']);
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy']);

    Route::get('/kasir/transaksi', [TransaksiController::class, 'index']);
    Route::post('/kasir/transaksi', [TransaksiController::class, 'store']);
    Route::get('/kasir/transaksi/{id}/print', [TransaksiController::class, 'print'])->name('transaksi.print');
});