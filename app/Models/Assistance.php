<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;

    protected $table = 'assistance';
    public $timestamps = false;

    // Relasi dengan model Kecamatan
    // public function kecamatan()
    // {
    //     return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id_kecamatan');
    // }
}
