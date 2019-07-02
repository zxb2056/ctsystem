<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerformanceFeedcovertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 如果是群体数据，牛的名字那里填写的是'全部'，统计逻辑和详细的一样，全部试验组下边的牛只采食量之和。
     */
    public function up()
    {
        Schema::create('performance_feedcoverts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('experiment_id');
            $table->string('cattleName');
            $table->date('days');
            $table->string('feedAmount');
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
        Schema::dropIfExists('performance_feedcoverts');
    }
}
