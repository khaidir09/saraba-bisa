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
        'ppn',
        'modal',
        'profit',
        'profit_toko',
        'persen_sales',
        'is_admin_toko',
        'admin_id',
        'persen_admin',
        'created_at',
        'updated_at',
        'garansi',
        'garansi_imei'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'orders_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }

    public function scopeTotalSales($query, $categories_id)
    {
        return $query->whereHas('product.subCategory.category', function ($q) use ($categories_id) {
            $q->where('categories_id', $categories_id);
        })->whereHas('order', function ($q) {
            $q->where('is_approve', 'Setuju')
                ->whereYear('tgl_disetujui', now()->year)
                ->whereMonth('tgl_disetujui', now()->month);
        })
            ->sum('profit_toko');
    }
}
