<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterAntiepidemicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_antiepidemics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('anti_day')->comment('免疫日期');
            $table->string('epidemic_type')->comment('疫病类型');
            $table->string('cattle_id')->nullable()->comment('牛只id');
            $table->string('ageOfDay')->nullable()->comment('牛只日龄');
            $table->string('barnOrSingle')->comment('整舍还是单个');
            $table->string('barnId')->comment('保存当时的牛舍号，不是id');
            $table->string('drug_id')->comment('疫苗id');
            // $table->string('drug_name')->comment('疫苗名称,尽量减少数据库的体积');
            $table->string('use_amount')->default('0')->comment('疫苗用量');
            $table->double('money',16,4)->nullable()->comment('产生的药费');
            $table->string('pic')->nullable()->comment('负责人');
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
        Schema::dropIfExists('veter_antiepidemics');
    }
}
