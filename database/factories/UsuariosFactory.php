<?php

use equipac\Models\Usuarios;
use Illuminate\Support\Str;
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
// instanciando o gerador de fakes

$factory->define(Usuarios::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'password' => $faker->unique()->userName, // password
        'cargo' => $faker->jobTitle,
        'cpf' => $faker->cpf,
        'email' => $faker->unique()->safeEmail
    ];
});