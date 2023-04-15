<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Phone extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'brands_id',
        'model_series_id',
        'stok',
        'modal',
        'harga_toko',
        'harga_pelanggan',
        'supplier',
        'imei',
        'warna',
        'kapasitas',
        'ram',
        'keterangan',
        'kelengkapan',
        'kondisi'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands_id', 'id');
    }

    public function modelserie()
    {
        return $this->belongsTo(ModelSerie::class, 'model_series_id', 'id');
    }
}
