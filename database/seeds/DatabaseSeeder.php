<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            bulletinsTableSeeder::class,
            postsTableSeeder::class,
            regioncodesTableSeeder::class,
            staffTableSeeder::class,
            offworksTableSeeder::class,
            departmentsTableSeeder::class,
            carinfosTableSeeder::class,
            caroutregisTableSeeder::class,
            oilcardsTableSeeder::class,
            oilrecordsTableSeeder::class,
            carreturnsTableSeeder::class,
            carmaintainsTableSeeder::class,
            carrepairsTableSeeder::class,
            tempworkersTableSeeder::class,
            // cattle_barnsTableSeeder::class,
            // cattleTableSeeder::class,
            // cattlesireinfosTableSeeder::class,
        ]);
    }
}
