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
        $currentMonth = now()->month;

        return $this->hasMany(ServiceTransaction::class, 'types_id', 'id')
            ->where('status_servis', 'Sudah Diambil')
            ->whereMonth('tgl_ambil', $currentMonth);
    }
}
