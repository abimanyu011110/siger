<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblbaganrisikoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_baganrisiko', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('kategori_id');
            $table->unsignedInteger('proses_id');
            $table->string('nama_risiko');

            $table->foreign('kategori_id')
                ->references('id')
                ->on('tbl_kategori')
                ->onDelete('cascade');
                
            $table->foreign('proses_id')
                ->references('id')
                ->on('tbl_proses')
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
        Schema::dropIfExists('tbl_baganrisiko');
    }
}
