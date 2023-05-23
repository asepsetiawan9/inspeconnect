<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Population extends Model
{
    use HasFactory;
    protected $fillable = [
        'jumlah_penduduk',
        'jumlah_kk',
        'jumlah_laki_laki',
        'jumlah_perempuan',
        'tahun',
    ];
}
