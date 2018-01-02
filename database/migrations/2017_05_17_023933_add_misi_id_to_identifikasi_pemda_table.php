<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMisiIdToIdentifikasiPemdaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('identifikasi_pemda', function (Blueprint $table) {
            //
            $table->unsignedInteger('misi_id')->after('id');

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
        Schema::table('identifikasi_pemda', function (Blueprint $table) {
            //
            $table->dropColumn('misi_id');
        });
    }
}
