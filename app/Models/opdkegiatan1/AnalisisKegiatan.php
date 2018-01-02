<?php

namespace App\Models\opdkegiatan1;

use Illuminate\Database\Eloquent\Model;

class AnalisisKegiatan extends Model
{
    //
    protected $table = 'analisis_kegiatan';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'kegiatan_id', 'risiko_id', 'pemda_id', 'periode', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko'];
}
