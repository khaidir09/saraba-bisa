<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneTransaction extends Model
{
    protected $fillable = [
        'customers_id',
        'phones_id',
        'nomor_transaksi',
        'quantity',
        'qc',
        'harga',
        'modal',
        'diskon',
        'created_at',
        'cara_pembayaran',
        'garansi',
        'garansi_imei',
        'exp_garansi',
        'exp_imei',
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

    public function phone()
    {
        return $this->belongsTo(Phone::class, 'phones_id', 'id');
    }
}
