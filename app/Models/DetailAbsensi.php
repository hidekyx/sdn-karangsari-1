<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailAbsensi extends Model
{
    protected $table = "detail_absensi";
    protected $primaryKey = 'id_detail_absensi';
    public $timestamps = false;
    
    protected $fillable = [
        'id_absensi',
        'id_siswa',
        'status',
        'keterangan',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    
}
