<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Accessory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'stok',
        'modal',
        'harga_toko',
        'harga_pelanggan',
        'supplier',
    ];
}
