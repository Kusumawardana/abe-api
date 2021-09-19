<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenispengguna extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_pengguna';

    protected $fillable = ['id','nama']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
