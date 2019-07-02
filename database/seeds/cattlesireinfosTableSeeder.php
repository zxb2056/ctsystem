<?php

use Illuminate\Database\Seeder;

class cattlesireinfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\CattleSireInfo::truncate();
        factory(App\Models\CattleSireInfo::class,100)->create();
    }
}
