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

    public function Periode()
    {
        return $this->hasMany(Periode::class);
    }

    public function Wawancara()
    {
        return $this->belongsTo(Wawancara::class, 'wawancara_id');
    }

    public function User()
    {
        return $this->hasOne(User::class, 'id');
    }
}
