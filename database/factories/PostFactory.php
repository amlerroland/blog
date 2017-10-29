<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Models\Post::class, function (Faker $faker) {

    return [
        'title' => $faker->realText(rand(20, 50)),
        'body' => $faker->realText(rand(50, 5000)),
        'created_at' => Carbon::create(rand(2016, 2017), rand(1, 12), rand(1, 31), rand(0, 23), rand(00, 59), rand(00, 59)),
    ];
});
