<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name'
    ];

    public function product()
    {
        $currentMonth = now()->month;

        return $this->hasMany(Product::class, 'categories_id', 'id')
            ->whereMonth('created_at', $currentMonth);
    }

    // make this category connected to order detail with product model
    public function order()
    {
        $currentMonth = now()->month;

        return $this->hasManyThrough(OrderDetail::class, Product::class, 'categories_id', 'products_id', 'id', 'id')
            ->whereMonth('order_details.created_at', $currentMonth);
    }

    public function relasiProduct()
    {
        return $this->hasMany(Product::class, 'categories_id', 'id');
    }
}
