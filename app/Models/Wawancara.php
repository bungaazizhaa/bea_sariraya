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

    public function Periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function Administrasi()
    {
        return $this->belongsTo(Administrasi::class);
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
