<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $table = "administrasis";

    protected $dates = [
        'tanggal_lahir',
        'jadwal_wwn',
        'email_sent_at',
        'adm_email_at',
    ];

    protected $guarded = [
        'id',
    ];

    public function Periode()
    {
        return $this->hasOne(Periode::class, 'id_periode', 'periode_id');
    }

    public function Wawancara()
    {
        return $this->hasOne(Wawancara::class, 'administrasi_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    return $q->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('users.id', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%')
                        ->orWhere('no_pendaftaran', 'LIKE', '%' . $search . '%')
                        ->orWhere('status_adm', 'LIKE', '%' . $search . '%')
                        ->orWhereHas('univ', function ($q) use ($search) {
                            return $q->where('nama_universitas', 'LIKE', '%' . $search . '%');
                        })->orWhereHas('prodi', function ($q) use ($search) {
                            return $q->where('nama_prodi', 'LIKE', '%' . $search . '%');
                        });
                });
            });
        });
    }
}
