<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'nama_supplier' => 'PT Kopi Nusantara',
            'alamat' => 'Bekasi',
            'telepon' => '081234567890'
        ]);

        Supplier::create([
            'nama_supplier' => 'PT Susu Segar Indonesia',
            'alamat' => 'Jakarta',
            'telepon' => '081234567891'
        ]);
    }
}