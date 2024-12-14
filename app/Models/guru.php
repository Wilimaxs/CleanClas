<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;

    protected $fillable = ['nip', 'nama', 'tlp', 'pass'];
    protected $primaryKey = 'nip';

    protected $keyType = 'string'; // Jika nip adalah string, jika numeric gunakan 'int'
    
    public $incrementing = false;

    public function siswas()
    {
        return $this->hasMany(Siswa::class, 'nip', 'nip'); // 'nip_guru' adalah foreign key di tabel siswas
    }

}
