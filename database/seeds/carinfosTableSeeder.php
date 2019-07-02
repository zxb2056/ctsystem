<?php

use Illuminate\Database\Seeder;

class carinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Carinfo::truncate();
        DB::table('carinfos')->insert([
            'licensePlate'=>'豫CLK078',
            'carBrand'=>'东风日产/轩逸',
            'Vtype'=>'轿车/三厢',
            'color'=>'白色',
            'seatNumber'=>'5',
            'EngineNumber'=>'AF9K54605',
            'frameNumber'=>'LVVDC1BX90374611',
        ]);
        DB::table('carinfos')->insert([
            'licensePlate'=>'豫CUU860',
            'carBrand'=>'起亚/狮跑',
            'Vtype'=>'SUV/两厢',
            'color'=>'黑色',
            'seatNumber'=>'5',
            'EngineNumber'=>'DG5K82306',
            'frameNumber'=>'TVCDC1BX90374611',
        ]);
        DB::table('carinfos')->insert([
            'licensePlate'=>'豫A63MQ5',
            'carBrand'=>'华晨/华颂',
            'Vtype'=>'SUV/两厢',
            'color'=>'棕灰色',
            'seatNumber'=>'7',
            'EngineNumber'=>'FRC5K39217',
            'frameNumber'=>'TVCDC1BX90356821',
        ]);
    }
}
