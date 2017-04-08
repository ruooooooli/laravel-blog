<?php

use App\Models\User;
use Faker\Generator;

$factory->define(User::class, function (Generator $faker) {

    static $password;

    return [
        'username'          => $faker->name,
        'email'             => $faker->safeEmail,
        'password'          => $password ?: $password = bcrypt('admin'),
        'remember_token'    => str_random(10),
    ];
});
