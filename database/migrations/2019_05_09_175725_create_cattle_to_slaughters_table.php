<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleToSlaughtersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_to_slaughters', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->date('saleDay')->comment('出售日期');
            $table->string('whichFactory')->nullable()->comment('卖给哪一家公司');
            $table->string('saleWeight')->nullable()->comment('出售体重');
            $table->string('salePrice')->nullable()->comment('出售价格');
            $table->string('income')->nullable()->comment('收入');
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
        Schema::dropIfExists('cattle_to_slaughters');
    }
}
