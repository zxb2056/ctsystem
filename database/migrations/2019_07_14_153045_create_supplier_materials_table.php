<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_materials', function (Blueprint $table) {
            // 决定每次入库时间都填写在这里，并且保存入库id
            $table->bigIncrements('id');
            $table->integer('supplier_id')->comment('对应的公司id');
            $table->string('type_name')->comment('对应的物品类名，如药品，饲料等');
            $table->string('query_link')->comment('直接跳转到台帐链接,拼接上公司名字');
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
        Schema::dropIfExists('supplier_materials');
    }
}
