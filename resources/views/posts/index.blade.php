<x-user-layout>
    <h1>Liste des posts</h1>
    <ul class="grid sm:grid-cols-1 lg:grid-cols-1 2xl:grid-cols-1 justify-center">
        @foreach ($posts as $post)
            <li style="max-width: 400px; margin: 0 auto;">
                <p>{{ $post->user->name }}</p>
                <img src="{{ asset($post->user->profile_photo) }}" alt="{{ $post->user->name }}'s profile photo" class="w-10 h-10 rounded-full">
                <a href="{{ route('posts.show', ['id' => $post->id]) }}">Voir les détails</a>
                <img src="{{ asset($post->image_url) }}" alt="{{ $post->description }}">
                <p>{{ $post->description }}</p>

                {{-- Afficher les commentaires --}}
                <ul class="bg-gray-300 p-4 rounded-md">
                    <h3>Commentaires :</h3>
                @foreach ($post->commentaires as $commentaire)
                        <li>
                            <img src="{{ asset($commentaire->user->profile_photo) }}" alt="{{ $commentaire->user->name }}'s profile photo" class="w-6 h-6 rounded-full">
                            <p>{{ $commentaire->user->name }} :</p>
                            <p>{{ $commentaire->content }}</p>
                            <p>Date : {{ $commentaire->date }}</p>
                        </li>
                    @endforeach
                </ul>

            {{-- Ajouter un commentaire --}}

            </li>
        @endforeach
    </ul>
</x-user-layout>

