<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BahanBaku extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_bahan',
        'nama_bahan',
        'satuan',
        'harga',
        'stok'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_bahan_bakus')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}