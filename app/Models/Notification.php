<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifikasi';

    public $userId = null;

    protected $fillable = ['id', 'id_user', 'judul', 'deskripsi', 'dibaca', 'dilihat', 'type']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';

    public function getIsReadAttribute()
    {

    }

}
