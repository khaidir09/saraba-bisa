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
            ->where('status_servis', 'Sudah Diambil')
            ->whereMonth('tgl_ambil', '=', date("m", strtotime(now())));
    }
}
