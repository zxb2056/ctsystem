<?php

use Illuminate\Database\Seeder;

class bulletinsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        factory(App\Bulletin::class,1)->create();
    }
}
