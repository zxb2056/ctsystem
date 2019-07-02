<?php

use Illuminate\Database\Seeder;

class staffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Staff::truncate();
        factory(App\Models\Staff::class,16)->create();
    }
}
