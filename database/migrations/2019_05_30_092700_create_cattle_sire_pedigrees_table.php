<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleSirePedigreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_sire_pedigrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sire')->comment('公牛号');
            $table->string('father')->comment('公牛父亲');
            $table->string('mother')->nullable()->comment('公牛母亲');
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
        Schema::dropIfExists('cattle_sire_pedigrees');
    }
}
