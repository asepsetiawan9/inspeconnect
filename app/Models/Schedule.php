<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
    {
        use HasFactory;

        protected $table = 'schedules';

        protected $fillable = [
            'opd_id',
            'name',
            'phone',
            'date',
            'time',
            'about',
            'place',
            'status',
        ];

        public function skpd()
        {
            return $this->belongsTo(Skpd::class, 'opd_id');
        }

        public function consultant()
        {
            return $this->belongsTo(Consultant::class, 'consultant_id');
        }
    }
