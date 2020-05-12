<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->realText(75);
    return [
        'title' => $title,
        'slug' => Str::slug($title, '-'),
        'content' => $faker->text,
        'active' => $faker->boolean,
        'updated_at' => $faker->dateTimeBetween('-2 years')


    ];
});
