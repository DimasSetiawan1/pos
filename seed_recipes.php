<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;
use App\Models\BahanBaku;

echo "Seeding Bahan Baku & Recipes...\n";

// Definisi bahan baku dasar
$bahanBakus = [
    'BB001' => ['nama' => 'Biji Kopi Espresso', 'satuan' => 'gram', 'harga' => 200, 'stok' => 5000],
    'BB002' => ['nama' => 'Susu Segar', 'satuan' => 'ml', 'harga' => 15, 'stok' => 10000],
    'BB003' => ['nama' => 'Gula Aren', 'satuan' => 'ml', 'harga' => 20, 'stok' => 5000],
    'BB004' => ['nama' => 'Sirup Caramel', 'satuan' => 'ml', 'harga' => 30, 'stok' => 2000],
    'BB005' => ['nama' => 'Sirup Vanilla', 'satuan' => 'ml', 'harga' => 30, 'stok' => 2000],
    'BB006' => ['nama' => 'Sirup Butterscotch', 'satuan' => 'ml', 'harga' => 35, 'stok' => 2000],
    'BB007' => ['nama' => 'Bubuk Coklat', 'satuan' => 'gram', 'harga' => 100, 'stok' => 3000],
    'BB008' => ['nama' => 'Bubuk Matcha', 'satuan' => 'gram', 'harga' => 150, 'stok' => 3000],
    'BB009' => ['nama' => 'Bubuk Taro', 'satuan' => 'gram', 'harga' => 120, 'stok' => 3000],
    'BB010' => ['nama' => 'Bubuk Red Velvet', 'satuan' => 'gram', 'harga' => 120, 'stok' => 3000],
    'BB011' => ['nama' => 'Teh Hitam', 'satuan' => 'gram', 'harga' => 50, 'stok' => 2000],
    'BB012' => ['nama' => 'Sirup Lychee', 'satuan' => 'ml', 'harga' => 25, 'stok' => 2000],
    'BB013' => ['nama' => 'Sirup Lemon', 'satuan' => 'ml', 'harga' => 25, 'stok' => 2000],
    'BB014' => ['nama' => 'Es Batu', 'satuan' => 'porsi', 'harga' => 500, 'stok' => 1000],
];

// Insert/Update Bahan Baku
$bahanBakuModels = [];
foreach ($bahanBakus as $kode => $data) {
    $bahanBakuModels[$kode] = BahanBaku::updateOrCreate(
        ['kode_bahan' => $kode],
        [
            'nama_bahan' => $data['nama'],
            'satuan' => $data['satuan'],
            'harga' => $data['harga'],
            'stok' => $data['stok'],
        ]
    );
}

// Map menu to ingredients
$products = Product::all();
foreach ($products as $product) {
    $ingredients = [];
    $name = strtolower($product->nama_produk);
    
    // Semua yang pakai es
    if (strpos($name, 'ice') !== false) {
        $ingredients[$bahanBakuModels['BB014']->id] = ['jumlah' => 1]; // 1 porsi es batu
    }

    // Kopi / Espresso (Americano, Latte, dll)
    if (strpos($name, 'americano') !== false || strpos($name, 'latte') !== false || strpos($name, 'kopi') !== false || strpos($name, 'machiato') !== false || strpos($name, 'cappuccino') !== false || strpos($name, 'mochacino') !== false) {
        $ingredients[$bahanBakuModels['BB001']->id] = ['jumlah' => 18]; // 18g espresso
    }

    if (strpos($name, 'add espresso') !== false) {
        $ingredients[$bahanBakuModels['BB001']->id] = ['jumlah' => 18];
    }

    // Susu (Latte, Cappuccino, dll)
    if (strpos($name, 'latte') !== false || strpos($name, 'kopi susu') !== false || strpos($name, 'cappuccino') !== false || strpos($name, 'machiato') !== false || strpos($name, 'taro') !== false || strpos($name, 'red velvet') !== false || strpos($name, 'chocolatte') !== false || strpos($name, 'matcha') !== false || strpos($name, 'mochacino') !== false) {
        $ingredients[$bahanBakuModels['BB002']->id] = ['jumlah' => 150]; // 150ml susu
    }

    // Sirup/Gula
    if (strpos($name, 'kopi susu') !== false) {
        $ingredients[$bahanBakuModels['BB003']->id] = ['jumlah' => 20]; // Gula aren
    }
    if (strpos($name, 'caramel') !== false) {
        $ingredients[$bahanBakuModels['BB004']->id] = ['jumlah' => 20]; // Caramel
    }
    if (strpos($name, 'vanilla') !== false) {
        $ingredients[$bahanBakuModels['BB005']->id] = ['jumlah' => 20]; // Vanilla
    }
    if (strpos($name, 'butterscotch') !== false) {
        $ingredients[$bahanBakuModels['BB006']->id] = ['jumlah' => 20]; // Butterscotch
    }

    // Non-Coffee Bubuk
    if (strpos($name, 'chocolatte') !== false || strpos($name, 'mochacino') !== false) {
        $ingredients[$bahanBakuModels['BB007']->id] = ['jumlah' => 20]; // Bubuk Coklat
    }
    if (strpos($name, 'matcha') !== false) {
        $ingredients[$bahanBakuModels['BB008']->id] = ['jumlah' => 20]; // Bubuk Matcha
    }
    if (strpos($name, 'taro') !== false) {
        $ingredients[$bahanBakuModels['BB009']->id] = ['jumlah' => 20]; // Bubuk Taro
    }
    if (strpos($name, 'red velvet') !== false) {
        $ingredients[$bahanBakuModels['BB010']->id] = ['jumlah' => 20]; // Bubuk Red Velvet
    }

    // Tea
    if (strpos($name, 'tea') !== false) {
        $ingredients[$bahanBakuModels['BB011']->id] = ['jumlah' => 10]; // Teh Hitam
    }
    if (strpos($name, 'lychee') !== false) {
        $ingredients[$bahanBakuModels['BB012']->id] = ['jumlah' => 30]; // Sirup Lychee
    }
    if (strpos($name, 'lemon') !== false || strpos($name, 'citrus') !== false) {
        $ingredients[$bahanBakuModels['BB013']->id] = ['jumlah' => 30]; // Sirup Lemon
    }

    // Sync relasi (akan menghapus yang lama dan memasukkan yang baru)
    if (!empty($ingredients)) {
        $product->bahanBakus()->sync($ingredients);
        echo "Resep diset untuk: " . $product->nama_produk . "\n";
    }
}

echo "Berhasil mengatur resep untuk semua menu!\n";
