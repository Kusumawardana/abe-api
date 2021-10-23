<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifikasi';

    protected $fillable = ['id','id_user','judul','deskripsi','dibaca','dilihat']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

}
