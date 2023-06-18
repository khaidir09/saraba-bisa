<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
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
