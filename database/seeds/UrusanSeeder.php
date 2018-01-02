<?php

use Illuminate\Database\Seeder;
use App\Models\adminpemda\Urusan;

class UrusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $urusan1 = new Urusan();
    	$urusan1->nama_urusan = 'Urusan Wajib Pelayanan Dasar';
    	$urusan1->save();

    	$urusan2 = new Urusan();
    	$urusan2->nama_urusan = 'Urusan Wajib Bukan Pelayanan Dasar';
    	$urusan2->save();

    	$urusan3 = new Urusan();
    	$urusan3->nama_urusan = 'Urusan Pilihan';
    	$urusan3->save();

    	$urusan4 = new Urusan();
    	$urusan4->nama_urusan = 'Urusan Pemerintah Fungsi Penunjang';
    	$urusan4->save();
    }
}
