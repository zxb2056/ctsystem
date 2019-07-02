<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceGrowthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_growths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cattle_id');
            $table->date('determineDay');
            $table->string('bodyWeight')->nullable();
            $table->string('bodyHigh')->nullable();
            $table->string('obliqueLength')->nullable()->comment('体斜长');
            $table->string('chestCircumference')->nullable()->comment('胸围');
            $table->string('abdominalCircumference')->nullable()->comment('腹围');
            $table->string('cannonBone')->nullable()->comment('管围');
            $table->string('hipWidth')->nullable()->comment('坐骨端宽');
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
        Schema::dropIfExists('performance_growths');
    }
}
