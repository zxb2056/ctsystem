<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id')->comment('母牛id');
            $table->string('cowID')->comment('母牛耳标号');
            $table->date('dayOfOnset')->comment('发病日期');
            $table->string('diseaseName')->nullable()->comment('疾病名称，即何种疾病');
            $table->text('symptom')->nullable()->comment('症状');
            $table->text('therapeutic')->nullable()->comment('治疗方案');
            $table->string('result')->nullable()->comment('治疗结果');
            $table->string('PIC')->nullable()->comment('负责兽医');
            $table->timestamps();
            $table->index('cowID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('breed_diseases');
    }
}
