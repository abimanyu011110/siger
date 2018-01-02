<?php

namespace App\Models\opdkegiatan1;

use Illuminate\Database\Eloquent\Model;

class IdentifikasiKegiatan extends Model
{
    //
    protected $table = 'identifikasi_kegiatan';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'sasaran_id', 'program_id', 'kegiatan_id', 'proses_id', 'risiko_id', 'uraian', 'sumber_risiko', 'kontrol', 'penyebab', 'dampak', 'pengendalian', 'sisa_risiko'];


}
