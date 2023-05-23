<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poverty extends Model
{
    use HasFactory;
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'kecamatan',
        'tempat_lahir',
        'status',
        'kk',
        'jk',
        'rt',
        'rw',
        'desa',
        'tgl',
        'foto_diri',
        'status_pendidikan',
        'pekerjaan',
        'tempat_tinggal',
        'pendidikan_terakhir',
        'jenis_pekerjaan',
        'sumber_air_minum',
        'bahan_bakar_memasak',
        'foto_rumah',
        'desil',
        'penghasilan',
        'dtks',
        'penghasilan_perbulan',
        'bantuan_diterima',
        'tahun_input',
    ];
}
