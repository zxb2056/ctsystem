<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semenNum')->comment('冻精号');
            $table->string('company')->nullable()->comment('所属公司');
            $table->string('frozenType')->comment('是否性控,sexed,common');
            $table->string('breed')->nullable()->comment('品种,1代表未知品种');
            $table->string('pedigreeStatus')->default('0')->commnet('系谱完善状态');
            $table->string('forwhich')->default('0')->comment('0本场自用,-1外购怀孕牛，之前怀孕牛所用冻精信息；1 ,都用。');
            $table->timestamps();
        });
        $data=array(
            array('semenNum'=>'null','company'=>'unknown','frozenType'=>'普精','breed'=>'1','pedigreeStatus'=>'1','forwhich'=>'1'),
        );
        \DB::table('semen_infos')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semen_infos');
    }
}
