<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatanOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('kegiatan_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('program_id');
            $table->string('nama_kegiatan');
            $table->integer('bobot');
            $table->string('nama');
            $table->string('jabatan');

            $table->foreign('program_id')
                ->references('id')
                ->on('program_opd')
                ->onDelete('cascade');
                
            $table->foreign('opd_id')
                ->references('id')
                ->on('tbl_opd')
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
        Schema::dropIfExists('kegiatan_opd');
    }
}
