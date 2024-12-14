<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    use HasFactory;
 
    protected $fillable = ['id_jadwal', 'nis', 'hari'];
    protected $primaryKey = 'id_jadwal';

    protected $keyType = 'int'; // Jika nip adalah string, jika numeric gunakan 'int'
    
    public $incrementing = false;

}
