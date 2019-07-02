<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleSireDepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_sire_depositories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sireRegi')->comment('公牛注册号');
            $table->string('semenNum')->comment('公牛冻精号');
            $table->string('nation')->nullable()->comment('国家');
            $table->string('breedType')->nullable()->comment('品种');
            $table->string('belongToCompany')->nullable()->comment('所属公司');
            $table->date('birthday')->nullable()->comment('出生日期');
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
        Schema::dropIfExists('cattle_sire_depositories');
    }
}
