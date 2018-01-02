<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Tujuan extends Model
{
    //
    protected $table = 'tujuan_pemda';
    public $timestamps = false;
    protected $fillable = ['misi_id', 'nama_tujuan'];
}
