<?php

namespace App\Models\userpemda1;

use Illuminate\Database\Eloquent\Model;

class AnalisisPemda extends Model
{
    //
    protected $table = 'analisis_pemda';
    public $timestamps = false;
    protected $fillable = ['misi_id', 'sasaran_id', 'periode', 'risiko_id', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko'];
}
