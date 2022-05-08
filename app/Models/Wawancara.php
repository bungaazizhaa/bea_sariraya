<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wawancara extends Model
{
    use HasFactory;

    public $table = "wawancaras";

    protected $dates = [
        'jadwal_wwn',
    ];

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->whereHas('administrasi', function ($q) use ($search) {
                    $q->where('no_pendaftaran', 'LIKE', '%' . $search . '%')->orWhereHas('user', function ($q) use ($search) {
                        return $q->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('users.id', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%')
                            ->orWhere('status_wwn', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('univ', function ($q) use ($search) {
                                return $q->where('nama_universitas', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('prodi', function ($q) use ($search) {
                                return $q->where('nama_prodi', 'LIKE', '%' . $search . '%');
                            });
                    });
                });
            });
        });
    }

    public function Administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'administrasi_id');
    }

    public function Penugasan()
    {
        return $this->hasOne(Penugasan::class, 'wawancara_id');
    }

    public function User()
    {
        return $this->hasOneThrough(User::class, Administrasi::class, 'id', 'id', 'administrasi_id', 'user_id');
    }
}
