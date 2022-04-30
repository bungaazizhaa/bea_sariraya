<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;

    public $table = "periodes";

    protected $dates = [
        'tm_adm',
        'ta_adm',
        'tp_adm',
        'tm_wwn',
        'ta_wwn',
        'tp_wwn',
        'tm_png',
        'ta_png',
        'tp_png',
    ];

    protected $guarded = [
        'id',
    ];


    public function Administrasi()
    {
        return $this->belongsTo(Administrasi::class, 'periode_id');
    }
}
