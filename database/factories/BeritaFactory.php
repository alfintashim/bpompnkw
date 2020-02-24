<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Berita::class, function (Faker $faker) {
    return [
        'judul' => $faker->sentence,
        'isi' => $faker->paragraph,
        'id_create' => '25',
        'status' => 'PUBLISH',
    ];
});
