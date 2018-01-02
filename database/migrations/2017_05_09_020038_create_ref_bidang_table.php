<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefBidangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('ref_bidang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('urusan_id');
            $table->string('nama_bidang');
            
            $table->foreign('urusan_id')
                    ->references('id')->on('ref_urusan')
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
        Schema::dropIfExists('ref_bidang');
    }
}
