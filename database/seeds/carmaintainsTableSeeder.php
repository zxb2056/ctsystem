<?php

use Illuminate\Database\Seeder;

class carmaintainsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Carmaintain::truncate();
        factory(App\Models\Carmaintain::class,16)->create();
    }
}
