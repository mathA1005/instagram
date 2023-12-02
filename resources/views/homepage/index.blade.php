<x-guest-layout>
    <div class="bg-black h-72 flex items-center justify-center text-white mt-4">
        <div class="text-center">
            <h1 class="text-3xl font-semibold mb-6">Bienvenue sur InstaMath</h1>
            <p>La plateforme ultime dédiée à la découverte et à l'interaction avec les créateurs visuels du monde entier.</p>
            <p>Que vous soyez passionné de photographie ou de vidéos, InstaMath offre une expérience unique qui connecte les créateurs et les amateurs d'art visuel.</p>
            <div class="mt-8 p-3">
                <a href="{{ route('register') }}" class="bg-white text-black px-4 py-2 rounded hover:bg-gray-300">Inscrivez-vous</a>
                <a href="{{ route('login') }}" class="ml-4 text-white hover:underline">Connectez-vous</a>
            </div>
        </div>
    </div>



    <div class="grid grid-cols-3 gap-4 mt-8">
        @php
            // Mélanger les posts de manière aléatoire
            $randomPosts = $posts->shuffle()->take(3);
        @endphp

        @forelse($randomPosts as $post)
            <div class="bg-white p-2 rounded-md shadow-md">
                <!-- Contenu du post -->
                <h4 class="text-lg font-semibold mb-2">{{ $post->title }}</h4>

                <!-- Image du post (format carré) -->
                <div class="w-56 h-56 overflow-hidden rounded-md mx-auto flex items-center justify-center">
                    <img src="{{ asset('storage/' . $post->image_url) }}" class="object-cover w-full h-full">
                </div>

                <!-- Description du post -->
                <p class="text-sm">{{ $post->description }}</p>

                <!-- Informations sur le post avec l'icône de cœur -->
                <div class="flex items-center justify-between mt-2 ">
                    <span class="text-gray-500 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                    <p class="text-gray-700 text-sm flex items-center">
                        &hearts; {{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}
                    </p>
                </div>
            </div>
        @empty
        <!-- Aucun post trouvé -->
            <p class="text-gray-700 text-sm">Aucun post trouvé.</p>
        @endforelse
    </div>

</x-guest-layout>
