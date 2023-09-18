<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelajaran extends Model
{
    protected $table = "pelajaran";
    protected $primaryKey = 'id_pelajaran';
    public $timestamps = false;
    
    protected $fillable = [
        'nama_pelajaran',
    ];
}
