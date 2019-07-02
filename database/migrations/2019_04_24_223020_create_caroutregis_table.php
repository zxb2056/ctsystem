<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaroutregisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caroutregis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate');
            $table->string('Vuser');
            $table->datetime('outtime');
            $table->string('driver');
            $table->string('destination');
            $table->string('forwhat');
            $table->datetime('estimatedreturn')->nullable();
            $table->string('outMileage')->comment('出车时里程');
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
        Schema::dropIfExists('caroutregis');
    }
}
