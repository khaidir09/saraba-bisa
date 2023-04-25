<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccessoryTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customers_id',
        'accessories_id',
        'nomor_transaksi',
        'quantity',
        'harga',
        'modal',
        'garansi',
        'exp_garansi',
        'diskon',
        'created_at',
        'cara_pembayaran',
        'omzet',
        'profit'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customers_id', 'id');
    }

    public function accessory()
    {
        return $this->belongsTo(Accessory::class, 'accessories_id', 'id');
    }
}
