<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialDrugRepositoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 虽然最初填写成分，用法用量可能会浪费时间，但是以后使用方便。可以方便的在app上看到药品的信息，对兽医也方便。
        Schema::create('material_drug_repositories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('drugName')->comment('药品名字');
            $table->integer('drugType')->comment('药品类别，代号：1，2等，如治疗类，消毒类，疫苗等大概分类');
            $table->string('unit')->comment('计量单位，如升，毫升等');
            $table->string('pack_size')->nullable()->comment('包装规格：10ml*10支*40盒/箱');
            $table->string('supplier')->comment('供货单位或公司名称');
            $table->string('main_components')->nullable()->comment('主要成分');
            $table->string('character')->nullable()->comment('性状，粉末或液体等');
            $table->string('yaolizuoyong')->nullable()->comment('药理作用');
            $table->string('yao_dong_xue')->nullable()->comment('药动学');
            $table->string('suit_symptom')->nullable()->comment('适应症');
            $table->string('usage_dosage')->nullable()->comment('用法用量');
            $table->string('adverse_reaction')->nullable()->comment('不良反应');
            $table->string('attention')->nullable()->comment('注意事项');
            $table->string('withdrawal_time')->nullable()->comment('休药期');
            $table->string('active_ingredient_content')->nullable()->comment('有效成分含量');
            $table->string('storage_method')->nullable()->comment('贮藏方法');
            $table->string('approval_number')->nullable()->comment('批准文号');
            $table->string('note')->nullable()->comment('备注说明，药品注意事项等');
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
        Schema::dropIfExists('material_drug_repositories');
    }
}
