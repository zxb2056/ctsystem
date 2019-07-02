<?php

use Illuminate\Database\Seeder;

class oilrecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Oilrecord::truncate();
        factory(App\Models\Oilrecord::class,16)->create();

    }
}
