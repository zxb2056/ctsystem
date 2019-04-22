<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('gender');
            $table->string('telephone')->nullable()->default('');
            $table->date('birthday')->nullable();
            $table->date('entryDate')->nullable();
            $table->string('eduDegree')->nullable()->default('');
            $table->string('school')->nullable()->default('');
            $table->string('major')->nullable()->default('');
            $table->date('gradudate')->nullable();
            $table->string('special')->nullable()->default('');
            $table->string('Political_status')->nullable()->default('');
            $table->softDeletes();
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
        Schema::dropIfExists('staff');
    }
}
