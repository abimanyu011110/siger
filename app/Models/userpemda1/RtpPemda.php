<?php

namespace App\Models\userpemda1;

use Illuminate\Database\Eloquent\Model;

class RtpPemda extends Model
{
    //
    protected $table = 'rtp_pemda';
    public $timestamps = false;
    protected $fillable = ['analisis_id','rtp_tambah', 'jadwal', 'penanggungjawab', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'opsi'];
}
