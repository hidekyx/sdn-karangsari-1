<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = "jadwal";
    protected $primaryKey = 'id_jadwal';
    public $timestamps = false;
    
    protected $fillable = [
        'id_user',
        'id_kelas',
        'id_pelajaran',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function pelajaran()
    {
        return $this->belongsTo(Pelajaran::class, 'id_pelajaran');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
