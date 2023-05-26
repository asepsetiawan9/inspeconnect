<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';
    public $timestamps = false;
    public function poverty()
    {
        return $this->hasMany(Property::class, 'id_kecamatan', 'id_kecamatan');
    }

    // Relasi dengan tabel Desa
    // public function desa()
    // {
    //     return $this->hasMany(Desa::class, 'id_kecamatan', 'id_kecamatan');
    // }
    public function desa()
    {
        return $this->hasMany(Desa::class, 'id_kecamatan');
    }
}
