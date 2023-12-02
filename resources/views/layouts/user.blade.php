<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'instagram') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased bg-gray-100 min-h-screen flex items-center justify-center">
<div class="container mx-auto">
    <div class="flex flex-col items-center space-y-10">
        <nav class="flex justify-between items-center py-4 w-full">
            <a href="/" class="group font-bold text-4xl flex items-center space-x-4 hover:text-emerald-600 transition">
                <x-application-logo class="w-10 h-10 fill-current text-gray-500 group-hover:text-emerald-500 transition" />
                <span class="font-serif">InstaMath</span>
            </a>

            <a href="{{ route('posts.create') }}" class="text-black hover:underline">Créer un post</a>

            <div class="flex items-center space-x-4">
                <a href="{{ route('profile.update') }}" class="flex items-center font-medium text-gray-600 hover:text-gray-500 transition">
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="Photo de profil" class="w-10 h-10 rounded-full">
                    {{ Auth::user()->name }}
                </a>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="font-medium text-gray-600 hover:text-gray-500 transition">Déconnexion</button>
                </form>
            </div>
        </nav>

        <main class="flex justify-center items-center w-full">
            <div class="grid grid-cols-1 gap-8 max-w-screen-md w-full">
                {{ $slot }}
            </div>
        </main>
    </div>
</div>
</body>

</html>
