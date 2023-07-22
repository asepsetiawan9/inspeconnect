<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $table = 'opd';
    protected $fillable = ['name', 'desc', 'alamat']; 

    public function users()
    {
        return $this->hasMany(User::class, 'opd_id'); // Sesuaikan dengan nama kolom foreign key di tabel User
    }
}
