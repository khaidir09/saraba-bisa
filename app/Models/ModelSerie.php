<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
