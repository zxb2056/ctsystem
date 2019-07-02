<?php

use Illuminate\Database\Seeder;

class offworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Offwork::truncate();
        factory(App\Models\Offwork::class,16)->create();
    }
}
