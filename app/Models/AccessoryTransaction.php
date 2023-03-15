<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccessoryTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'customers_id',
        'accessories_id',
        'nomor_transaksi',
        'quantity',
        'harga',
        'modal',
        'garansi',
        'exp_garansi',
        'is_approve',
        'diskon',
        'created_at',
        'cara_pembayaran',
        'is_admin_toko',
        'persen_admin',
        'persen_sales',
        'omzet',
        'profit',
        'profittoko'
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
