<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleChangeBarnHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_change_barn_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('changeDay')->comment('转舍日期');
            $table->string('cattle_id')->comment('牛号-id');
            $table->string('leaveBarn')->comment('转出牛舍');
            $table->string('enterBarn')->comment('转入牛舍');
            $table->string('reason')->nullable()->comment('转舍原因');
            $table->string('PIC')->nullable()->comment('负责人');
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
        Schema::dropIfExists('cattle_change_barn_histories');
    }
}
