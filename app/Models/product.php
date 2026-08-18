<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga_beli',
        'harga_jual',
        'stok',
        'kategori'
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function bahanBakus()
    {
        return $this->belongsToMany(BahanBaku::class, 'product_bahan_bakus')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
}