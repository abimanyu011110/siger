<?php

namespace App\Models\adminpemda;

use Illuminate\Database\Eloquent\Model;

class Mapping extends Model
{
    //
    protected $table = 'tbl_maping';
    public $timestamps = false;
    protected $fillable = ['sasranpemda_id', 'opd_id', 'sasaranopd_id'];
}
