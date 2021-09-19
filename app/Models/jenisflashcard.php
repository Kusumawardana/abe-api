<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jenisflashcard extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_flashcard';

    protected $fillable = ['id','nama','deskripsi']; //whitelist == yang diperbolehkan
    protected $primaryKey = 'id';
    protected $dates = ['deleted_at'];
}
