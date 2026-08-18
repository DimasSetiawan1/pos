<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice',
        'kasir_id',
        'total',
        'bayar',
        'kembali',
        'metode_pembayaran'
    ];

    public function kasir()
    {
        return $this->belongsTo(User::class,'kasir_id');
    }

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}