<?php

use Illuminate\Database\Seeder;

class caroutregisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        App\Models\Caroutregi::truncate();
        factory(App\Models\Caroutregi::class,5)->create();
    }
}
