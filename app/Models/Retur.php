<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    protected $fillable = [
        'reference_number',
        'suppliers_id',
        'suppliers_name',
        'keterangan',
        'products_id',
        'product_name',
        'quantity',
        'product_price',
        'total_price',
        'date'
    ];
}
