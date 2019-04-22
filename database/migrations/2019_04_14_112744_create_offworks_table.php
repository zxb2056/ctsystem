<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offworks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('Reason');
            $table->dateTime('startTime');
            $table->dateTime('endTime');
            $table->string('offType');
            $table->string('leaderApproval');
            $table->dateTime('returnTime')->nullable();
            $table->string('fill_form_by');
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
        Schema::dropIfExists('offworks');
    }
}
