<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepartmentStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_staff', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('department_id');
            $table->integer('staff_id');
            $table->string('position')->nullable()->comment('岗位名称，可以为空');
            $table->string('whole_dpart_id')->nullable()->comment('整个层级id');
            $table->string('whole_depart_name')->nullable()->comment('整个层级的部门名字');
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
        Schema::dropIfExists('department_staff');
    }
}
