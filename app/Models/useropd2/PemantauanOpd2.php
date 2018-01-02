<?php

namespace App\Models\useropd2;

use Illuminate\Database\Eloquent\Model;

class PemantauanOpd2 extends Model
{
    //
    protected $table = 'pemantauan_opd';
    public $timestamps = false;
    protected $fillable = ['kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'deviasi', 'rekomendasi'];
}
