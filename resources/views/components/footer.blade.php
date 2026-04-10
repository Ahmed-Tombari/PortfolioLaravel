<footer class="bg-white dark:bg-slate-950 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
            <!-- Brand Section -->
            <div class="col-span-1 md:col-span-2">
                <a href="{{ url('/') }}" class="flex items-center gap-2 mb-6 group">
                    <div class="w-8 h-8 bg-primary-600 rounded-lg flex items-center justify-center transform group-hover:rotate-6 transition-transform duration-300">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <span class="text-lg font-bold tracking-tight text-slate-900 dark:text-white uppercase">
                        PORT<span class="text-primary-600">FOLIO</span>
                    </span>
                </a>
                <p class="text-slate-500 dark:text-slate-400 max-w-xs leading-relaxed">
                    Building premium digital experiences with a focus on clean design, performance, and user satisfaction.
                </p>
                
                <!-- Social Icons -->
                <div class="flex items-center gap-5 mt-8">
                    <a href="#" class="text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors duration-300" aria-label="GitHub">
            </div>
            
            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-slate-900 dark:text-white mb-6">{{ __('Navigation') }}</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('index') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('about') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('About') }}</a></li>
                    <li><a href="{{ route('services') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Services') }}</a></li>
                    <li><a href="{{ route('portfolio') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Portfolio') }}</a></li>
                </ul>
            </div>

            <div>
                <h4 class="text-sm font-bold uppercase tracking-widest text-slate-900 dark:text-white mb-6">{{ __('Company') }}</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('contact') }}" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Contact') }}</a></li>
                    <li><a href="#" class="text-slate-500 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">{{ __('Privacy Policy') }}</a></li>
                </ul>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-200 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-6">
            <p class="text-slate-400 text-xs font-medium">
                &copy; {{ date('Y') }} Portfolio. {{ __('All rights reserved.') }}
            </p>
            <div class="flex items-center gap-6">
                <span class="text-slate-400 text-[10px] uppercase tracking-widest font-bold">
                    {{ __('Designed with') }} <span class="text-rose-500">♥</span> {{ __('using Laravel 13') }}
                </span>
            </div>
        </div>
    </div>
</footer>
