<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTempworkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempworkers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('mobilePhone');
            $table->string('personid');
            $table->date('startDay');
            $table->date('endDay')->nullable();
            $table->string('workContent');
            $table->float('dailySalary')->nullable();
            $table->float('totalSalary')->nullable();
            $table->string('payStatus')->nullable();
            $table->date('payDate')->nullable();
            $table->string('note')->nullable();
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
        Schema::dropIfExists('tempworkers');
    }
}
