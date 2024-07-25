<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;
    protected $table='magang';
    protected $fillable = [
        'id_siswa', // existing fillable property
        'id_mitra',
        'periode_awal',
        'periode_akhir',
        'keterangan', // add the id_mitra property to fillable
        // add other properties as needed
    ];

    /**
     * Get the mitra that owns the magang.
     */
    public function mitra()
    {
        return $this->belongsTo(Mitra::class, 'id_mitra', 'id');
    }

    public function murid()
    {
        return $this->belongsTo(Murid::class, 'id_siswa', 'id');
    }
}
