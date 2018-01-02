<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Urusan extends Model
{
    //
    protected $table = 'ref_urusan';
    public $timestamps = false;
    protected $fillable = ['nama_urusan'];
}
