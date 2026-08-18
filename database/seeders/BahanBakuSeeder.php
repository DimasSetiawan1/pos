<?php

namespace Database\Seeders;

use App\Models\BahanBaku;
use Illuminate\Database\Seeder;

class BahanBakuSeeder extends Seeder
{
    public function run(): void
    {
        BahanBaku::create([
            'kode_bahan' => 'BB001',
            'nama_bahan' => 'Biji Kopi Arabica',
            'satuan' => 'Kg',
            'stok' => 50
        ]);

        BahanBaku::create([
            'kode_bahan' => 'BB002',
            'nama_bahan' => 'Susu Fresh Milk',
            'satuan' => 'Liter',
            'stok' => 30
        ]);

        BahanBaku::create([
            'kode_bahan' => 'BB003',
            'nama_bahan' => 'Gula Aren',
            'satuan' => 'Kg',
            'stok' => 20
        ]);
    }
}