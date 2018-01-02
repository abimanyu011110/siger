<?php

use Illuminate\Database\Seeder;
use App\Models\adminpemda\Role;
use App\Models\adminpemda\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$role_adminpemda = Role::where('nama_role', 'Admin Pemda')->first();
    	$role_userpemda1 = Role::where('nama_role', 'User Pemda 1')->first();
    	$role_userpemda2 = Role::where('nama_role', 'User Pemda 2')->first();
    	$role_adminopd = Role::where('nama_role', 'Admin OPD')->first();
        $role_useropd1 = Role::where('nama_role', 'User OPD 1')->first();
        $role_useropd2 = Role::where('nama_role', 'User OPD 2')->first();
        $role_useropdkegiatan1 = Role::where('nama_role', 'User OPD Kegiatan 1')->first();
        $role_useropdkegiatan2 = Role::where('nama_role', 'User OPD Kegiatan 2')->first();

    	$user1 = new User();
    	$user1->nama = 'Admin Pemda';
    	$user1->username = 'adminpemda';
    	$user1->password = bcrypt('adminpemda');
        $user1->role_id = '1';
    	$user1->save();
        $user1->roles()->attach('Admin Pemda');
        
    }
}
