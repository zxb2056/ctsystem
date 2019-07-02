<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBreedAftercaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('breed_aftercares', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cow_id')->comment('母牛id');
            $table->string('cowID')->comment('母牛耳标号');
            $table->date('careDate')->comment('护理日期');
            $table->string('temperature')->nullable()->comment('母牛体温');
            $table->string('Retention')->comment('胎衣是否不下');
            $table->string('metritis')->nullable()->comment('子宫是否有炎症');
            $table->string('appetite')->nullable()->comment('食欲状况');
            $table->string('cowDung')->nullable()->comment('粪便情况');
            $table->string('maternity')->nullable()->comment('母性好坏');
            $table->string('lactation')->nullable()->comment('泌乳情况');
            $table->string('careDrug')->nullable()->comment('护理药品或添加剂');
            $table->string('PIC')->comment('护理人');
            $table->index('cowID','cow_id');
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
        Schema::dropIfExists('breed_aftercares');
    }
}
