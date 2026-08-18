<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Product;

$makanan = [
    ['name' => 'French Fries', 'price' => 16000],
    ['name' => 'Otak-Otak', 'price' => 16000],
    ['name' => 'Nugget', 'price' => 16000],
    ['name' => 'Mix Platter', 'price' => 23000],
    ['name' => 'Roti Bakar Coklat', 'price' => 13000],
    ['name' => 'Roti Bakar Keju', 'price' => 13000],
    ['name' => 'Roti Bakar Kacang', 'price' => 13000],
    ['name' => 'Roti Bakar Strawberry', 'price' => 13000],
    ['name' => 'Roti Bakar Nanas', 'price' => 13000],
];

$codeIndex = 1;
foreach ($makanan as $m) {
    $code = 'MKN' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    while(Product::where('kode_produk', $code)->exists()) {
        $code = 'MKN' . str_pad($codeIndex++, 3, '0', STR_PAD_LEFT);
    }
    Product::updateOrCreate(
        ['nama_produk' => $m['name']],
        [
            'kode_produk' => $code,
            'harga_beli' => $m['price'] * 0.5,
            'harga_jual' => $m['price'],
            'stok' => 50,
            'kategori' => 'makanan'
        ]
    );
}

echo "Makanan inserted successfully.\n";
