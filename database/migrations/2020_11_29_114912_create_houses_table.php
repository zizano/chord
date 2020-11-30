<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger( 'user_id');
            $table->unsignedBigInteger( 'postcode_id');
            $table->unsignedBigInteger( 'address_id');
            $table->tinyInteger('propertytype');
            $table->date('updated');
            $table->index(['user_id']);
            $table->index(['postcode_id']);
            $table->index(['address_id']);
//            $table->index(['user_id', 'postcode_id', 'address_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
