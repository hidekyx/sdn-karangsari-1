<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = "siswa";
    protected $primaryKey = 'id_siswa';
    public $timestamps = false;
    
    protected $fillable = [
        'id_kelas',
        'nama_siswa',
        'alamat_siswa',
        'tanggal_lahir',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
