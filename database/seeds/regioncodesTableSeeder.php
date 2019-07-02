<?php

use Illuminate\Database\Seeder;

class regioncodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Regioncode::truncate();
        factory(App\Models\Regioncode::class,5)->create();
    }
}
