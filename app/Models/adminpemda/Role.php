<?php

namespace App\Models\adminpemda;
use App\Models\adminpemda\Role;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $table = 'tbl_role';
    public $timestamps = false;
    protected $fillable = ['nama_role'];

}
