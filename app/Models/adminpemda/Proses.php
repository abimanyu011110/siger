<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Proses extends Model
{
    //
    protected $table = 'tbl_proses';
    public $timestamps = false;
    protected $fillable = ['nama_proses'];
}
