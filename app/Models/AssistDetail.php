<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssistDetail extends Model
{
    use HasFactory;

    protected $table = 'assist_detail';
    protected $fillable = [
        'id_assistance',
        'nama_bantuan',
        'pemberi_bantuan',
        'bukti',
        'keterangan'
    ];


    public $timestamps = false;

    public function assistance()
    {
        return $this->belongsTo(Assistance::class, 'id_assistance', 'id');
    }
}
