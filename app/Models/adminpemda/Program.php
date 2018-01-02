<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    //
    protected $table = 'program_pemda';
    public $timestamps = false;
    protected $fillable = ['sasaran_id', 'nama_program'];
}
