<?php

namespace App\Models;

use App\Models\ServiceTransaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Capacity extends Model
{
    protected $fillable = [
        'name'
    ];

    public function relasiService()
    {
        return $this->hasMany(ServiceTransaction::class, 'capacities_id', 'id');
    }
}
