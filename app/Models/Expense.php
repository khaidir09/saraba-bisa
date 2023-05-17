<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Expense extends Model
{

    protected $fillable = [
        'name',
        'price',
        'users_id',
        'pengeluaran_teknisi',
        'is_approve',
        'tgl_disetujui'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
