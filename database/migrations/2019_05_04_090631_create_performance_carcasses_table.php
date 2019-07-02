<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceCarcassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_carcasses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->date('屠宰日期')->nullable();
            $table->string('pre_slaughter_weight')->nullable()->comment('宰前重');
            $table->string('carcass_weight')->nullable()->comment('胴体重');
            $table->string('slaugther_rate')->nullable()->comment('屠宰率');
            $table->string('net_meat_weight')->nullable()->comment('净肉重');
            $table->string('net_meat_percentage')->nullable()->comment('净肉率');
            $table->string('bone_weight')->nullable()->comment('净骨重');
            $table->string('meat_bone_ration')->nullable()->comment('肉骨比');
            $table->string('loin_muscle_area_preslaughter')->nullable()->comment('宰前眼肌面积');
            $table->string('loin_muscle_area_afterslaughter')->nullable()->comment('宰后眼肌面积');
            $table->string('backfat_thickness_perslaughter')->nullable()->comment('宰前背膘厚');
            $table->string('backfat_thickness_afterslaughter')->nullable()->comment('宰后背膘厚');
            $table->string('carcass_grade')->nullable()->comment('胴体等级');  
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
        Schema::dropIfExists('performance_carcasses');
    }
}
