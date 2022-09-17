<?php

namespace App\Models;

use App\Models\Univ;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = "users";

    protected $fillable = [
        'name',
        'role',
        'nim',
        'picture',
        'univ_id',
        'prodi_id',
        'info_login',
        'email',
        'password',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Univ()
    {
        return $this->belongsTo(Univ::class);
    }

    public function Prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function Administrasi()
    {
        return $this->hasMany(Administrasi::class);
    }

    public function Periode()
    {
        return $this->HasManyThrough(Periode::class, Administrasi::class);
    }


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                    ->orWhere('role', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $search . '%')
                    ->orWhereHas('univ', function ($q) use ($search) {
                        return $q->where('nama_universitas', 'LIKE', '%' . $search . '%');
                    })->orWhereHas('prodi', function ($q) use ($search) {
                        return $q->where('nama_prodi', 'LIKE', '%' . $search . '%');
                    });
            });
        });
    }
}
