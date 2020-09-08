<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    public function index()
    {
        return response()
            ->json(Comments::all());
    }

    public function store(Request $request)
    {
        return response()
            ->json(Comments::create($request->all()));
    }

    public function delete($id)
    {
        $tweet = Comments::find($id);
        if ($tweet) {
            return response()
                ->json($tweet->delete(), 200);
        }

        return response()
            ->json('Not found', 404);
    }
}
