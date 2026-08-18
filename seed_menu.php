<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$coffees = [
    ['name' => 'Americano Hot', 'price' => 15000],
    ['name' => 'Americano Ice', 'price' => 18000],
    ['name' => 'Kopi Susu Barat Hot', 'price' => 16000],
    ['name' => 'Kopi Susu Barat Ice', 'price' => 18000],
    ['name' => 'Caramel Machiato Hot', 'price' => 20000],
    ['name' => 'Caramel Machiato Ice', 'price' => 23000],
    ['name' => 'Vanilla Latte Hot', 'price' => 20000],
    ['name' => 'Vanilla Latte Ice', 'price' => 23000],
    ['name' => 'Cafe Latte Hot', 'price' => 20000],
    ['name' => 'Cafe Latte Ice', 'price' => 23000],
    ['name' => 'Butterscotch Latte Hot', 'price' => 20000],
    ['name' => 'Butterscotch Latte Ice', 'price' => 23000],
    ['name' => 'Cappuccino Hot', 'price' => 20000],
    ['name' => 'Cappuccino Ice', 'price' => 23000],
    ['name' => 'Mochacino Hot', 'price' => 23000],
    ['name' => 'Mochacino Ice', 'price' => 25000],
    ['name' => 'Add Espresso', 'price' => 5000],
];

$nonCoffees = [
    ['name' => 'Chocolatte Hot', 'price' => 20000],
    ['name' => 'Chocolatte Ice', 'price' => 23000],
    ['name' => 'Matcha Latte Hot', 'price' => 20000],
    ['name' => 'Matcha Latte Ice', 'price' => 23000],
    ['name' => 'Taro Hot', 'price' => 20000],
    ['name' => 'Taro Ice', 'price' => 23000],
    ['name' => 'Red Velvet Hot', 'price' => 20000],
    ['name' => 'Red Velvet Ice', 'price' => 23000],
    ['name' => 'Lychee Tea Hot', 'price' => 20000],
    ['name' => 'Lychee Tea Ice', 'price' => 23000],
    ['name' => 'Lemon Tea Hot', 'price' => 15000],
    ['name' => 'Lemon Tea Ice', 'price' => 18000],
    ['name' => 'Black Tea Hot', 'price' => 15000],
    ['name' => 'Black Tea Ice', 'price' => 18000],
    ['name' => 'Lemon Squash Ice', 'price' => 20000],
    ['name' => 'Citrus Mint Ice', 'price' => 23000],
];

$codeIndex = 1;
foreach ($coffees as $c) {
    $code = 'COF' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    while(Product::where('kode_produk', $code)->exists()) {
        $code = 'COF' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    }
    Product::updateOrCreate(
        ['nama_produk' => $c['name']],
        [
            'kode_produk' => $code,
            'harga_beli' => $c['price'] * 0.5,
            'harga_jual' => $c['price'],
            'stok' => 50,
            'kategori' => 'minuman_coffee'
        ]
    );
}

$codeIndex = 1;
foreach ($nonCoffees as $c) {
    $code = 'NCF' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    while(Product::where('kode_produk', $code)->exists()) {
        $code = 'NCF' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    }
    Product::updateOrCreate(
        ['nama_produk' => $c['name']],
        [
            'kode_produk' => $code,
            'harga_beli' => $c['price'] * 0.5,
            'harga_jual' => $c['price'],
            'stok' => 50,
            'kategori' => 'minuman_non_coffee'
        ]
    );
}

echo "Menu inserted successfully.\n";
