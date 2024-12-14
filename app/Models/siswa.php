<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nis', 'nama', 'nip', 'id_kelas', 'pass', 'tlp', ];
    protected $primaryKey = 'nis';

    protected $keyType = 'bigint'; 
    
    public $incrementing = false;

}
