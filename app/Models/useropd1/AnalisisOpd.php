<?php

namespace App\Models\useropd1;

use Illuminate\Database\Eloquent\Model;

class AnalisisOpd extends Model
{
    //
    protected $table = 'analisis_opd';
    public $timestamps = false;
    protected $fillable = ['identifikasi_id', 'risiko_id', 'kemungkinan_id', 'dampak_id', 'tingkat_risiko'];
}
