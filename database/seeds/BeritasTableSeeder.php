<?php

use Illuminate\Database\Seeder;

class BeritasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(BeritasTableSeeder::class, 25);

        factory('App\Berita', 25)->create();
    }
}
