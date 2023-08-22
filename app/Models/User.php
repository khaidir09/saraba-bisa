<?php

namespace App\Models;

use App\Models\Worker;
use App\Models\WorkerUser;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'alamat',
        'role',
        'types_id',
        'nomor_hp',
        'nik',
        'persen',
        'owner',
        'kota',
        'nama_toko',
        'deskripsi_toko',
        'alamat_toko',
        'nomor_hp_toko',
        'bank',
        'rekening',
        'pemilik_rekening',
        'profile_photo_path',
        'workers_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // protected $appends = [
    //     'profile_photo_url',
    // ];

    public function type()
    {
        return $this->belongsTo(
            Type::class,
            'types_id',
            'id'
        );
    }

    public function servicetransaction()
    {
        $currentMonth = now()->month;

        return $this->hasMany(ServiceTransaction::class, 'users_id', 'id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }

    public function relasiService()
    {
        return $this->hasMany(ServiceTransaction::class, 'users_id', 'id');
    }

    public function sale()
    {
        $currentMonth = now()->month;

        return $this->hasMany(OrderDetail::class, 'users_id', 'id')
            ->whereMonth('created_at', $currentMonth);
    }

    public function relasiSale()
    {
        return $this->hasMany(OrderDetail::class, 'users_id', 'id');
    }

    public function incident()
    {
        return $this->hasMany(Incident::class, 'users_id', 'id');
    }

    public function expense()
    {
        return $this->hasMany(Expense::class, 'users_id', 'id');
    }

    public function salary()
    {
        return $this->hasMany(Salary::class, 'users_id', 'id');
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class, 'workers_id', 'id');
    }

    public function adminservice()
    {
        $currentMonth = now()->month;

        return $this->hasMany(ServiceTransaction::class, 'admin_id', 'id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }

    public function adminsale()
    {
        $currentMonth = now()->month;

        return $this->hasMany(OrderDetail::class, 'admin_id', 'id')
            ->whereMonth('created_at', $currentMonth);
    }
}
