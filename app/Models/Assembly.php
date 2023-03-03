<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assembly extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'item',
        'imei',
        'warna',
        'kapasitas',
        'biaya',
        'is_approve',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
