<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTujuanPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tujuan_pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('misi_id');
            $table->string('nama_tujuan');
            
            $table->foreign('misi_id')
                ->references('id')
                ->on('misi_pemda')
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
        Schema::dropIfExists('tujuan_pemda');
    }
}
