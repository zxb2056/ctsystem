<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name')->comment('供货商名称');
            $table->string('company_license_code')->nullable()->comment('企业营业执照代码');
            $table->string('type')->nullable()->comment('企业类型，营业执照上一致');
            $table->string('addr')->nullable()->comment('企业地址');
            $table->double('registered_capital',20,8)->default('0')->comment('注册资本');
            $table->string('scope')->nullable()->comment('经营范围');
            $table->string('license_photo')->nullable()->comment('企业营业执照图片');
            $table->string('status')->nullable()->default('0')->comment('企业状态，默认0，代表候选但尚未采购，1，代表已经采购产品，-1代表拉入黑名单，以后没有办法在下拉框中选择入库，除非解除黑名单');
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
        Schema::dropIfExists('suppliers');
    }
}
