<x-user-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <div class="flex justify-between mt-8">
                <div class="text-2xl">
                    Post you InstaMeme !
                </div>
            </div>
            <!-- Formulaire de création de post -->
            <form method="POST" action="{{ route('posts.store') }}" class="flex flex-col space-y-4 text-gray-500"
                  enctype="multipart/form-data">

                @csrf <!-- Token CSRF Laravel -->

                    <!-- Champ pour la description du post -->
                <div>
                    <x-input-label for="description" :value="__('Description')" />
                    <x-text-input id="description" class="block mt-1 w-full" type="text" name="description"
                                  :value="old('description')" autofocus />
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
                    <!-- Champ pour la localisation du post -->
                    <div>
                    <x-input-label for="localisation" :value="__('Localisation')" />
                    <x-text-input id="localisation" class="block mt-1 w-full" type="text" name="localisation"
                                  :value="old('localisation')" />
                    <x-input-error :messages="$errors->get('localisation')" class="mt-2" />
                </div>

                    <!-- Champ pour la date de publication du post -->
                    <div>
                    <x-input-label for="date" :value="__('Date de publication')" />
                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                  :value="old('date')" />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                    <!-- Champ pour l'ajout d'une image -->
                <div>
                    <x-input-label for="image" :value="__('Image')" />
                    <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" />
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>

                    <!-- Bouton d'envoie du formulaire -->
                <div class="flex justify-end">
                    <x-primary-button type="submit">
                        {{ __('Créer') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-user-layout>
