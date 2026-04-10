<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Premium Portfolio') | Professional Profile</title>
    <meta name="description" content="Professional Portfolio built with Laravel 12">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Vite Directives -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')

    <!-- Dark Mode Initializer (Prevents Flicker) -->
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        @keyframes heroFadeInUp {
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0);    }
        }
        .hero-fade-in {
            animation: heroFadeInUp 0.7s ease both;
        }
        .noise-bg::after {
            content: "";
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            opacity: 0.025;
            z-index: 9999;
            /* CSS-generated noise — no external dependency */
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-repeat: repeat;
            background-size: 200px 200px;
        }
        .mesh-gradient {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            z-index: -1;
            opacity: 0.4;
            filter: blur(100px);
            background:
                radial-gradient(circle at 0% 0%, rgba(99, 102, 241, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 100% 100%, rgba(129, 140, 248, 0.12) 0%, transparent 50%),
                radial-gradient(circle at 50% 50%, rgba(245, 243, 255, 0.08) 0%, transparent 50%);
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-900 bg-zinc-50 dark:bg-slate-950 dark:text-slate-100 transition-colors duration-300 noise-bg" x-data="{ scrolled: false, mobileMenuOpen: false }" @scroll.window="scrolled = (window.pageYOffset > 50)" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">
    <div class="mesh-gradient"></div>

    <!-- Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-[2px] z-[60]">
        <div class="h-full bg-primary-600 transition-all duration-150" x-data="{ progress: 0 }" @scroll.window="progress = (window.pageYOffset / (document.documentElement.scrollHeight - window.innerHeight)) * 100" :style="'width: ' + progress + '%'"></div>
    </div>
    
    <!-- Navigation -->
    <nav :class="{ 'bg-white/70 dark:bg-slate-900/80 backdrop-blur-xl shadow-premium': scrolled, 'bg-transparent': !scrolled }" class="fixed w-full z-50 transition-all duration-300 border-b border-transparent" :style="scrolled ? 'border-color: rgba(99, 102, 241, 0.05)' : ''">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold tracking-tighter text-slate-900 dark:text-white hover:text-primary-600 transition-colors">
                        PORTFOLIO<span class="text-primary-600">.</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-primary-600 transition-colors {{ request()->routeIs('home') ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">Home</a>
                    <a href="{{ route('about') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-primary-600 transition-colors {{ request()->routeIs('about') ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">About</a>
                    <a href="{{ route('services') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-primary-600 transition-colors {{ request()->routeIs('services') ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">Services</a>
                    <a href="{{ route('portfolio') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-primary-600 transition-colors {{ request()->routeIs('portfolio') ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">Portfolio</a>
                    <a href="{{ route('contact') }}" class="text-xs font-semibold uppercase tracking-widest hover:text-primary-600 transition-colors {{ request()->routeIs('contact') ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">Contact</a>
                    
                    
                    <!-- Localization Switcher -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" 
                                class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-all duration-300 border border-transparent flex items-center gap-1.5"
                                aria-label="Language Switcher">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 9.198 15.298 6 18" /></svg>
                            <span class="text-[10px] font-bold uppercase tracking-widest">{{ app()->getLocale() }}</span>
                        </button>
                        <!-- Dropdown Menu -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             class="absolute right-0 mt-2 w-48 bg-white/90 dark:bg-slate-900/90 backdrop-blur-xl border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-premium py-2 px-2 z-[60]">
                            <a href="{{ route('set.locale', ['locale' => 'en']) }}" class="flex items-center gap-3 px-4 py-3 text-xs font-semibold uppercase tracking-widest rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'en' ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">
                                <span class="text-base text-black dark:text-white">🇺🇸</span> {{ __('English') }}
                            </a>
                            <a href="{{ route('set.locale', ['locale' => 'fr']) }}" class="flex items-center gap-3 px-4 py-3 text-xs font-semibold uppercase tracking-widest rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'fr' ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">
                                <span class="text-base text-black dark:text-white">🇫🇷</span> {{ __('French') }}
                            </a>
                            <a href="{{ route('set.locale', ['locale' => 'ar']) }}" class="flex items-center gap-3 px-4 py-3 text-xs font-semibold uppercase tracking-widest rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'ar' ? 'text-primary-600' : 'text-slate-600 dark:text-slate-300' }}">
                                <span class="text-base text-black dark:text-white">🇸🇦</span> {{ __('Arabic') }}
                            </a>
                        </div>
                    </div>

                    <!-- Theme Switcher -->
                    <button @click="darkMode = !darkMode" 
                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-all duration-300 border border-transparent"
                            aria-label="Toggle Dark Mode">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>

                    @auth
                        <a href="{{ route('dashboard') }}" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 dark:bg-white dark:hover:bg-slate-100 text-white dark:text-slate-900 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-lg transition-transform hover:-translate-y-0.5 ml-4">
                            {{ __('Dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2.5 bg-slate-900 hover:bg-slate-800 dark:bg-white dark:hover:bg-slate-100 text-white dark:text-slate-900 text-[10px] font-bold uppercase tracking-widest rounded-full shadow-lg transition-transform hover:-translate-y-0.5 ml-4">
                            {{ __('Log in') }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile Controls (Language + Theme) -->
                <div class="flex items-center md:hidden gap-3">
                    <a href="{{ route('set.locale', ['locale' => app()->getLocale() == 'en' ? 'fr' : (app()->getLocale() == 'fr' ? 'ar' : 'en')]) }}" class="p-2 text-xs font-bold border border-slate-200 dark:border-slate-800 rounded-xl text-slate-500 uppercase">
                        {{ app()->getLocale() == 'en' ? 'FR' : (app()->getLocale() == 'fr' ? 'AR' : 'EN') }}
                    </a>
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 transition-colors border border-transparent">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 dark:text-slate-300 hover:text-primary-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" style="display: none;"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu Panel -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden absolute w-full bg-white/95 backdrop-blur-xl dark:bg-slate-900/95 border-b border-slate-200 dark:border-slate-800 shadow-premium" style="display: none;">
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-2xl text-base font-medium {{ request()->routeIs('home') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">{{ __('Home') }}</a>
                <a href="{{ route('about') }}" class="block px-3 py-2 rounded-2xl text-base font-medium {{ request()->routeIs('about') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">{{ __('About') }}</a>
                <a href="{{ route('services') }}" class="block px-3 py-2 rounded-2xl text-base font-medium {{ request()->routeIs('services') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">{{ __('Services') }}</a>
                <a href="{{ route('portfolio') }}" class="block px-3 py-2 rounded-2xl text-base font-medium {{ request()->routeIs('portfolio') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">{{ __('Portfolio') }}</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-2xl text-base font-medium {{ request()->routeIs('contact') ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }}">{{ __('Contact') }}</a>
                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    @auth
                        <a href="{{ route('dashboard') }}" class="block w-full text-center px-5 py-2.5 bg-slate-900 text-white rounded-2xl font-medium">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="block w-full text-center px-5 py-2.5 bg-slate-900 text-white rounded-2xl font-medium">{{ __('Log in') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 pt-16 pb-8 relative overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-primary-900/5 via-transparent to-transparent opacity-50"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <!-- Brand -->
                <div>
                    <a href="{{ route('home') }}" class="text-3xl font-bold tracking-tighter text-slate-900 dark:text-white">
                        PORTFOLIO<span class="text-primary-600">.</span>
                    </a>
                    <p class="mt-4 text-slate-500 dark:text-slate-400 max-w-sm mx-auto md:mx-0">
                        Crafting digital experiences with precision, performance, and modern minimalism.
                    </p>
                </div>
                <!-- Links -->
                <div class="flex flex-col items-center md:items-start space-y-3">
                    <h4 class="text-sm font-bold uppercase tracking-widest text-slate-900 dark:text-white">Quick Links</h4>
                    <a href="{{ route('home') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-colors">Home</a>
                    <a href="{{ route('about') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-colors">About</a>
                    <a href="{{ route('services') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-colors">Services</a>
                    <a href="{{ route('portfolio') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-colors">Portfolio</a>
                    <a href="{{ route('contact') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-colors">Contact</a>
                </div>
                <!-- Contact -->
                <div class="flex flex-col items-center md:items-start space-y-3">
                    <h4 class="text-lg font-semibold text-slate-900 dark:text-white">Get in Touch</h4>
                    <p class="text-slate-500 dark:text-slate-400">hello@portfolio.com</p>
                    <p class="text-slate-500 dark:text-slate-400">+1 234 567 890</p>
                    <div class="flex space-x-4 mt-2">
                        <a href="#" class="w-10 h-10 rounded-full bg-zinc-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-primary-600 hover:text-white transition-all transform hover:scale-110">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="mt-12 pt-8 border-t border-slate-200 dark:border-slate-800 text-center text-slate-500 dark:text-slate-400 text-sm">
                &copy; {{ date('Y') }} Premium Portfolio. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Scroll to Top (Alpine) -->
    <button @click="window.scrollTo({top: 0, behavior: 'smooth'})" 
            x-show="scrolled" 
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-8"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-8"
            class="fixed bottom-8 right-8 z-50 p-3 rounded-2xl bg-primary-600 text-white shadow-premium hover:bg-primary-500 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center focus:outline-none" style="display: none;">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
    </button>

    @yield('scripts')
</body>
</html>
