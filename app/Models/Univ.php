<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Univ extends Model
{
    use HasFactory;

    public $table = "univs";

    protected $fillable = [
        'nama_universitas',
    ];

    public function User()
    {
        return $this->hasMany(User::class, 'univ_id');
    }
}
