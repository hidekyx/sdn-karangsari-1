<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = "absensi";
    protected $primaryKey = 'id_absensi';
    
    protected $fillable = [
        'id_user',
        'id_kelas',
        'id_pelajaran',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function detail()
    {
        return $this->hasMany(DetailAbsensi::class, 'id_absensi');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'id_pelajaran');
    }
}
