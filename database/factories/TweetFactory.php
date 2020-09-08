<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tweets;
use Faker\Generator as Faker;

$factory->define(Tweets::class, function (Faker $faker) {
    return [
        'tweet' => $faker->text(140),
        'user_id' => rand(59, 108)
    ];
});
