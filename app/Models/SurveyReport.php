<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class SurveyReport extends Model
{
    protected $table = 'surveys_report';
    protected $fillable = ['rating'];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}