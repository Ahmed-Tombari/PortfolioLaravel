<nav x-data="{ mobileMenuOpen: false, scrolled: false }" 
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="{ 'bg-white/80 dark:bg-slate-900/80 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 py-3': scrolled, 'bg-transparent py-5': !scrolled }"
     class="fixed top-0 w-full z-50 transition-all duration-300">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo Section -->
            <div class="flex items-center">
                <a href="{{ url('/') }}" class="flex items-center gap-2 group">
                    <div class="w-10 h-10 bg-primary-600 rounded-xl flex items-center justify-center transform group-hover:rotate-6 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">
                        PORT<span class="text-primary-600">FOLIO</span>
                    </span>
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="{{ url('/') }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Home') }}</a>
                <a href="#about" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('About') }}</a>
                <a href="#portfolio" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Portfolio') }}</a>
            </div>

            <!-- Right Side Buttons -->
            <div class="hidden md:flex items-center gap-4">
                <!-- Localization Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" 
                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:text-primary-600 transition-all duration-300 border border-transparent flex items-center gap-1.5"
                            aria-label="Language Switcher">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 9.198 15.298 6 18" /></svg>
                        <span class="text-xs font-bold uppercase">{{ app()->getLocale() }}</span>
                    </button>
                    <!-- Dropdown Menu -->
                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         class="absolute right-0 mt-2 w-48 glass-card rounded-2xl overflow-hidden focus:outline-none py-2 px-2 z-[60]">
                        <a href="{{ route('set.locale', ['locale' => 'en']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'en' ? 'text-primary-600 bg-primary-50 dark:bg-primary-950/30' : 'text-slate-600 dark:text-slate-300' }}">
                            <span class="text-base">🇺🇸</span> English
                        </a>
                        <a href="{{ route('set.locale', ['locale' => 'fr']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'fr' ? 'text-primary-600 bg-primary-50 dark:bg-primary-950/30' : 'text-slate-600 dark:text-slate-300' }}">
                            <span class="text-base">🇫🇷</span> Français
                        </a>
                        <a href="{{ route('set.locale', ['locale' => 'ar']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'ar' ? 'text-primary-600 bg-primary-50 dark:bg-primary-950/30' : 'text-slate-600 dark:text-slate-300' }}">
                            <span class="text-base">🇸🇦</span> العربية
                        </a>
                    </div>
                </div>

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" 
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-900 text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-all duration-300 border border-transparent hover:border-primary-500/20"
                        aria-label="Toggle Dark Mode">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </button>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 transition-colors">{{ __('Dashboard') }}</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 dark:text-slate-300 hover:text-primary-600 transition-colors">{{ __('Log in') }}</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary">
                                {{ __('Get Started') }}
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Mobile menu button -->
            <div class="md:hidden flex items-center">
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-slate-600 dark:text-slate-300 hover:text-primary-600 focus:outline-none transition-colors">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200" 
         x-transition:enter-start="opacity-0 -translate-y-2" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-150" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="md:hidden glass-card mx-4 mt-2 rounded-2xl overflow-hidden focus:outline-none"
         @click.away="mobileMenuOpen = false">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <div class="flex items-center justify-between px-4 py-3 mb-2">
                <span class="text-sm font-bold text-slate-900 dark:text-white uppercase tracking-wider">{{ __('Appearance') }}</span>
                <div class="flex items-center gap-2">
                    <!-- Language Selection in Mobile -->
                    <a href="{{ route('set.locale', ['locale' => app()->getLocale() == 'en' ? 'fr' : (app()->getLocale() == 'fr' ? 'ar' : 'en')]) }}" class="px-2 py-1 text-xs font-bold border border-slate-200 dark:border-slate-800 rounded-lg text-slate-500 uppercase">
                        {{ app()->getLocale() == 'en' ? 'FR' : (app()->getLocale() == 'fr' ? 'AR' : 'EN') }}
                    </a>
                    <button @click="darkMode = !darkMode" 
                            class="p-2 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 transition-colors">
                        <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                        <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </button>
                </div>
            </div>

            <a href="{{ url('/') }}" class="block px-4 py-3 text-base font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">{{ __('Home') }}</a>

            <a href="#about" class="block px-4 py-3 text-base font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">{{ __('About') }}</a>
            <a href="#portfolio" class="block px-4 py-3 text-base font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-colors">{{ __('Portfolio') }}</a>
            
            <hr class="border-slate-200 dark:border-slate-800 my-2">
            
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="block px-4 py-3 text-base font-medium text-primary-600">{{ __('Dashboard') }}</a>
                @else
                    <a href="{{ route('login') }}" class="block px-4 py-3 text-base font-medium text-slate-600 dark:text-slate-300">{{ __('Log in') }}</a>
                    @if (Route::has('register'))
                        <div class="px-4 py-3">
                            <a href="{{ route('register') }}" class="btn-primary w-full shadow-none">{{ __('Get Started') }}</a>
                        </div>
                    @endif
                @endauth
            @endif
        </div>
        </div>
    </div>
</nav>
