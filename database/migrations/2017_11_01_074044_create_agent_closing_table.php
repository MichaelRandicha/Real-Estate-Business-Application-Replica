<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgentClosingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_closing', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agent_id')->unsigned();
            $table->foreign('agent_id')->references('id')->on('agents');
            $table->integer('cabang_id')->unsigned();
            $table->foreign('cabang_id')->references('id')->on('cabangs');
            $table->integer('closing_id')->unsigned();
            $table->foreign('closing_id')->references('id')->on('closings');
            $table->decimal('komisi', '13', '2');
            $table->integer('upline1_id')->unsigned();
            $table->foreign('upline1_id')->references('id')->on('agents');
            $table->decimal('upline1_komisi', '13', '2');
            $table->integer('upline2_id')->unsigned();
            $table->foreign('upline2_id')->references('id')->on('agents');
            $table->decimal('upline2_komisi', '13', '2');
            $table->integer('upline3_id')->unsigned();
            $table->foreign('upline3_id')->references('id')->on('agents');
            $table->decimal('upline3_komisi', '13', '2');
            $table->integer('principal_id')->unsigned();
            $table->foreign('principal_id')->references('id')->on('agents');
            $table->decimal('principal_komisi', '13', '2');
            $table->integer('vice_id')->unsigned();
            $table->foreign('vice_id')->references('id')->on('agents');
            $table->decimal('vice_komisi', '13', '2');
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
        Schema::dropIfExists('agent_closing');
    }
}
