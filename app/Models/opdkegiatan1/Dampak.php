<?php

namespace App\Models\opdkegiatan1;

use Illuminate\Database\Eloquent\Model;

class Dampak extends Model
{
    //
    protected $table = 'ref_dampak';
    public $timestamps = false;
    protected $fillable = ['nilai', 'nama_dampak'];
}
