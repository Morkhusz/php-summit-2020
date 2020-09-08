<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comments;
use Faker\Generator as Faker;

$factory->define(Comments::class, function (Faker $faker) {
    return [
        'comment' => $faker->text(140),
        'user_id' => rand(59, 108),
        'tweet_id' => rand(3, 302),
    ];
});
