<?php

use Illuminate\Database\Seeder;

class oilcardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Oilcard::truncate();
        DB::table('oilcards')->insert([
            'cardID' => '8000 0000 0652 7431',
            'applydate' => '2018/6/5',
            'PIC'=>'李辰',
            'belongto'=>'中国石化',
            'remain'=>'2650',
            'wnstop'=>'在用',
            'note'=>'中石化每周一有优惠',
        ]);
        DB::table('oilcards')->insert([
            'cardID' => '9000 0000 0312 8311',
            'applydate' => '2018/6/12',
            'PIC'=>'李辰',
            'belongto'=>'中国石油',
            'remain'=>'1860',
            'wnstop'=>'在用',
            'note'=>'中石化每周一有优惠',
        ]);
        DB::table('oilcards')->insert([
            'cardID' => '2316 0000 0312 1560',
            'applydate' => '2019/1/2',
            'PIC'=>'李辰',
            'belongto'=>'金源石化',
            'remain'=>'280',
            'wnstop'=>'在用',
            'note'=>'网点少，伊川县城东有网点',
        ]);
    }
}
