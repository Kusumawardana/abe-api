<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class dibagikan extends Model
{
    use SoftDeletes;
    protected $table = 'flashcard_dibagikan';

    protected $fillable = ['id','id_flashcard','id_pengirim','id_penerima']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    function flashcard() {
        return $this->belongsTo(flashcard::class, 'id_flashcard', 'id');
    }
    function pengirim() {
        return $this->belongsTo(Pengguna::class, 'id_pengirim', 'id');
    }
    function penerima() {
        return $this->belongsTo(Pengguna::class, 'id_penerima', 'id');
    }
}
