<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Visi extends Model
{
    //
    protected $table = 'visi_pemda';
    public $timestamps = false;
    protected $fillable = ['nama_visi']; 
}
