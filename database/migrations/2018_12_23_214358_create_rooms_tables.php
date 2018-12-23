<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_tables', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv')->unique();
            $table->boolean('status');
            $table->unsignedInteger('rtype_id');
            $table->foreign('rtype_id')->references('id')->on('room_types');
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
        Schema::dropIfExists('rooms_tables');
    }
}
