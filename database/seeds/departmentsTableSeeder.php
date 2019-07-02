<?php

use Illuminate\Database\Seeder;

class departmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Department::truncate();
        factory(App\Models\Department::class,16)->create();
    }
}
