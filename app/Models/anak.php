<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class anak extends Model
{
    use SoftDeletes;
    protected $table = 'anak';
    protected $fillable = ['id','nama_anak','kelamin','tempat_lahir','tanggal_lahir']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
