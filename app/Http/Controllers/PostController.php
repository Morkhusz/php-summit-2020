<?php

namespace App\Http\Controllers;

use App\TweetLikes;
use App\Tweets;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        return response()
            ->json(Tweets::with(['user', 'comments', 'comments.user', 'likes', 'likes.user'])->withCount(['comments', 'likes'])->get());
    }

    public function show($id)
    {
        $tweet = DB::table('tweets')
            ->join('users', 'tweets.user_id', '=', 'users.id')
            ->where('tweets.id', $id)
            ->select(
                'tweets.id as id', 'tweets.tweet', 'tweets.user_id',
                'users.name as author'
            )
            ->first();
        $tweet->comments = DB::table('comments')
                ->join('users AS u', 'comments.user_id', 'u.id')
                ->where('tweet_id', $tweet->id)
                ->select('comments.comment', 'u.name as author')
                ->get();
        $tweet->likes = DB::table('likes')
               ->join('users AS u', 'likes.user_id', 'u.id')
                ->where('tweet_id', $tweet->id)
                ->select('u.name as author')
                ->get();
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
