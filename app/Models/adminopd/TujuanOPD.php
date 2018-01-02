<?php

namespace App\Models\adminopd;

use Illuminate\Database\Eloquent\Model;

class TujuanOPD extends Model
{
    //
    protected $table = 'tujuan_opd';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'misi_id', 'nama_tujuan'];
}
