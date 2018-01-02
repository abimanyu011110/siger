<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('program_pemda', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sasaran_id');
            $table->string('nama_program');
            
            $table->foreign('sasaran_id')
                ->references('id')
                ->on('sasaran_pemda')
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
        Schema::dropIfExists('program_pemda');
    }
}
