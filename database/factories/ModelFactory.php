<?php

use App\Models\User;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;

use Faker\Generator;

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

$factory->define(User::class, function (Generator $faker) {

    static $password;

    return [
        'username'          => $faker->name,
        'email'             => $faker->safeEmail,
        'password'          => $password ?: $password = bcrypt('admin'),
        'remember_token'    => str_random(10),
    ];
});

$factory->define(Tag::class, function (Generator $faker) {
    return [
        'name'          => $faker->name,
        'slug'          => implode('-', $faker->words()),
        'description'   => $faker->text,
    ];
});

$factory->define(Category::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'sort' => $faker->numberBetween(1, 255),
    ];
});

$factory->define(Post::class, function (Generator $faker) {
    return [
        'category_id'   => '',
        'user_id'       => 1,
        'title'         => ,
        'content'       => '',
        'description'   => '',
        'sort'          => '',
        'published_at'  => '',
    ];
});
