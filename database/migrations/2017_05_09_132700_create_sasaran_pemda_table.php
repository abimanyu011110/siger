<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSasaranPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sasaran_pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tujuan_id');
            $table->string('nama_sasaran');
            
            $table->foreign('tujuan_id')
                ->references('id')
                ->on('tujuan_pemda')
                ->onDelete('cascade');
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
        Schema::dropIfExists('sasaran_pemda');
    }
}
