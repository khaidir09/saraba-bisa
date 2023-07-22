<?php

namespace App\Models;

use App\Models\ServiceTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ModelSerie extends Model
{
    protected $fillable = [
        'name',
        'brands_id'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id', 'id');
    }

    public function relasiService()
    {
        return $this->hasMany(ServiceTransaction::class, 'model_series_id', 'id');
    }
}
