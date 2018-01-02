<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('urusan_id');
            $table->unsignedInteger('bidang_id');
            $table->string('nama_opd');
            $table->string('kepala_opd');
            $table->string('jabatan');

            $table->foreign('urusan_id')
                    ->references('id')->on('ref_urusan')
                    ->onDelete('cascade');
                    
            $table->foreign('bidang_id')
                    ->references('id')->on('ref_bidang')
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
        Schema::dropIfExists('tbl_opd');
    }
}
