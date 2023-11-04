<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'name'
    ];

    public function service()
    {
        return $this->hasMany(ServiceTransaction::class, 'types_id', 'id')
            ->whereYear('tgl_ambil', now()->year)
            ->whereMonth('tgl_ambil', now()->month)
            ->whereNot('is_approve', 'Ditolak');
    }

    public function relasiService()
    {
        return $this->hasMany(ServiceTransaction::class, 'types_id', 'id');
    }
}
