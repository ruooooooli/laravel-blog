<?php

use App\Models\Tag;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;

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
