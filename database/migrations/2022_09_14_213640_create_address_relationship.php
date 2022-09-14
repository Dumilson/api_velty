<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressRelationship extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_relationship', function (Blueprint $table) {
            $table->id();
            $table->int("id_address")->references("id")->on("address");
            $table->int("id_customer")->references('id')->on('customer')->nullable();
            $table->int("id_building")->references('id')->on('id_building')->nullable();
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
        Schema::dropIfExists('address_relationship');
    }
}
