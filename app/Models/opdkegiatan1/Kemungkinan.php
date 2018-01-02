<?php

namespace App\Models\opdkegiatan1;

use Illuminate\Database\Eloquent\Model;

class Kemungkinan extends Model
{
    //
    protected $table = 'ref_kemungkinan';
    public $timestamps = false;
    protected $fillable = ['nilai', 'nama_kemungkinan'];
}
