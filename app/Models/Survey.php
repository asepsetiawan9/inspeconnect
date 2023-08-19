<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Survey extends Model
{
    protected $fillable = ['rating'];

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}