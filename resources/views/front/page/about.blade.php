@extends('front.layout.main')

@section('title', __('About Me'))

@section('content')
    <section id="about-hero" class="relative pt-40 pb-20 overflow-hidden bg-slate-50 dark:bg-slate-950">
        <!-- Background accents -->
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(#D96704 1px, transparent 1px); background-size: 32px 32px;"></div>
        <div class="absolute top-1/4 right-0 w-[600px] h-[600px] bg-primary-600/10 blur-[150px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="hero-fade-in block text-sm font-semibold uppercase tracking-wider text-primary-600 mb-6" style="animation-delay:0.1s">{{ __('Behind The Code') }}</span>
            <h1 class="hero-fade-in text-5xl sm:text-7xl font-bold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight" style="animation-delay:0.2s">
                {{ __('The Architect Behind') }}<br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-400 dark:from-primary-400 dark:to-indigo-300">{{ __('The Screen.') }}</span>
            </h1>
            <p class="hero-fade-in text-slate-600 dark:text-slate-400 max-w-3xl mx-auto text-lg md:text-xl font-light leading-relaxed" style="animation-delay:0.35s">
                {{ __('I\'m a solution-oriented developer with a passion for building high-performance web applications. My journey started with a curiosity for how things work, and it evolved into a career dedicated to crafting modern digital excellence.') }}
            </p>
        </div>
    </section>

    <section id="experience" class="py-32 bg-zinc-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <!-- Philosophy -->
                <div class="relative bg-white dark:bg-slate-950 p-10 md:p-14 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-premium overflow-hidden transition-shadow duration-300">
                    <!-- Subtle glow -->
                    <div class="absolute -bottom-1/2 -left-1/2 w-full h-full bg-primary-600/5 blur-[100px] rounded-full pointer-events-none"></div>
                    
                    <div class="relative z-10 w-16 h-16 bg-zinc-50 dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-8 shadow-sm border border-slate-100 dark:border-slate-800">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    
                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">{{ __('My Philosophy') }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-lg leading-relaxed font-light">
                        {{ __('I believe that code is a tool for storytelling. Every project is an opportunity to solve a unique problem and create a seamless experience for the user. I prioritize clean architecture, performance, and modern minimalist design in every project I build.') }}
                    </p>
                </div>

                <!-- Stack -->
                <div class="relative bg-white dark:bg-slate-950 p-10 md:p-14 rounded-[2.5rem] border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-premium overflow-hidden transition-shadow duration-300">
                    <!-- Subtle glow -->
                    <div class="absolute -top-1/2 -right-1/2 w-full h-full bg-primary-600/5 blur-[100px] rounded-full pointer-events-none"></div>

                    <div class="relative z-10 w-16 h-16 bg-zinc-50 dark:bg-slate-900 rounded-2xl flex items-center justify-center mb-8 shadow-sm border border-slate-100 dark:border-slate-800">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>

                    <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-8">{{ __('My Stack') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @php
                            $tech = [
                                'Laravel 12', 'Vue.js 3', 'Alpine.js', 'Tailwind CSS',
                                'MySQL / SQLite', 'Redis', 'Docker', 'Vite'
                            ];
                        @endphp
                        @foreach($tech as $item)
                        <span class="px-5 py-2.5 bg-zinc-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 text-sm font-semibold rounded-xl hover:border-primary-500 hover:text-primary-600 transition-colors shadow-sm cursor-default">
                            {{ $item }}
                        </span>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
