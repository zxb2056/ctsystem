<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterQuarantinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_quarantines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cattle_id');
            $table->string('cattleID');
            $table->date('quarantine_day')->nullable()->comment('检疫日期');
            $table->string('quarantine_disease')->nullable()->comment('检疫何种疾病');
            $table->string('quaran_method')->nullable()->comment('检疫方式');
            $table->string('quaran_addr')->nullable()->comment('检疫地点');
            $table->string('result')->nullable()->comment('结果');
            $table->string('pic')->nullable()->comment('责任人');
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
        Schema::dropIfExists('veter_quarantines');
    }
}
