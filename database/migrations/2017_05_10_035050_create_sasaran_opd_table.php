<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSasaranOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('sasaran_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('tujuan_id');
            $table->string('nama_sasaran');

            $table->foreign('opd_id')
                ->references('id')
                ->on('tbl_opd')
                ->onDelete('cascade');
                
            $table->foreign('tujuan_id')
                ->references('id')
                ->on('tujuan_opd')
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
    }
}
