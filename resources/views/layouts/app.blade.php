<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
      :class="{ 'dark': darkMode }"
>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Portfolio') }} — Premium Experiences</title>
    <meta name="description" content="Discover a modern, premium portfolio built with Laravel and Tailwind CSS.">

    <!-- Preconnect & Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Dark Mode Initializer (Prevents Flicker) -->
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 dark:bg-slate-950 dark:text-slate-100 selection:bg-primary-500/30 selection:text-primary-900">
    
    <div class="flex flex-col min-h-screen">
        <x-navbar />

        <!-- Main Content Area -->

        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <x-footer />
    </div>


    <!-- Alpine.js Persistence Helper -->
    <div x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"></div>
</body>
</html>

