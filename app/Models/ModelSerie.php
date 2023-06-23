<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSerie extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'brands_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id', 'id');
    }
}
