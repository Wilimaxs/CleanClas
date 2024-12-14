<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kegiatan extends Model
{
    use HasFactory;

    protected $fillable = ['id_keg', 'nama_keg', 'deskripsi', 'tanggal', 'status', 'hari', 'image'];
    protected $primaryKey = 'id_keg';

    protected $keyType = 'int'; // Jika nip adalah string, jika numeric gunakan 'int'
    
    public $incrementing = false;

}
