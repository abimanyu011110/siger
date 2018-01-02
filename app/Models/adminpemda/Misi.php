<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Misi extends Model
{
    //
    protected $table = 'misi_pemda';
    public $timestamps = false;
    protected $fillable = ['visi_id', 'nama_misi'];
}
