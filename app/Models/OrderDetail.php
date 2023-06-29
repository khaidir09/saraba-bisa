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
        'product_name',
        'quantity',
        'price',
        'total',
        'sub_total',
        'modal',
        'profit',
        'profit_toko',
        'persen_sales',
        'is_admin_toko',
        'persen_admin',
        'created_at',
        'updated_at'
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
