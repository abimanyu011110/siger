<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisisKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('analisis_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id');
            $table->integer('kegiatan_id');
            $table->integer('risiko_id');
            $table->integer('pemda_id')->default(1);
            $table->string('periode');
            $table->integer('kemungkinan_id');
            $table->integer('dampak_id');
            $table->integer('tingkat_risiko');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('analisis_kegiatan');
    }
}
