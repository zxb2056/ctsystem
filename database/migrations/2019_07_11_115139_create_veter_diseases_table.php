<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterDiseasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_diseases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cattle_id');
            $table->string('cattleID')->comment('cattle ear tag');
            $table->string('dateOfOnset')->comment('发病日期 ');
            $table->string('ageOfOnset')->comment('发病时年龄,自动计算填写');
            $table->string('bodyWeight')->nullable()->comment('体重，如无条件可写估测体重');
            $table->string('firstTherapeuticDay')->comment('首次治疗日期');
            $table->string('nameOfDisease')->comment('疾病名称');
            $table->text('symptom')->nullable()->comment('症状');
            $table->string('outcome')->nullable()->comment('治疗结果');
            $table->string('PIC')->comment('治疗兽医');
            $table->string('endTherapeuticDay')->nullable()->comment('结束治疗日期');
            $table->string('status')->default('ing')->comment('分为ing,done，选择继续治疗的值是ing,选择治疗结束的值是done');
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
        Schema::dropIfExists('veter_diseases');
    }
}
