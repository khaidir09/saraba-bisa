<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
        'owner',
        'nama_toko',
        'deskripsi_toko',
        'alamat_toko',
        'nomor_hp_toko',
        'link_toko',
        'bank',
        'rekening',
        'pemilik_rekening',
        'is_tax',
        'ppn',
    ];
}
