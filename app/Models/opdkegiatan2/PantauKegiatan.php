<?php

namespace App\Models\opdkegiatan2;

use Illuminate\Database\Eloquent\Model;

class PantauKegiatan extends Model
{
    //
    protected $table = 'pemantauan_kegiatan';
    public $timestamps = false;
    protected $fillable = ['kemungkinan_id', 'dampak_id', 'tingkat_risiko', 'deviasi', 'rtp', 'rekomendasi'];

}
