<?php

namespace App\Models\opdkegiatan1;

use Illuminate\Database\Eloquent\Model;

class RtpKegiatan extends Model
{
    //
    protected $table = 'rtp_kegiatan';
    public $timestamps = false;
    protected $fillable = ['rtp_tambah', 'jadwal', 'penanggungjawab', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'opsi'];
}
