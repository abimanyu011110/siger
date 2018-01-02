<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIdentifikasiKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('identifikasi_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('sasaran_id');
            $table->unsignedInteger('program_id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('pemda_id')->default(1);
            $table->string('periode');
            $table->unsignedInteger('risiko_id');
            $table->string('uraian');
            $table->string('sumber_risiko');
            $table->string('kontrol');
            $table->string('penyebab');
            $table->string('dampak');
            $table->string('pengendalian');
            $table->string('sisa_risiko');

            $table->foreign('opd_id')
                ->references('id')
                ->on('tbl_opd')
                ->onDelete('cascade');

            $table->foreign('sasaran_id')
                ->references('id')
                ->on('sasaran_opd')
                ->onDelete('cascade');
                
            $table->foreign('program_id')
                ->references('id')
                ->on('program_opd')
                ->onDelete('cascade');

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatan_opd')
                ->onDelete('cascade');

            $table->foreign('pemda_id')
                ->references('id')
                ->on('tbl_pemda')
                ->onDelete('cascade');

            $table->foreign('risiko_id')
                ->references('id')
                ->on('tbl_baganrisiko')
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
        Schema::dropIfExists('identifikasi_kegiatan');
    }
}
