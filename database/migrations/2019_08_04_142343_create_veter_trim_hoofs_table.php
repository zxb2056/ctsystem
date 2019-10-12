<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterTrimHoofsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_trim_hoofs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cattle_id');
            $table->string('cattleID');
            $table->date('trim_date')->comment('修蹄日期');
            $table->string('diseaseOrCare')->default('0')->comment('0代表普修，1代表有病蹄');
            $table->string('trim_num')->nullable()->comment('修蹄数量');
            $table->string('which_hoof')->nullable()->comment('以1代表左前，2代表右前，3代表左后，4代表右后，中间以逗号隔开');
            $table->string('pic')->nullable()->comment('责任兽医');
            $table->date('end_day')->nullable()->comment('牛蹄修好的日期，可能是当天');
            $table->string('outcome')->nullable()->comment('治疗结果');
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
        Schema::dropIfExists('veter_trim_hoofs');
    }
}
