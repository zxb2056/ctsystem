<?php

use Illuminate\Database\Seeder;

class cattle_barnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\CattleBarn::truncate();
        factory(App\Models\CattleBarn::class,16)->create();
    }
}
