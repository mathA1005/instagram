<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function feed()
    {
        $posts = Post::all();

        return view('pages.feed', [
            'posts' => $posts,
        ]);
}
}
