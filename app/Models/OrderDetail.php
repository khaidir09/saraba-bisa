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
        'users_id',
        'quantity',
        'price',
        'total',
        'sub_total',
        'modal',
        'profit',
        'profit_toko',
        'persen_sales',
        'created_at',
        'updated_at',
        'product_name'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
