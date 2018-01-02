<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRtpKegiatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('rtp_kegiatan', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('opd_id');
            $table->unsignedInteger('kegiatan_id');
            $table->unsignedInteger('risiko_id');
            $table->unsignedInteger('pemda_id')->default(1);
            $table->string('periode');
            $table->string('rtp_tambah');
            $table->string('jadwal');
            $table->string('penanggungjawab');
            $table->unsignedInteger('kemungkinan_id');
            $table->unsignedInteger('dampak_id');
            $table->integer('tingkat_risiko');
            $table->string('opsi');

            $table->foreign('opd_id')
                ->references('id')
                ->on('tbl_opd')
                ->onDelete('cascade');

            $table->foreign('kegiatan_id')
                ->references('id')
                ->on('kegiatan_opd')
                ->onDelete('cascade');

            $table->foreign('risiko_id')
                ->references('id')
                ->on('tbl_baganrisiko')
                ->onDelete('cascade');

            $table->foreign('pemda_id')
                ->references('id')
                ->on('tbl_pemda')
                ->onDelete('cascade');

            $table->foreign('kemungkinan_id')
                ->references('id')
                ->on('tbl_kemungkinan')
                ->onDelete('cascade');

            $table->foreign('dampak_id')
                ->references('id')
                ->on('tbl_dampak')
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
        ema::dropIfExists('rtp_kegiatan');
    }
}
