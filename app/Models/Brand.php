<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'name'
    ];

    public function modelserie()
    {
        return $this->hasMany(ModelSerie::class, 'brands_id', 'id');
    }

    public function relasiService()
    {
        return $this->hasMany(ServiceTransaction::class, 'brands_id', 'id');
    }
}
