<?php

use App\Models\BahanBaku;
use App\Models\Product;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// 1. Buat Bahan Baku Makanan
$bahanMakanan = [
    ['nama_bahan' => 'Roti Tawar', 'satuan' => 'Lembar'],
    ['nama_bahan' => 'Coklat Meises', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Keju Cheddar', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Selai Kacang', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Selai Strawberry', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Selai Nanas', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Kentang Beku', 'satuan' => 'Gram'],
    ['nama_bahan' => 'Nasi Putih', 'satuan' => 'Porsi'],
    ['nama_bahan' => 'Bumbu Nasi Goreng', 'satuan' => 'Porsi'],
    ['nama_bahan' => 'Telur', 'satuan' => 'Butir'],
    ['nama_bahan' => 'Otak-Otak Beku', 'satuan' => 'Pcs'],
    ['nama_bahan' => 'Nugget Beku', 'satuan' => 'Pcs'],
    ['nama_bahan' => 'Minyak Goreng', 'satuan' => 'ml'],
];

$bahanIds = [];
$latestCode = BahanBaku::max('kode_bahan');
$counter = $latestCode ? (int) substr($latestCode, 3) : 0;

foreach ($bahanMakanan as $b) {
    $counter++;
    $b['kode_bahan'] = 'BB-' . str_pad($counter, 3, '0', STR_PAD_LEFT);
    $bahan = BahanBaku::firstOrCreate(['nama_bahan' => $b['nama_bahan']], $b);
    $bahanIds[$b['nama_bahan']] = $bahan->id;
}

// 2. Hubungkan ke Resep Makanan
$recipes = [
    'Roti Bakar Cokelat' => [
        'Roti Tawar' => 2,
        'Coklat Meises' => 15
    ],
    'Roti Bakar Coklat' => [ // Handle possible typo from user's DB
        'Roti Tawar' => 2,
        'Coklat Meises' => 15
    ],
    'Roti Bakar Keju' => [
        'Roti Tawar' => 2,
        'Keju Cheddar' => 15
    ],
    'Roti Bakar Kacang' => [
        'Roti Tawar' => 2,
        'Selai Kacang' => 15
    ],
    'Roti Bakar Strawberry' => [
        'Roti Tawar' => 2,
        'Selai Strawberry' => 15
    ],
    'Roti Bakar Nanas' => [
        'Roti Tawar' => 2,
        'Selai Nanas' => 15
    ],
    'Kentang Goreng' => [
        'Kentang Beku' => 150,
        'Minyak Goreng' => 50
    ],
    'French Fries' => [
        'Kentang Beku' => 150,
        'Minyak Goreng' => 50
    ],
    'Nasi Goreng Spesial' => [
        'Nasi Putih' => 1,
        'Bumbu Nasi Goreng' => 1,
        'Telur' => 1,
        'Minyak Goreng' => 20
    ],
    'Otak-Otak' => [
        'Otak-Otak Beku' => 5,
        'Minyak Goreng' => 30
    ],
    'Nugget' => [
        'Nugget Beku' => 5,
        'Minyak Goreng' => 30
    ],
    'Mix Platter' => [
        'Kentang Beku' => 75,
        'Nugget Beku' => 3,
        'Otak-Otak Beku' => 3,
        'Minyak Goreng' => 70
    ]
];

foreach ($recipes as $productName => $ingredients) {
    $product = Product::where('nama_produk', $productName)->first();
    if ($product) {
        $syncData = [];
        foreach ($ingredients as $ingredientName => $qty) {
            $syncData[$bahanIds[$ingredientName]] = ['jumlah' => $qty];
        }
        $product->bahanBakus()->sync($syncData);
        echo "Resep untuk {$productName} berhasil ditambahkan!\n";
    }
}
echo "Selesai!\n";
