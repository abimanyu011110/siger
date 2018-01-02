<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTujuanOpdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tujuan_opd', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('misi_id');
            $table->string('nama_tujuan');

            $table->foreign('opd_id')
                ->references('id')
                ->on('tbl_opd')
                ->onDelete('cascade');

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
        Schema::dropIfExists('tujuan_opd');
    }
}
