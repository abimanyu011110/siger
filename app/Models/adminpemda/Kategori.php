<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
    protected $table = 'tbl_kategori';
    public $timestamps = false;
    protected $fillable = ['nama_kategori', 'selera_risiko'];
}
