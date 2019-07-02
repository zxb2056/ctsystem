<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCattleSireInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cattle_sire_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sireRegi')->comment('公牛注册登记号');
            $table->string('semenNum')->comment('冻精号');
            $table->string('breedType')->comment('品种');
            $table->string('nation_id')->default('CHN')->comment('国家');
            $table->string('belongToCompany')->comment('所属公司');
            $table->string('CBI')->nullable()->comment('中国肉牛指数');
            $table->date('birthDay')->nullable()->comment('出生日期');
            $table->string('BW')->nullable()->comment('初生重');
            $table->string('WW')->nullable()->comment('断奶生');
            $table->string('YW')->nullable()->nullable()->comment('周岁重');
            $table->string('W18month')->nullable()->comment('18月龄重');
            $table->string('W24month')->nullable()->comment('24月龄重');
            $table->string('W36month')->nullable()->comment('36月龄重');
            $table->string('level')->nullable()->comment('体型等级');
            $table->string('CEM')->nullable()->comment('产犊难易度');
            $table->string('milk')->nullable()->comment('公牛女儿产奶量');
            $table->string("MH")->nullable()->comment('美国指标-成年体高');
            $table->string('MW')->nullable()->comment('美国指标-成年体重');
            $table->string('CW')->nullable()->comment('胴体重育种值');
            $table->string('Marbling')->nullable()->comment('大理石花纹育种值');
            $table->string('REA')->nullable()->comment('眼肌面积育种值');
            $table->string('Fat')->nullable()->comment('背膘厚育种值');
            $table->string('FValue')->nullable()->comment('育肥价值');
            $table->string('GValue')->nullable()->comment('胴体价值');
            $table->string('QGValue')->nullable()->comment('品质评分');
            $table->string('YGValue')->nullable()->comment('产量评分');
            $table->string('BValue')->nullable()->comment('肉牛价值');
            $table->index('sireRegi')->comment('为注册号建立索引');
            $table->index('semenNum')->comment('为冻精号建立索引');
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
        Schema::dropIfExists('cattle_sire_infos');
    }
}
