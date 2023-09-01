<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'sub_categories_id',
        'category_name',
        'stok',
        'harga_modal',
        'harga_jual',
        'supplier',
        'keterangan',
        'nomor_seri',
        'garansi',
        'garansi_imei',
        'ppn'
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_categories_id', 'id');
    }

    public function relasiOrder()
    {
        return $this->hasMany(OrderDetail::class, 'products_id', 'id');
    }
}
