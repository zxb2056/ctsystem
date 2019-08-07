<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialDrugTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_drug_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->comment('药品分类名');
            $table->timestamps();
            
        });
        $data=array(
            array('name'=>'治疗类'),
            array('name'=>'输液类'),
            array('name'=>'消毒剂'),
            array('name'=>'疫苗'),
            array('name'=>'检疫类'),
        );
        \DB::table('material_drug_types')->insert($data);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_drug_types');
    }
}
