<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOilcardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oilcards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cardID');
            $table->date('applydate');
            $table->string('PIC');
            $table->string('belongto');
            $table->float('remain');
            $table->string('wnstop');
            $table->string('note')->nullable();
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
        Schema::dropIfExists('oilcards');
    }
}
