<?php

use Illuminate\Database\Seeder;

class carrepairsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Carrepair::truncate();
        factory(App\Models\Carrepair::class,16)->create();
    }
}
