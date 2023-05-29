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
        'nomor_hp',
        'nik',
        'persen',
        'owner',
        'kota',
        'nama_toko',
        'deskripsi_toko',
        'alamat_toko',
        'nomor_hp_toko',
        'syarat_ketentuan_toko',
        'bank',
        'rekening',
        'pemilik_rekening',
        'profile_photo_path'
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

    public function servicetransaction()
    {
        $currentMonth = now()->month;

        return $this->hasMany(ServiceTransaction::class, 'users_id', 'id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }

    public function accessorytransaction()
    {
        $currentMonth = now()->month;

        return $this->hasMany(AccessoryTransaction::class, 'users_id', 'id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }

    public function phonetransaction()
    {
        return $this->hasMany(PhoneTransaction::class, 'users_id', 'id')
            ->where('is_approve', 'Setuju')
            ->whereMonth('tgl_disetujui', $currentMonth);
    }
}
