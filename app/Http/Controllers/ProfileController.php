<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Affiche le formulaire de profil de l'utilisateur.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Met à jour les informations de profil de l'utilisateur.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Remplit le modèle User avec les données validées du formulaire
        $request->user()->fill($request->validated());
        $request->user()->bio = $request->bio;

        // Réinitialise la vérification de l'e-mail si l'adresse e-mail change
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Met à jour l'avatar de l'utilisateur.
     */
    public function updateAvatar(Request $request): RedirectResponse
    {
        // Valide la requête pour s'assurer qu'elle contient un fichier image valide (avatar)
        $request->validate([
            'avatar' => ['required', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $user = $request->user();
            // Stocke le fichier avatar dans le répertoire 'avatars' du stockage public
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->profile_photo = $path;
            $user->save();
        }

        return Redirect::route('profile.edit')->with('status', 'avatar-updated');
    }

    /**
     * Supprime le compte de l'utilisateur.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Valide le mot de passe actuel lors de la suppression du compte
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        // Déconnecte l'utilisateur
        Auth::logout();

        // Supprime le compte utilisateur
        $user->delete();

        // Invalide la session et régénère le jeton CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Affiche le profil de l'utilisateur spécifié avec ses publications et commentaires.
     */
    public function show(User $user): View
    {
        // Récupère les publications de l'utilisateur avec le nombre de commentaires
        $posts = $user
            ->posts()
            ->withCount('comments')
            ->orderByDesc('created_at')
            ->get();

        // Récupère les commentaires de l'utilisateur
        $comments = $user
            ->comments()
            ->orderByDesc('created_at')
            ->get();

        return view('profile.show', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
        ]);

    }

    /**
     * Permet à l'utilisateur authentifié de suivre un autre utilisateur.
     */
    public function follow(User $user)
    {
        auth()->user()->following()->attach($user);

        return back();
    }

    /**
     * Permet à l'utilisateur authentifié de ne plus suivre un autre utilisateur.
     */
    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user);

        return back();
    }
}
