<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cattleID')->comment('标准耳号');
            $table->unique('cattleID');
            $table->date('birthday')->nullable()->comment('牛出生日期');
            $table->string('birthWeight')->nullable()->comment('初生重');
            $table->string('gender')->comment('性别公或母');
            $table->string('whichBreed')->nullable()->comment('品种');
            $table->string('whereComefrom')->comment('来源地,本场，购牛地');
            $table->date('enterDay')->nullable()->comment('进场日期');
            $table->string('enterWeight')->nullable()->comment('进场体重');
            $table->string('pregnancyNum')->default('0')->comment('胎次');
            // $table->string('belongBarn')->nulalble()->comment('所在牛舍号');//删除，另建一表，远程一对多。。
            $table->string('status')->default('在群')->comment('牛只状态，在群，出售，死淘');
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
        Schema::dropIfExists('cattle');
    }
}
