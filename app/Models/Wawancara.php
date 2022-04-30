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
        return $this->belongsTo(User::class);
    }
}
