<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = "user";
    protected $primaryKey = 'id_user';
    protected $hidden = ['password'];
    
    protected $fillable = [
        'email',
        'no_telp',
        'nama',
        'alamat',
        'password',
        'active',
        'role',
        'foto',
        'id_pelajaran',
    ];

    public function pelajaran()
    {
        return $this->hasOne(Pelajaran::class, 'id_pelajaran', 'id_pelajaran');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_user', 'id_user')->orderBy('hari', 'ASC')->orderBy('jam_mulai', 'ASC');
    }
}