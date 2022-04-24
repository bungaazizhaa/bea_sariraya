<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'no_pendaftaran',
    ];

    public function Periode()
    {
        return $this->hasMany(Periode::class);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
