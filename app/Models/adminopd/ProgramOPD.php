<?php

namespace App\Models\adminopd;

use Illuminate\Database\Eloquent\Model;

class ProgramOPD extends Model
{
    //
    protected $table = 'program_opd';
    public $timestamps = false;
    protected $fillable = ['opd_id', 'sasaran_id', 'nama_program'];
}
