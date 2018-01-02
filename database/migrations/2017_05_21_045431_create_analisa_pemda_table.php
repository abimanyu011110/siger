<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalisaPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('analisis_pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('misi_id');
            $table->integer('sasaran_id');
            $table->string('periode');
            $table->integer('risiko_id');
            $table->integer('pemda_id')->default(1);
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
        Schema::dropIfExists('analisis_pemda');
    }
}
