<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = "kelas";
    protected $primaryKey = 'id_kelas';
    public $timestamps = false;
    
    protected $fillable = [
        'nama_kelas',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas', 'id_kelas');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

}
