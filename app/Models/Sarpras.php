<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarpras extends Model
{
    protected $table = "sarpras";
    protected $primaryKey = 'id_sarpras';
    public $timestamps = false;
    
    protected $fillable = [
        'jenis_sarpras',
        'jumlah',
    ];
}
