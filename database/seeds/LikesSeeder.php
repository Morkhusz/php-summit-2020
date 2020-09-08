<?php

use App\TweetLikes;
use Illuminate\Database\Seeder;

class LikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(TweetLikes::class, 1000)->create();
    }
}
