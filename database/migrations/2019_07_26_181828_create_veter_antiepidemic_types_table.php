<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVeterAntiepidemicTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('veter_antiepidemic_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('疫病名称');
        });
        $data=array(
            array('name'=>'口蹄疫'),
            array('name'=>'布鲁氏杆菌'),
            array('name'=>'病毒性腹泻-BVDV'),
            array('name'=>'传染性鼻气管炎'),
            array('name'=>'魏氏梭菌病'),
            array('name'=>'牛出血性败血症'),
            array('name'=>'炭疽'),
            array('name'=>'牛流行热'),
            array('name'=>'巴氏杆菌'),
            array('name'=>'牛肺疫'),
            array('name'=>'伪狂犬'),
            array('name'=>'牛瘟'),

        );
        \DB::table('veter_antiepidemic_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('veter_antiepidemic_types');
    }
}
