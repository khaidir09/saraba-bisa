<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderDetail extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'orders_id',
        'products_id',
        'quantity',
        'price',
        'total',
        'sub_total',
        'modal',
        'profit',
        'created_at',
        'updated_at',
        'product_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
