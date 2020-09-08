<?php

namespace App\Http\Controllers;

use App\TweetLikes;
use App\Tweets;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return response()
            ->json(Tweets::with(['user', 'comments', 'comments.user', 'likes', 'likes.user'])->withCount(['comments', 'likes'])->get());
    }

    public function show($id)
    {
        $tweet = Tweets::with([
                'user:name,id', 'comments:comment,id,user_id,tweet_id',
                'comments.user:name,id', 'likes:id,user_id,tweet_id',
                'likes.user:id,name'
            ])
            ->find($id, ['tweet', 'id', 'user_id']);
        $tweet->likesCount = count($tweet->likes);
        $tweet->commentsCount = count($tweet->comments);
        return response()
            ->json($tweet);
    }

    public function store(Request $request)
    {
        return response()
            ->json(Tweets::create($request->all()));
    }

    public function like($tweet_id, Request $request)
    {
        $tweet = Tweets::find($tweet_id);
        if (!$tweet) {
            return response()
                ->json('Not found', 404);
        }

        return response()
            ->json(
                $tweet->likes()
                    ->create([
                        'tweet_id'  => $tweet_id,
                        'user_id'   => $request->user_id
                    ])
            );
    }

    public function deslike($tweet_id, $like_id)
    {
        $like = TweetLikes::where('tweet_id', $tweet_id)
            ->where('id', $like_id)
            ->first();

        if ($like) {
            return response()
                ->json($like->delete());
        }

        return response()
            ->json('Not found', 404);
    }

    public function delete($id)
    {
        $tweet = Tweets::find($id);
        if ($tweet) {
            return response()
                ->json($tweet->delete(), 200);
        }

        return response()
            ->json('Not found', 404);
    }
}
