<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSirePedigreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sire_pedigrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sire')->comment('牛号');
            $table->string('father')->comment('父亲号');
            $table->string('mother')->default('*牛号缺失*')->comment('母亲号');
            $table->timestamps();
            $table->unique('sire')->comment('为sire创建唯一索引,不能有重复牛号');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sire_pedigrees');
    }
}
