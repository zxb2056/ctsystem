<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carinfos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate');
            $table->string('carBrand');
            $table->string('Vtype')->nullable()->default('');
            $table->string('Vcategory')->nullable()->default('');
            $table->string('color')->nullable()->default('');
            $table->string('seatNumber')->nullable()->default('5');
            $table->string('EngineNumber')->nullable()->default('');
            $table->string('frameNumber')->nullable()->default('');
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
        Schema::dropIfExists('carinfos');
    }
}
