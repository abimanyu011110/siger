<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    //
    protected $table = 'ref_bidang';
    public $timestamps = false;
    protected $fillable = ['urusan_id', 'nama_bidang'];
}
