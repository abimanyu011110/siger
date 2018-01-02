<?php

use Illuminate\Database\Seeder;
use App\Models\adminpemda\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role1 = new Role();
        $role1->nama_role = 'Admin Pemda';
        $role1->save();

        $role2 = new Role();
        $role2->nama_role = 'User Pemda 1';
        $role2->save();

        $role3 = new Role();
        $role3->nama_role = 'User Pemda 2';
        $role3->save();

        $role4 = new Role();
        $role4->nama_role = 'Admin OPD';
        $role4->save();

        $role5 = new Role();
        $role5->nama_role = 'User OPD 1';
        $role5->save();

        $role6 = new Role();
        $role6->nama_role = 'User OPD 2';
        $role6->save();

        $role7 = new Role();
        $role7->nama_role = 'User OPD Kegiatan 1';
        $role7->save();

        $role8 = new Role();
        $role8->nama_role = 'User OPD Kegiatan 2';
        $role8->save();
    }
}
