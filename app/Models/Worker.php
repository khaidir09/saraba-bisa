<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Worker extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'jabatan',
        'status',
        'bulankerja',
        'gaji',
        'absen',
        'bpjs'
    ];

    // many to many
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    // one to many
    public function salary()
    {
        $currentMonth = now()->month;
        return $this->hasMany(Salary::class, 'workers_id')
            ->whereMonth('created_at', $currentMonth);
    }

    public function debt()
    {
        $currentMonth = now()->month;
        return $this->hasMany(Debt::class, 'workers_id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }

    public function relasiDebt()
    {
        return $this->hasMany(Debt::class, 'workers_id');
    }

    public function relasiSalary()
    {
        return $this->hasMany(Salary::class, 'workers_id');
    }
}
