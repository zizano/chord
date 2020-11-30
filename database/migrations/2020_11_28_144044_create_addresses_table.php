<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postcode_id')->nullable();
            $table->string('district', 60);
            $table->string('locality', 60);
            $table->string('street', 60);
            $table->string('site', 60);
            $table->string('site_number', 20);
            $table->string('site_description', 60);
            $table->string('site_subdescription', 60);
            $table->index(['postcode_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
