<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
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
