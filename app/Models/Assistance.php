<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistance extends Model
{
    use HasFactory;

    protected $table = 'assistance';

    public $timestamps = false;

    public function assistDetails()
    {
        return $this->hasMany(AssistDetail::class, 'id_assistance', 'id');
    }

    public function poverty()
    {
        return $this->hasOne(Poverty::class, 'id', 'id_poverty');
    }

    public function poverties()
    {
        return $this->hasMany(Poverty::class,  'id', 'id_poverty');
    }


}
