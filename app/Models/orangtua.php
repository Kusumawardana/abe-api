<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orangtua extends Model
{
    protected $table = 'orangtua_anak';

    protected $fillable = ['id','nama','pekerjaan','agama','alamat','telp','kelamin']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
}
