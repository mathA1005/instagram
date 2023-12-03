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

<body class="font-sans text-gray-900 antialiased">
    <div class="container mx-auto flex flex-col space-y-10">
        <!-- Barre de navigation -->
        <nav class="flex justify-between items-center py-2">
            <div>
                <a href="/" class="group font-bold text-4xl flex items-center space-x-4 hover:text-gray-500 transition">
                    <x-application-logo class="w-10 h-10 fill-current text-gray-500 group-hover:text-gray-500 transition" />
                    <span class="font-serif">InstaMath</span>
                </a>

            </div>
            <!-- Liens de connexion et inscription -->
            <div class="flex items-center space-x-4">
                    <a href="{{ route('login') }}"
                       class="font-medium text-gray-600 hover:text-gray-500 transition">Login</a>
                    <a href="{{ route('register') }}"
                       class="font-medium text-gray-600 hover:text-gray-500 transition">Register</a>
            </div>


        </nav>
        <!-- Contenu principal de la page -->
        <main>
            <div class="grid grid-cols-1">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>
