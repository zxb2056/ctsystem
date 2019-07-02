<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleBreedVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_breed_varieties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('品种名称');
            $table->timestamps();
        });
        $data=array(
            array('name'=>'未知品种'),
            array('name'=>'安格斯'),
            array('name'=>'西门塔尔'),
            array('name'=>'夏洛来'),
            array('name'=>'利木赞'),
            array('name'=>'和牛'),
            array('name'=>'秦川牛'),
            array('name'=>'南阳牛'),
            array('name'=>'夏南牛'),
            array('name'=>'荷斯坦牛'),
            array('name'=>'西杂牛'),
        );
        \DB::table('cattle_breed_varieties')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cattle_breed_varieties');
    }
}
