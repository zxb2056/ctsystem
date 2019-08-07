<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('supplier_id')->comment('供货商id');
            $table->string('contacter')->comment('联系人名字');
            $table->string('position')->nullable()->comment('职位');
            $table->string('phone')->nullable()->comment('联系电话');
            $table->string('email')->nullable()->comment('邮箱');
            $table->string('QQ')->nullable()->comment('QQ号');
            $table->string('gender')->nullable()->comment('性别');
            $table->string('status')->nullable()->comment('1可联系，0无法联系');
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
        Schema::dropIfExists('supplier_contacts');
    }
}
