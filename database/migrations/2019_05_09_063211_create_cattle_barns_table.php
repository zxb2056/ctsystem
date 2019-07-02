<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleBarnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_barns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('barnID')->comment('牛舍号');
            $table->string('barnName')->nullable()->comment('牛舍名');
            $table->string('barnStyle')->nullable()->commnet('牛舍类型，开方式，封闭式');
            $table->string('groundStyle')->nullable()->comment('地面硬化类型：水泥，砖沙，有卧床');
            $table->string('acreage')->nullable()->comment('面积-含运动场');
            $table->string('checkClipNum')->nullable()->comment('颈夹数');
            $table->string('waterTrough')->nullable()->comment('水槽数量');
            $table->string('troughSize')->nullable()->comment('水槽大小');
            $table->string('description')->nullable()->comment('牛舍说明');
            $table->string('PIC')->nullabel()->comment('负责兽医');
            $table->timestamps();
        });
        $data=array(
            array('barnID'=>'-1','barnName'=>'虚拟牛舍','barnStyle'=>'开放式','groundStyle'=>'水泥','acreage'=>'2000','checkClipNum'=>'0','waterTrough'=>'10','troughSize'=>'2','description'=>'用于牛舍周转用','PIC'=>'1'),
            array('barnID'=>'1','barnName'=>'青年牛舍','barnStyle'=>'开放式','groundStyle'=>'水泥','acreage'=>'2000','checkClipNum'=>'0','waterTrough'=>'10','troughSize'=>'2','description'=>'350kg以下青年牛舍','PIC'=>'2'),
            array('barnID'=>'2','barnName'=>'育肥牛舍','barnStyle'=>'开放式','groundStyle'=>'水泥','acreage'=>'2000','checkClipNum'=>'0','waterTrough'=>'10','troughSize'=>'2','description'=>'450kg以上牛只','PIC'=>'3'),
            array('barnID'=>'3','barnName'=>'母牛舍','barnStyle'=>'开放式','groundStyle'=>'水泥','acreage'=>'2000','checkClipNum'=>'0','waterTrough'=>'10','troughSize'=>'2','description'=>'用于配种后3个月以上母牛','PIC'=>'4'),
        );
        \DB::table('cattle_barns')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cattle_barns');
    }
}
