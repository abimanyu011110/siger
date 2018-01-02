<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Sasaran extends Model
{
    //
    protected $table = 'sasaran_pemda';
    public $timestamps = false;
    protected $fillable = ['tujuan_id', 'nama_sasaran'];
}
