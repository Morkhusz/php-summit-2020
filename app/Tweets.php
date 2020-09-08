<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweets extends Model
{
    protected $table = 'tweets';
    protected $fillable = [
        'tweet', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'tweet_id', 'id');
    }

    public function likes()
    {
        return $this->hasMany(TweetLikes::class, 'tweet_id', 'id');
    }
}
