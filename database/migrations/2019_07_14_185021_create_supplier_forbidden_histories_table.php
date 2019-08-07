<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierForbiddenHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_forbidden_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('supplier_id')->comment('公司id');
            $table->string('forbidden')->comment('black or white');
            $table->date('happen_date')->comment('生效日期');
            $table->string('reason')->nullable()->comment('禁止原因');
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
        Schema::dropIfExists('supplier_forbidden_histories');
    }
}
