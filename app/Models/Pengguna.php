<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengguna extends Model
{
    use SoftDeletes;

    protected $table = 'users';
    protected $fillable = ['id','nama','nama_user','alamat','telp','isactive','id_jenispengguna']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    function jenispengguna() {
        return $this->belongsTo(jenispengguna::class, 'id_jenispengguna', 'id');
    }
}
