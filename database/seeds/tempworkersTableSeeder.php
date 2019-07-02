<?php

use Illuminate\Database\Seeder;

class tempworkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Tempworker::truncate();
        factory(App\Models\Tempworker::class,16)->create();
    }
}
