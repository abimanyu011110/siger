<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ProsesSeeder::class);
        $this->call(UrusanSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(BidangSeeder::class);
    }
}
