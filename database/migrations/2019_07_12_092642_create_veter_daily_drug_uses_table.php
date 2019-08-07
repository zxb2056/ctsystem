<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterDailyDrugUsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_daily_drug_uses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('daily_treat_id')->comment('对应的日诊疗id');
            $table->integer('drug_id')->comment('药品的id');
            $table->string('drug_name')->nullable()->comment('药物名称,输液名称，手术名称等,治疗方式储存在当天的表中，这里不再储存');
            $table->string('dosage')->nullable()->comment('用量');
            $table->string('price')->nullable()->comment('药品单价');
            $table->string('amount')->nullable()->comment('药品总价');
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
        Schema::dropIfExists('veter_daily_drug_uses');
    }
}
