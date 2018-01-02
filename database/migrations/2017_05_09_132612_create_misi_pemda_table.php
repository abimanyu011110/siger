<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMisiPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('misi_pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('visi_id');
            $table->string('nama_misi');
            
            $table->foreign('visi_id')
                ->references('id')
                ->on('visi_pemda')
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
        Schema::dropIfExists('misi_pemda');
    }
}
