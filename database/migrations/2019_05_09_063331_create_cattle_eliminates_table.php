<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleEliminatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_eliminates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id')->comment('牛只id');
            $table->date('elimiDay')->comment('淘汰日期');
            $table->string('reason')->comment('淘汰原因,死亡，疾病,');
            $table->string('toWhere')->comment('牛只去向');
            $table->string('eliminateIncome')->nullable()->comment('淘汰收入');
            //提交此表的时候，更改牛只状态
            $table->string('note')->nullable()->comment('附加说明');
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
        Schema::dropIfExists('cattle_eliminates');
    }
}
