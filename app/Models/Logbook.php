<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table ='logbook';

    protected $fillable = [
        'id_magang',
        'id_siswa',
        'tanggal',
        'catatan',
    ];

    public function magang()
    {
        return $this->belongsTo(Magang::class, 'id_magang');
    }

    public function siswa()
    {
        return $this->belongsTo(Murid::class, 'id_siswa');
    }
}
