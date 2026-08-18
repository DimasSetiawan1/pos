<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::create([
            'kode_produk' => 'PR001',
            'nama_produk' => 'Es Kopi Susu',
            'harga_beli' => 10000,
            'harga_jual' => 18000,
            'stok' => 100,
            'kategori' => 'minuman'
        ]);

        Product::create([
            'kode_produk' => 'PR002',
            'nama_produk' => 'Americano',
            'harga_beli' => 8000,
            'harga_jual' => 15000,
            'stok' => 100,
            'kategori' => 'minuman'
        ]);

        Product::create([
            'kode_produk' => 'PR003',
            'nama_produk' => 'Cappuccino',
            'harga_beli' => 12000,
            'harga_jual' => 22000,
            'stok' => 100,
            'kategori' => 'minuman'
        ]);

        Product::create([
            'kode_produk' => 'PR004',
            'nama_produk' => 'Roti Bakar Cokelat',
            'harga_beli' => 8000,
            'harga_jual' => 15000,
            'stok' => 50,
            'kategori' => 'makanan'
        ]);

        Product::create([
            'kode_produk' => 'PR005',
            'nama_produk' => 'Kentang Goreng',
            'harga_beli' => 7000,
            'harga_jual' => 12000,
            'stok' => 60,
            'kategori' => 'makanan'
        ]);

        Product::create([
            'kode_produk' => 'PR006',
            'nama_produk' => 'Nasi Goreng Spesial',
            'harga_beli' => 12000,
            'harga_jual' => 20000,
            'stok' => 40,
            'kategori' => 'makanan'
        ]);
    }
}