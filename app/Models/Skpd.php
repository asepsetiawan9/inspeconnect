<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    class Skpd extends Model
    {
        use HasFactory;
        
        protected $table = 'opd';

        protected $fillable = ['name', 'desc', 'alamat']; 

        public function schedules()
    {
        return $this->hasMany(Schedule::class, 'opd_id');
    }
        public function users()
        {
            return $this->hasMany(User::class, 'opd_id'); // Sesuaikan dengan nama kolom foreign key di tabel User
        }

    }

