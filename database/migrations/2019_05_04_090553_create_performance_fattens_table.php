<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceFattensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_fattens', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->date('startDate')->nullable();
            $table->string('fattenStart');
            $table->date('endDate')->nullable();
            $table->string('fattenOver')->nullable();
            $table->string('FDG')->nullable()->comment('日增重');
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
        Schema::dropIfExists('performance_fattens');
    }
}
