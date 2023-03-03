<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accessory extends Model
{
    protected $fillable = [
        'name',
        'stok',
        'modal',
        'harga_toko',
        'harga_pelanggan',
        'supplier',
    ];
}
