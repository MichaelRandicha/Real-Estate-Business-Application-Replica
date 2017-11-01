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
            $table->integer('closing_id')->unsigned();
            $table->foreign('closing_id')->references('id')->on('closings');
            $table->string('komisi');
            $table->integer('upline1_id')->unsigned();
            $table->foreign('upline1_id')->references('id')->on('agents');
            $table->string('upline1_komisi');
            $table->integer('upline2_id')->unsigned();
            $table->foreign('upline2_id')->references('id')->on('agents');
            $table->string('upline2_komisi');
            $table->integer('upline3_id')->unsigned();
            $table->foreign('upline3_id')->references('id')->on('agents');
            $table->string('upline3_komisi');
            $table->integer('principal_id')->unsigned();
            $table->foreign('principal_id')->references('id')->on('agents');
            $table->string('principal_komisi');
            $table->integer('vice_id')->unsigned();
            $table->foreign('vice_id')->references('id')->on('agents');
            $table->string('vice_komisi');
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
