<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('lokasi');
            $table->string('telepon');
            $table->decimal('pendapatan', '13', '0')->default(0);
            $table->integer('cabang_id')->unsigned()->nullable();
            $table->integer('upline_id')->unsigned()->nullable();
            $table->foreign('upline_id')->references('id')->on('agents');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->dropForeign('upline_id');
        });
        Schema::dropIfExists('agents');
    }
}
