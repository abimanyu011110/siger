<?php

use Illuminate\Database\Seeder;
use App\Models\adminpemda\Proses;

class ProsesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $proses1 = new Proses();
        $proses1->nama_proses = 'Perencanaan';
        $proses1->save();

        $proses2 = new Proses();
        $proses2->nama_proses = 'Pelaksanaan';
        $proses2->save();

        $proses3 = new Proses();
        $proses3->nama_proses = 'Penata Usahaan';
        $proses3->save();

        $proses4 = new Proses();
        $proses4->nama_proses = 'Pertanggung Jawaban';
        $proses4->save();

        $proses5 = new Proses();
        $proses5->nama_proses = 'Pemeriksaan';
        $proses5->save();

        $proses6 = new Proses();
        $proses6->nama_proses = 'Lainnya';
        $proses6->save();
    }
}
