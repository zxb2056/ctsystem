<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedSemenRemainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_semen_remains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semen_id')->comment('繁育人员的冻精库存');
            $table->string('remain')->comment('剩余冻精数量，每次配种，损坏自动减');
            $table->index('semen_id');
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
        Schema::dropIfExists('breed_semen_remains');
    }
}
