<?php

use Illuminate\Database\Seeder;

class cattleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Cattle::truncate();
        factory(App\Models\Cattle::class,16)->create();
    }
}
