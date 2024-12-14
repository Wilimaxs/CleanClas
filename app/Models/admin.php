<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Admin extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    protected $fillable = ['nip', 'nama', 'tlp', 'alamat' , 'pass'];
    protected $primaryKey = 'nip';

    protected $keyType = 'bigint'; // Jika nip adalah string, jika numeric gunakan 'int'
    
    public $incrementing = false;
    protected $guarded = ['nip'];

    protected $hidden = [
        'pass', 'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'nip'; // sesuaikan dengan nama primary key
    }

    public function getAuthIdentifier()
    {
        return $this->getAttribute($this->getAuthIdentifierName());
    }

    public function getAuthPassword()
    {
        return $this->pass; // sesuaikan dengan nama atribut password
    }
}
