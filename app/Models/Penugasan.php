<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penugasan extends Model
{
    use HasFactory;

    public $table = "penugasans";

    protected $guarded = [
        'id',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->whereHas('wawancara', function ($q) use ($search) {
                    return $q->whereHas('user', function ($q) use ($search) {
                        return $q->where('name', 'LIKE', '%' . $search . '%')
                            ->orWhere('users.id', 'LIKE', '%' . $search . '%')
                            ->orWhere('email', 'LIKE', '%' . $search . '%')
                            ->orWhere('status_png', 'LIKE', '%' . $search . '%')
                            ->orWhereHas('univ', function ($q) use ($search) {
                                return $q->where('nama_universitas', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('prodi', function ($q) use ($search) {
                                return $q->where('nama_prodi', 'LIKE', '%' . $search . '%');
                            })->orWhereHas('administrasi', function ($q) use ($search) {
                                return $q->where('no_pendaftaran', 'LIKE', '%' . $search . '%');
                            });
                    });
                });
            });
        });
    }

    public function Periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function Wawancara()
    {
        return $this->belongsTo(Wawancara::class, 'wawancara_id');
    }
}
