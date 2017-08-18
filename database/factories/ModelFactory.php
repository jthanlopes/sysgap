<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Admin::class, function (Faker\Generator $faker) {

    return [
        'name' => 'admin',
        'email' => 'admin@admin.com',
        'password' => bcrypt('admin123'),
        'profile_photo' => $faker->imageUrl(215, 215, 'people', true, 'Faker'),
        'active' => 1
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Noticia::class, function (Faker\Generator $faker) {

    return [
        'titulo' => $faker->sentence(3),
        'conteudo' => $faker->paragraph(),
        'data_final' => $faker->date('Y-m-d'),
        'imagem' => $faker->imageUrl(408, 237, 'animals', true, 'Faker'),
        'admin_id' => 1,
        'ativo' => 1
    ];
});