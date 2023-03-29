<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhoneTransaction extends Model
{
    protected $fillable = [
        'users_id',
        'customers_id',
        'phones_id',
        'nomor_transaksi',
        'quantity',
        'qc',
        'harga',
        'modal',
        'is_approve',
        'tgl_disetujui',
        'diskon',
        'created_at',
        'cara_pembayaran',
        'garansi',
        'garansi_imei',
        'exp_garansi',
        'exp_imei',
        'is_admin_toko',
        'omzet',
        'profit',
        'profittoko',
        'persen_admin',
        'persen_sales'
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
