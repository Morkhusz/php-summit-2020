<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TweetLikes extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id', 'tweet_id'
    ];

    public function tweet()
    {
        return $this->belongsTo(Tweets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
