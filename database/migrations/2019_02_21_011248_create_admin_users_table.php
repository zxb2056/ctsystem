<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mobilePhone')->unique();
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable()->default('');
            $table->string('password');
            $table->tinyinteger('isSuperAdmin')->default(0);
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        \DB::table('admin_users')->insert(['mobilePhone'=>'18037682708','username'=>'chentao111','email'=>'zxb2056@126.com','password'=>Hash::make('666666')]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_users');
    }
}
