<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class respon extends Model
{
    protected $table = 'respon_perkembangan';

    protected $fillable = ['id','id_perkembangan','id_terapis','id_orang_tua','deskripsi']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    function orangtua() {
        return $this->belongsTo(orangtua::class, 'id_orang_tua', 'id');
    }
    function terapis() {
        return $this->belongsTo(terapis::class, 'id_terapis', 'id');
    }
    function perkembangan() {
        return $this->belongsTo(perkembangan::class, 'id_perkembangan', 'id');
    }
}
