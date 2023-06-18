<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'categories_id',
        'stok',
        'harga_modal',
        'harga_toko',
        'harga_pelanggan',
        'supplier',
        'keterangan',
        'nomor_seri'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id', 'id');
    }

    public function order()
    {
        $currentMonth = now()->month;

        return $this->hasMany(OrderDetail::class, 'products_id', 'id')
            ->whereMonth('created_at', $currentMonth);
    }
}
