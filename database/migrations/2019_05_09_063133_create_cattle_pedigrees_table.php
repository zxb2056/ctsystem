<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattlePedigreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_pedigrees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cattle_id')->comment('牛号');
            $table->string('sire_id')->comment('父亲号');
            //专门有个公牛信息表，存储公牛育种值指标。
            $table->string('dam_id')->comment('母亲号');
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
        Schema::dropIfExists('cattle_pedigrees');
    }
}
