<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TweetLikes;
use Faker\Generator as Faker;

$factory->define(TweetLikes::class, function (Faker $faker) {
    return [
        'user_id'   => rand(59, 108),
        'tweet_id'  => rand(3, 302),
    ];
});
