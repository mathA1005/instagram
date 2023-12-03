<div {{ $attributes->merge(['class' => 'rounded-full overflow-hidden']) }}>
    <!-- Vérifie si l'utilisateur a une photo de profil -->
@if ($user->profile_photo)
    <!-- Affiche la photo de profil si elle existe -->
        <img class="aspect-square object-cover object-center" src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->name }}" />
@else
    <!-- Si l'utilisateur n'a pas de photo de profil, affiche une placeholder avec la première lettre de son nom -->
        <div class="flex items-center justify-center bg-indigo-100">
            <span class="text-2xl font-medium text-indigo-800">
                {{ $user->name[0] }}
            </span>
        </div>
    @endif
</div>

