<x-user-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class=" text-2xl">
                    Modifier un post
                </div>
            </div>

            <div class="text-gray-500">
                <!-- Formulaire de post -->
                <form method="POST" action="{{ route('posts.update', $post) }}" class="flex flex-col space-y-4">

                    @csrf <!-- Token CSRF Laravel -->
                    @method('PUT')

                    <!-- Champ pour la description du post -->
                    <div>
                        <x-input-label for="description" :value="__('Description')" />
                        <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                      :value="old('description', $post->description)" autofocus />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>

                    <!-- Champ pour la localisation du post -->
                    <div>
                        <x-input-label for="localisation" :value="__('Localisation')" />
                        <x-text-input id="localisation" class="block mt-1 w-full" type="text" name="localisation"
                                      :value="old('localisation', $post->localisation)" />
                        <x-input-error :messages="$errors->get('localisation')" class="mt-2" />
                    </div>

                    <!-- Champ pour l'ajout d'une image -->
                    <div>
                        <x-input-label for="image_url" :value="__('Image URL')" />
                        <x-text-input id="image_url" class="block mt-1 w-full" type="text" name="image_url"
                                      :value="old('image_url', $post->image_url)" />
                        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
                    </div>


                    <!-- Bouton d'envoie du formulaire -->
                    <div class="flex justify-end">
                        <x-primary-button type="submit">
                            {{ __('Modifier') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-user-layout>
