<x-user-layout>

    <!-- Barre de recherche -->
    <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
        <div class="flex items-center border border-gray-300 rounded shadow">
            <input
                type="text"
                name="search"
                id="search"
                placeholder="Rechercher un post"
                class="flex-grow px-4 py-2 focus:outline-none"
                value="{{ request()->search }}"
                autofocus
            />
            <button
                type="submit"
                class="bg-black text-white px-4 py-2 rounded-lg shadow-sm hover:bg-gray-800 transition duration-300"
            >
                Rechercher
            </button>
        </div>
    </form>


    <h1>Liste des posts</h1>

    <!-- Liste des posts -->
    <ul class="grid sm:grid-cols-1 lg:grid-cols-1 2xl:grid-cols-3 gap-8 justify-center">
    @forelse($posts as $post)
        <!-- Boucle sur chaque post -->
            <li class="w-full max-w-md mx-auto bg-white p-4 rounded-md shadow-md">
                <a class="block bg-gray-100 rounded-md shadow-md p-2 hover:shadow-lg hover:scale-105 transition" href="{{ route('posts.show', $post) }}">
                    <!-- Localisation -->
                    <p class="text-gray-700 text-xs">{{ $post->localisation }}</p>

                    <!-- Informations sur le post -->
                    <div class="flex items-center justify-between mt-2">
                        <!-- Avatar et nom de l'utilisateur -->
                        <div class="flex items-center">
                            <x-avatar class="h-6 w-6" :user="$post->user" />
                            <span class="text-gray-700 ml-2 text-xs">{{ $post->user->name }}</span>
                        </div>
                    </div>
                    <!-- Image du post -->
                    <div class="relative overflow-hidden rounded-md aspect-w-16 aspect-h-9 mt-2">
                        <img src="{{ asset('storage/' . $post->image_url) }}" alt="{{ $post->description }}" class="object-cover w-full h-full rounded-md">
                    </div>

                    <!-- Affichage du nombre de "likes" et commentaires et Date de création du post-->
                    <div class="mt-2">
                        <p class="text-gray-700 text-xs flex items-center">
                            &hearts; {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</p>
                        <span class="text-gray-500 text-xs">{{ $post->created_at->diffForHumans() }}</span>
                        <p class="text-gray-700 text-xs">{{ $post->comments->count() }} {{ Str::plural('commentaire', $post->comments->count()) }}</p>
                    </div>
                </a>
            </li>
    @empty
        <!-- Aucun post trouvé -->
            <p class="text-gray-700 text-sm">Aucun post trouvé.</p>
        @endforelse
    </ul>

    <!-- Pagination des posts -->
    <div class="mt-8 flex items-center justify-center">
        {{ $posts->links() }}
    </div>

</x-user-layout>
