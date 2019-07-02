<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialSemenRemainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_semen_remains', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semen_id')->comment('统计上的冻精库存');
            $table->string('remain')->comment('剩余冻精数量，每次出库的时候自动减');
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
        Schema::dropIfExists('material_semen_remains');
    }
}
