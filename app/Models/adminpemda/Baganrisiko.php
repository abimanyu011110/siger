<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Baganrisiko extends Model
{
    //
    protected $table = 'tbl_baganrisiko';
    public $timestamps = false;
    protected $fillable = ['kategori_id', 'proses_id', 'nama_risiko'];
}
