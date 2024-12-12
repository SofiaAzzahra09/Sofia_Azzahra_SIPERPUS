<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Library</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style>
            /* Include Tailwind CSS styles */
        </style>
    @endif
</head>
<body class="font-sans antialiased bg-gray-50 text-black dark:bg-gray-500 dark:text-white/50">
    <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#FF2D20] selection:text-white">
        <div class="relative w-full max-w-sm px-6 lg:max-w-md">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 text-center">
                <h1 class="text-2xl font-semibold text-black dark:text-white">Welcome to My Library</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Please log in or register to continue.</p>
                
                <div class="mt-4 space-x-4">
                    <a href="{{ route('login') }}" class="inline-block rounded-md px-4 py-2 text-white bg-[#007BFF] hover:bg-[#0056b3] transition">Log in</a>
                    <a href="{{ route('register') }}" class="inline-block rounded-md px-4 py-2 text-white bg-[#007BFF] hover:bg-[#0056b3] transition">Register</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
