<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'desc',
        'photo',
        'user_id',
        'role',
        'status',
        'pertemuan',
        'kontak',
        'datetime',
        'tempat_bertemu',
        'survey_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function survey()
    {
        return $this->hasOne(SurveyReport::class);
    }

}
