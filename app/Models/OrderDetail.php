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
        'product_name',
        'garansi',
        'garansi_imei'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id', 'id');
    }

    public function scopeTotalSales($query, $categories_id)
    {
        return $query->whereHas('product.subCategory.category', function ($q) use ($categories_id) {
            $q->where('categories_id', $categories_id);
        })->whereHas('order', function ($q) {
            $q->whereYear('created_at', now()->year)
                ->whereMonth('created_at', now()->month);
        })
            ->sum('profit');
    }
}
