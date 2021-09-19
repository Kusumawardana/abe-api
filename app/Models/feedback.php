<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class feedback extends Model
{

    protected $table = 'feedback';

    protected $fillable = ['id','judul','deskripsi']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    function pengguna() {
        return $this->belongsTo(pengguna::class, 'id_user', 'id');
    }
}
