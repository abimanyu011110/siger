<?php

namespace App\Models\userpemda1;

use Illuminate\Database\Eloquent\Model;

class Identifikasi extends Model
{
    //
    protected $table = 'identifikasi_pemda';
    public $timestamps = false;
    protected $fillable = ['analisis_id', 'sasaran_id', 'periode', 'risiko_id', 'uraian', 'sumber_risiko', 'kontrol', 'penyebab', 'dampak', 'pengendalian', 'sisa_risiko'];
}
