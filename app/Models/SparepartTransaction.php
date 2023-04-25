<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SparepartTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customers_id',
        'spareparts_id',
        'nomor_transaksi',
        'quantity',
        'harga',
        'modal',
        'diskon',
        'cara_pembayaran',
        'garansi',
        'exp_garansi',
        'omzet',
        'profit',
        'created_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id', 'id');
    }

    public function sparepart()
    {
        return $this->belongsTo(Sparepart::class, 'spareparts_id', 'id');
    }
}
