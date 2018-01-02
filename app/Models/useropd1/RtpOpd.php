<?php

namespace App\Models\useropd1;

use Illuminate\Database\Eloquent\Model;

class RtpOpd extends Model
{
    //
    protected $table = 'rtp_opd';
    public $timestamps = false;
    protected $fillable = ['analisis_id','rtp_tambah', 'jadwal', 'penanggungjawab', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'opsi'];
}
