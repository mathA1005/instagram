<x-user-layout>
    <h1>Liste des posts</h1>
    <ul class="grid sm:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-8">
        @foreach ($posts as $post)
            <li>
                <p>{{ $post->user->name }}</p>
                <img src="{{ asset($post->user->profile_photo_url) }}" alt="{{ $post->user->name }}'s profile photo">
                <p><a href="{{ route('posts.show', ['id' => $post->id]) }}">Voir les détails</a></p>
                <img src="{{ asset($post->image_url) }}" alt="{{ $post->description }}">
                <p>{{ $post->description }}</p>


            </li>
        @endforeach
    </ul>
</x-user-layout>
