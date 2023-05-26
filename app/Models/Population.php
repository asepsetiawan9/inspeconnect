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
        'garut_kota',
        'karangpawitan',
        'wanaraja',
        'tarogong_kaler',
        'tarogong_kidul',
        'banyuresmi',
        'samarang',
        'pasirwangi',
        'leles',
        'kadungora',
        'leuwigoong',
        'cibatu',
        'kersamanah',
        'malangbong',
        'sukawening',
        'karangtengah',
        'bayongbong',
        'cigedug',
        'cilawu',
        'cisurupan',
        'sukaresmi',
        'cikajang',
        'banjarwangi',
        'singajaya',
        'cihurip',
        'peundeuy',
        'pameungpeuk',
        'cisompet',
        'cibalong',
        'cikelet',
        'bungbulang',
        'mekarmukti',
        'pakenjeng',
        'pamulihan',
        'cisewu',
        'caringin',
        'talegong',
        'balubur_limbangan',
        'selaawi',
        'cibiuk',
        'pangatikan',
        'sucinaraja',
    ];
}
