<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomBuilding extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_building', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_room')->references('id')->on("room");
            $table->foreign('id_building')->references('id')->on('building');
            $table->float("value_minute",10,2);
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
        Schema::dropIfExists('room_building');
    }
}
