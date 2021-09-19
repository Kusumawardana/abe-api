<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class auth extends Model
{
    protected $table = 'auth_token';

    protected $fillable = ['id','nama','token','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

}
