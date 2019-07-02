<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarreturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carreturns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate');
            $table->string('Vuser')->comment('还车人');
            $table->datetime('returnTime');
            $table->string('returnMileage')->comment('返车里程数');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('carreturns');
    }
}
