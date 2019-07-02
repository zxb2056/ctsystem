<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleOutsideSireDamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_outside_sire_dams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cattle_id');
            $table->string('sire_id')->comment('父亲号');
            $table->string('dam_id')->nullable()->comment('母亲号');
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
        Schema::dropIfExists('cattle_outside_sire_dams');
    }
}
