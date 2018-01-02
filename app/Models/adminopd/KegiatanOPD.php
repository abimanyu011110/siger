<?php

namespace App\Models\adminopd;

use Illuminate\Database\Eloquent\Model;

class KegiatanOPD extends Model
{
    //
    protected $table = 'kegiatan_opd';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'program_id', 'nama_kegiatan', 'bobot', 'nama', 'jabatan'];
}
