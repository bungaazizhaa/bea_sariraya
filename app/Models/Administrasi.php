<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrasi extends Model
{
    use HasFactory;

    public $table = "administrasis";

    protected $dates = [
        'tanggal_lahir',
    ];

    protected $guarded = [
        'id',
    ];

    public function Periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function Wawancara()
    {
        return $this->hasOne(Wawancara::class, 'administrasi_id');
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
