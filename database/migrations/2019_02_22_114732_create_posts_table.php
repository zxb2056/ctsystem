<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',100);
            $table->longText('content');
            $table->integer('admin_user_id')->default(1);
            $table->integer('posttype_id')->default(1);
            $table->string('lunboLink')->nullable()->default('');
            $table->string('lunboTitle')->nullable()->default('');
            $table->string('lunboCaption')->nullable()->default('');
            $table->string('piclink')->nullable()->default('');
            $table->integer('view_counters')->default(1);
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
        Schema::dropIfExists('posts');
    }
}
