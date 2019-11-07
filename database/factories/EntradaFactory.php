<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entrada;
use App\User;
use Faker\Generator as Faker;

$factory->define(Entrada::class, function (Faker $faker) {
    $total=User::count();
    return [
        "titulo"=>$faker->name,
        "contenido"=>$faker->text($maxNbChars=400),
        "user_id"=>$faker->numberBetween(1,$total)
    ];
});
