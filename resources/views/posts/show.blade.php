<x-user-layout>

    <div class="max-w-2xl mx-auto mt-10 bg-white p-8 rounded-md shadow-md">
        <h2 class="text-2xl font-semibold mb-4">{{ $post->description }}</h2>

        <div class="mb-4">
            <img src="{{ asset($post->image_url) }}" alt="{{ $post->description }}">
        </div>

        <p class="text-gray-700">
            <a href="{{ route('profile.show', $post->user) }}" class="text-gray-700">{{ $post->user->name }}</a>
        </p>
        <p class="text-gray-500">{{ $post->created_at->diffForHumans() }}</p>

        <!-- Display Like Count -->
        <p>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</p>

        <!-- Like/Unlike Buttons -->
        @auth
            @if (!$post->likedBy(auth()->user()))
                <form action="{{ route('posts.like', $post) }}" method="post">
                    @csrf
                    <button type="submit" class="flex items-center gap-1 text-blue-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M12 21l-1.42-1.42C6.28 15.22 2 12.08 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.58-4.28 6.72-8.58 11.08L12 21z"></path>
                        </svg>
                        Like
                    </button>
                </form>
            @else
                <form action="{{ route('posts.unlike', $post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center gap-1 text-red-500">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-5 h-5">
                            <path d="M6 3L18 21M6 21l12-18"></path>
                        </svg>
                        Unlike
                    </button>
                </form>
        @endif
    @endauth

    <!-- retour vers les posts -->
        <div class="mt-8">
            <a href="{{ route('posts.index') }}" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                Retour vers les posts
            </a>
        </div>
    </div>

    <!-- Comment form -->
    @auth
        <form action="{{ route('posts.comments.add', $post->id) }}" method="POST" class="flex bg-white rounded-md shadow p-4 mt-8">
            @csrf
            <div class="flex justify-start items-start h-full mr-4">
                <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}'s Avatar" class="h-10 w-10 rounded-full">
            </div>

            <div class="flex flex-col w-full">
                <div class="text-gray-700">{{ auth()->user()->name }}</div>
                <div class="text-gray-500 text-sm">{{ auth()->user()->email }}</div>
                <div class="text-gray-700">
                    <textarea
                        name="content"
                        id="content"
                        placeholder="Votre commentaire"
                        class="w-full rounded-md shadow-sm border-gray-300 bg-gray-100 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 mt-4"
                    ></textarea>
                </div>

                <x-input-error :messages="$errors->get('content')" class="ml-2" />
                <x-primary-button type="submit" class="ml-2">
                    Ajouter un commentaire
                </x-primary-button>
            </div>
        </form>
    @else
        <div class="flex bg-white rounded-md shadow p-4 text-gray-700 justify-between items-center">
            <span>Vous devez être connecté pour ajouter un commentaire</span>
            <a
                href="{{ route('login') }}"
                class="font-bold bg-white text-gray-700 px-4 py-2 rounded shadow-md"
            >Se connecter</a>
        </div>
@endauth

<!-- Comments section -->
    <div class="mt-8">
        <h2 class="font-bold text-xl mb-4">Commentaires</h2>

        <!-- Comments loop -->
        <div class="flex-col space-y-4">
            @forelse ($post->comments as $comment)
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    <img src="{{ asset($comment->user->profile_photo) }}" alt="{{ $comment->user->name }}'s profile photo" class="w-6 h-6 rounded-full">
                    <div class="flex flex-col justify-center">
                        <div class="text-gray-700">
                            <p class="text-gray-700">{{ $comment->user->name }}</p>
                        </div>
                        <div class="text-gray-500">
                            {{ $comment->created_at->diffForHumans() }}
                        </div>
                        <div class="text-gray-700 whitespace-normal overflow-hidden max-h-40 break-all">
                            {{ $comment->content }}
                        </div>
                    </div>
                </div>
            @empty
                <div class="flex bg-white rounded-md shadow p-4 space-x-4">
                    Aucun commentaire pour l'instant
                </div>
            @endforelse
        </div>
    </div>

</x-user-layout>
