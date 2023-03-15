<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SparepartTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'users_id',
        'customers_id',
        'spareparts_id',
        'nomor_transaksi',
        'quantity',
        'harga',
        'modal',
        'is_approve',
        'diskon',
        'cara_pembayaran',
        'garansi',
        'exp_garansi',
        'is_admin_toko',
        'omzet',
        'profit',
        'profittoko',
        'persen_admin',
        'persen_sales',
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
