<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Pemda extends Model
{
    //
    protected $table = 'tbl_pemda';
    public $timestamps = false;
    protected $fillable = ['tahun', 'nama_pemda', 'alamat', 'kepala_daerah', 'jabatan'];
}
