<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCabangsForeignKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agents', function (Blueprint $table) {
            $table->integer('cabang_id')->unsigned()->change();
            $table->foreign('cabang_id')->references('id')->on('cabangs');

            $table->integer('upline_id')->unsigned()->nullable()->change();
            $table->foreign('upline_id')->references('id')->on('agents');
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
            $table->dropForeign('cabang_id');
            
            $table->dropForeign('upline_id');
        });
    }
}
