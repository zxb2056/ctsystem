<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarmaintainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carmaintains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('licensePlate');
            $table->date('maintain_day')->comment('保养日期');
            $table->string('pic')->comment('经办人');
            $table->string('repair_plant')->comment('汽修厂');
            $table->string('mileage')->comment('里程数');
            $table->string('cost')->comment('保养费');
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
        Schema::dropIfExists('carmaintains');
    }
}
