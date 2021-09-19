<?php

namespace App\Models;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class perbedaan extends Model
{
    use SoftDeletes;
    protected $table = 'bedakan_konten';

    protected $fillable = ['id','judul','deskripsi','attachment1','attachment2','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    function pengguna() {
        return $this->belongsTo(Pengguna::class, 'id_pengirim', 'id');
    }
}




