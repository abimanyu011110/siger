<?php

namespace App\Models\adminopd;

use Illuminate\Database\Eloquent\Model;

class SasaranOPD extends Model
{
    //
    protected $table = 'sasaran_opd';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'tujuan_id', 'nama_sasaran'];
}
