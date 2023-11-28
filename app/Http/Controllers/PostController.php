<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Requests;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Request;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::orderByDesc('updated_at')
            ->paginate(10)
        ;

        return view(
            'posts.index',
            [
                'posts' => $posts,
            ]
        );
    }


//     /**
//      * Show the form for creating a new resource.
//      */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostStoreRequest $request)
    {
        //dd($request->all());
        $post = Post::make();
        $post->description = $request->validated()['description'];
        $post->image_url = $request->validated()['image_url'];
        $post->localisation = $request->validated()['localisation'];
        $post->date = $request->validated()['date'];
        $post->user_id = Auth::id();
        $post->save();

        return redirect()->route('posts.index');
    }

//     /**
//      * Display the specified resource.
//      */
    public function show($id){

        $post = Post::findOrFail($id);




        // Load the comments for the post, including the associated user
         $comments = $post->commentaires()

        ->with('user')

            ->orderBy('created_at')

            ->get();


        return view('posts.show', [

            'post' => $post,

            'comments' => $comments,

        ]);

    }


    /* Show the form for editing the specified resource.
    */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, Post $post)
    {

        $post->description = $request->validated()['description'];
        $post->image_url = $request->validated()['image_url'];
        $post->localisation = $request->validated()['localisation'];
        $post->date = $request->validated()['date'];
        $post->save();


        return redirect()->route('posts.index');

    }
    public function addComment(Request $request, Post $post)
    {
        // Ensure that the user is authenticated
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create a new comment associated with the post
        $comment = $post->comments()->make();

        // Set the comment body and user_id
        $comment->body = $request->input('content');
        $comment->user_id = auth()->user()->id;

        // Save the comment
        $comment->save();

        // Redirect back to the post
        return redirect()->back();
    }
}
//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Post $post)
//     {
//         //
//     }

// }
