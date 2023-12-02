<x-user-layout>

    <!-- Retour vers les posts -->
    <div class="mt-6">
        <a href="{{ route('posts.index') }}" class="bg-black text-white font-bold py-2 px-4 rounded-full hover:bg-gray-800 text-xs transition duration-300">
            Retour vers les posts
        </a>
    </div>

    <div class="max-w-md mx-auto mt-10 bg-gray-100 p-8 rounded-md shadow-md">
        <div class="flex items-center mb-4">
            <x-avatar class="h-6 w-6" :user="$post->user" />
            <p class="text-gray-700 text-xs ml-2">
                <a href="{{ route('profile.show', $post->user) }}" class="text-gray-700">{{ $post->user->name }}</a>
            </p>
        </div>

        <div class="mb-4">
            <img src="{{ asset($post->image_url) }}" alt="{{ $post->description }}" class="rounded-md">
        </div>

        <p class="text-sm mb-4">{{ $post->description }}</p>



        <p class="text-gray-500 text-xs mb-2">{{ $post->created_at->diffForHumans() }}</p>

        <!-- Display Like Count -->
        <p class="text-xs mb-4">{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</p>

        <!-- Like/Unlike Buttons -->
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.like', $post) }}" method="post">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-full hover:bg-blue-700 text-xs transition duration-300">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 inline-block">
                            <path d="M12 21l-1.42-1.42C6.28 15.22 2 12.08 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.58-4.28 6.72-8.58 11.08L12 21z"></path>
                        </svg>
                        Like
                    </button>
                </form>
            @else
                <form action="{{ route('posts.unlike', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-full hover:bg-red-700 text-xs transition duration-300">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-4 h-4 inline-block">
                            <path d="M6 3L18 21M6 21l12-18"></path>
                        </svg>
                        Unlike
                    </button>
                </form>
            @endif
            </div>
        @endauth
    <!-- Comment form -->
        @auth
            <form action="{{ route('posts.comments.add', $post->id) }}" method="POST" class="max-w-md mx-auto bg-gray-100 rounded-md shadow p-4 mt-8">
                @csrf
                <div class="flex flex-col w-full">
                    <x-avatar class="h-8 w-8 mx-auto" :user="auth()->user()" />
                    <div class="text-gray-700 text-center text-xs">{{ auth()->user()->name }}</div>
                    <div class="text-gray-500 text-center text-xs">{{ auth()->user()->email }}</div>
                    <div class="text-gray-700 mt-4">
                        <textarea
                            name="content"
                            id="content"
                            placeholder="Votre commentaire"
                            class="w-full rounded-md shadow-sm border-gray-300 bg-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-xs"
                        ></textarea>
                    </div>
                    <x-input-error :messages="$errors->get('content')" class="text-center mt-2 text-xs" />
                    <x-primary-button type="submit" class="mx-auto mt-4 text-xs">
                        Ajouter un commentaire
                    </x-primary-button>
                </div>
            </form>
        @else
            <div class="flex bg-gray-100 rounded-md shadow p-4 text-gray-700 justify-between items-center">
                <span class="text-xs">Vous devez être connecté pour ajouter un commentaire</span>
                <a
                    href="{{ route('login') }}"
                    class="font-bold bg-gray-100 text-gray-700 px-4 py-2 rounded shadow-md hover:bg-gray-200 text-xs"
                >Se connecter</a>
            </div>
    @endauth

    <!-- Comments section -->
        <div class="mt-8">
            <h2 class="font-bold text-xs mb-4">Commentaires</h2>

            <!-- Comments loop -->
            <div class="space-y-4">
                @forelse ($post->comments as $comment)
                    <div class="flex bg-gray-100 rounded-md shadow p-4 space-x-4">
                        <img src="{{ asset($comment->user->profile_photo) }}" alt="{{ $comment->user->name }}'s profile photo" class="w-6 h-6 rounded-full">
                        <div class="flex flex-col justify-center">
                            <div class="text-gray-700">
                                <p class="text-gray-700 text-xs">{{ $comment->user->name }}</p>
                            </div>
                            <div class="text-gray-500 text-xs">
                                {{ $comment->created_at->diffForHumans() }}
                            </div>
                            <div class="text-gray-700 whitespace-normal overflow-hidden max-h-40 break-all text-xs">
                                {{ $comment->content }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="flex bg-gray-100 rounded-md shadow p-4 space-x-4 text-xs">
                        Aucun commentaire pour l'instant
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</x-user-layout>
