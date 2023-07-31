<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductUpdate extends Model
{
    protected $fillable = [
        'products_id',
        'product_name',
        'stok'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
