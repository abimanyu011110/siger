<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tbl_user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('username');
            $table->unsignedInteger('opd_id')->nullable();
            $table->unsignedInteger('role_id');
            $table->string('password');
            $table->rememberToken();

            $table->foreign('opd_id')
                    ->references('id')->on('tbl_opd')
                    ->onDelete('cascade');
                    
            $table->foreign('role_id')
                    ->references('id')->on('tbl_role')
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
        Schema::dropIfExists('tbl_role');
    }
}
