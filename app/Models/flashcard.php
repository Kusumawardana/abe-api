<?php

namespace App\Models;

use App\jenisflashcard;
use App\pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class flashcard extends Model
{
    use SoftDeletes;
    protected $table = 'flashcard';

    protected $fillable = ['id','judul','deskripsi','id_jenis','attachment','status','id_user']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    function jenisflashcard() {
        return $this->belongsTo(jenisflashcard::class, 'id_jenis', 'id');
    }
    function pengguna() {
        return $this->belongsTo(pengguna::class, 'id_user', 'id');
    }
}
