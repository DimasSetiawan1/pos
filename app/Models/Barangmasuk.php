<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BarangMasuk extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'tanggal',
        'total_item',
        'keterangan'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}