<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murids';

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function magang()
    {
        return $this->hasOne(Magang::class, 'id_siswa', 'id');
    }
}
