<x-user-layout>

    <!-- Profil utilisateur -->
    <div class="flex w-full bg-gray-200 p-4 rounded-md">
        <x-avatar class="h-16 w-16" :user="$user" />
        <div class="ml-4 flex flex-col">
            <div class="text-gray-900 font-bold text-lg">{{ $user->name }}</div>
            <div class="text-gray-700 text-sm">{{ $user->email }}</div>
            <div class="text-gray-500 text-xs">
                Membre depuis {{ $user->created_at->diffForHumans() }}
            </div>

            <!-- Bouton Follow/Unfollow -->
            @auth
                @if(auth()->user()->id !== $user->id)
                    @if(auth()->user()->following->contains($user))
                        <form action="{{ route('profile.unfollow', $user) }}" method="post">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md">
                                Ne plus suivre
                            </button>
                        </form>
                    @else
                        <form action="{{ route('profile.follow', $user) }}" method="post">
                            @csrf
                            <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded-md">
                                Suivre
                            </button>
                        </form>
                    @endif
                @endif
            @endauth
        </div>
    </div>

    <!-- Galerie d'articles -->
    <div class="mt-8 space-y-8">
        <h2 class="font-bold text-2xl mb-4">Articles</h2>
        @forelse ($posts as $post)
            <div class="w-full bg-white p-4 rounded-md max-w-md mx-auto">
                <a class="block bg-gray-100 rounded-md shadow-md p-4 hover:shadow-lg hover:scale-105 transition" href="{{ route('posts.show', $post) }}">
                    <div class="relative overflow-hidden rounded-md aspect-w-16 aspect-h-9">
                        <img src="{{ asset('storage/' . $post->image_url) }}" alt="{{ $post->description }}" class="object-cover w-full h-full rounded-md">
                    </div>
                    <div class="flex items-center justify-between mt-2">
                        <div class="flex items-center">
                            <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="h-6 w-6 rounded-full">
                            <span class="text-gray-700 ml-2 text-sm">{{ $post->user->name }}</span>
                        </div>
                        <span class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 mt-1 text-sm">{{ $post->description }}</p>
                    <p class="text-gray-700 text-sm">{{ $post->localisation }}</p>
                    <p class="text-gray-700 text-sm">{{ $post->date }}</p>
                    <p class="text-gray-700 text-sm">{{ $post->comments_count }} {{ Str::plural('Comment', $post->comments_count) }}</p>
                </a>
            </div>
        @empty
            <div class="text-gray-700 bg-gray-200 p-4 rounded-md text-center">Aucun article</div>
        @endforelse
    </div>

    <!-- Commentaires -->
    <div class="mt-8 space-y-8">
        <h2 class="font-bold text-2xl mb-4">Commentaires</h2>

        <div class="flex-col space-y-4">
            @forelse ($comments as $comment)
                <div class="w-full bg-gray-200 p-4 rounded-md max-w-md mx-auto">
                    <!-- Avatar et informations du commentateur -->
                    @if ($comment->user)
                        <x-avatar class="h-10 w-10" :user="$comment->user" />
                @endif
                    <!-- Contenu du commentaire -->
                    <div class="flex flex-col justify-center w-full space-y-4">
                        <div class="flex justify-between">
                            <div class="flex space-x-4 items-center justify-center">
                                <div class="flex flex-col justify-center">
                                    <div class="text-gray-700">{{ $comment->user->name }}</div>
                                    <div class="text-gray-500 text-sm">
                                        {{ $comment->created_at->diffForHumans() }}
                                    </div>
                                </div>
                            </div>
                            <!-- Bouton de suppression du commentaire -->
                            <div class="flex justify-center">
                                @can('delete', $comment)
                                    <button
                                        x-data="{ id: {{ $comment->id }} }"
                                        x-on:click.prevent="window.selected = id; $dispatch('open-modal', 'confirm-comment-deletion');"
                                        type="submit"
                                        class="font-bold bg-gray-200 text-gray-700 px-3 py-1 rounded shadow"
                                    ></button>
                                @endcan
                            </div>
                        </div>
                        <!-- Contenu du commentaire -->
                        <div class="flex flex-col justify-center w-full text-gray-700">
                            <p class="border bg-white rounded-md p-4">
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex bg-gray-200 p-4 rounded-md text-center">Aucun commentaire pour l'instant</div>
            @endforelse
        </div>

        <!-- Modal de confirmation de suppression du commentaire -->
        <x-modal name="confirm-comment-deletion" focusable>
            <form
                method="post"
                onsubmit="event.target.action='/articles/{{ $article->id ?? 1 }}/comments/' + window.selected"
                class="p-6"
            >
                @csrf @method('DELETE')
                <h2 class="text-lg font-medium text-gray-900">
                    Êtes-vous sûr de vouloir supprimer ce commentaire ?
                </h2>
                <p class="mt-1 text-sm text-gray-600">
                    Cette action est irréversible. Toutes les données seront supprimées.
                </p>
                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Annuler
                    </x-secondary-button>
                    <x-danger-button class="ml-3" type="submit">
                        Supprimer
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>

</x-user-layout>
