<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données du formulaire
        $validatedData = $request->validate([
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|max:255',
        ]);

        // Création d'un nouveau comment
        Comment::create([
            'user_id' => auth()->user()->id,
            'post_id' => $validatedData['post_id'],
            'content' => $validatedData['content'],
        ]);

        // Redirection avec un message de succès
        return redirect()->back()->with('success', 'Comment ajouté avec succès.');
    }

    // Tu peux ajouter d'autres méthodes pour afficher, mettre à jour ou supprimer des comments si nécessaire
}
