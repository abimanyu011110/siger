<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    //
    protected $table = 'tbl_opd';
    public $timestamps = false;
    protected $fillable = ['urusan_id', 'bidang_id', 'nama_opd', 'alamat', 'kepala_daerah', 'jabatan'];
}
