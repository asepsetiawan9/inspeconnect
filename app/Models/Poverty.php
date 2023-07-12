<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poverty extends Model
{
    use HasFactory;
    protected $table = 'poverties';
    protected $fillable = [
        'nik',
        'nama',
        'alamat',
        'id_kecamatan',
        'tempat_lahir',
        'status',
        'kk',
        'jk',
        'rt',
        'rw',
        'id_desa',
        'tgl',
        'foto_diri',
        'status_pendidikan',
        'pekerjaan',
        'tempat_tinggal',
        'sumber_air_minum',
        'tahun_input',
        'sumber_penerangan_utama',
        'bab',
        'foto_rumah',
        'tinggi_pondasi_rumah',
        'jumlah_jiwa',
        'luas_ruangan',
        'kondisi_rumah',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class, 'id_kecamatan', 'id');
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class, 'id_desa', 'id');
    }

    public function assistance()
    {
        return $this->hasOne(Assistance::class, 'id_poverty', 'id');
    }

}
