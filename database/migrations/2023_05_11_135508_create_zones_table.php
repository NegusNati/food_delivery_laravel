<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name', 190);
            $table->string('coordinates', 191);
            $table->integer('status');

            $table->string('restaurant_wise_topic', 191);
            $table->string('customer_wise_topic', 191);
            $table->string('deliveryman_wise_topic', 191);
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
        Schema::dropIfExists('zones');
    }
}
