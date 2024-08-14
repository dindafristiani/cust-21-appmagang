<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    use HasFactory;

    protected $table='mitra';

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
    public function magangs()
    {
        return $this->hasMany(Magang::class, 'id_mitra', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
