<?php

namespace App\Models\userpemda2;

use Illuminate\Database\Eloquent\Model;

class PantauPemda extends Model
{
    //
    protected $table = 'pemantauan_pemda';
    public $timestamps = false;
    protected $fillable = ['kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'deviasi', 'rtp', 'rekomendasi'];
}
