<?php

namespace App\Models\useropd1;

use Illuminate\Database\Eloquent\Model;

class IdentifikasiOpd extends Model
{
    //
    protected $table = 'identifikasi_opd';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'sasaran_id', 'pemda_id', 'periode', 'proses_id', 'risiko_id', 'uraian', 'sumber_risiko', 'kontrol', 'penyebab', 'dampak', 'pengendalian', 'sisa_risiko'];
}
