<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleOutsideDamInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_outside_dam_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('damNum')->comment('本场外购牛的母亲号');
            $table->string('breed')->comment('品种');
            $table->string('whereComeFrom')->nullable()->comment('来源地区');
            $table->string('birthday')->nullable()->comment('出生日期');
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
        Schema::dropIfExists('cattle_outside_dam_infos');
    }
}
