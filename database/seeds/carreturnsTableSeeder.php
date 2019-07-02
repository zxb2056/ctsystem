<?php

use Illuminate\Database\Seeder;

class carreturnsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Carreturn::truncate();
        factory(App\Models\Carreturn::class,16)->create();
    }
}
