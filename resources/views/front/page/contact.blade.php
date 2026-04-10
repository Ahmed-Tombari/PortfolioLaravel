@extends('front.layout.main')

@section('title', __('Get in Touch'))

@section('content')
    <section class="relative pt-40 pb-32 overflow-hidden bg-zinc-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]"
             style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(90deg, currentColor 1px, transparent 1px); background-size: 60px 60px; color: #64748b;">
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-start">
                
                {{-- Contact Info --}}
                <div>
                    <span class="hero-fade-in block text-sm font-semibold uppercase tracking-widest text-primary-600 mb-6" style="animation-delay:0.1s">{{ __('Contact Me') }}</span>
                    <h1 class="hero-fade-in text-5xl sm:text-7xl font-bold tracking-tight text-slate-900 dark:text-white mb-8 leading-tight" style="animation-delay:0.2s">
                        {{ __('Let\'s Talk') }} <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-400 dark:from-primary-400 dark:to-indigo-300">{{ __('Digital.') }}</span>
                    </h1>
                    <p class="hero-fade-in text-slate-600 dark:text-slate-400 text-lg font-light leading-relaxed mb-12 max-w-lg" style="animation-delay:0.35s">
                        {{ __('Have a project in mind or just want to say hello? Drop me a message and I\'ll get back to you within 24 hours.') }}
                    </p>

                    <div class="space-y-8">
                        <div class="flex items-center gap-6 group">
                            <div class="w-14 h-14 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 flex items-center justify-center text-primary-600 shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs uppercase tracking-widest font-black text-slate-400 dark:text-slate-600 mb-1">{{ __('Email Details') }}</h4>
                                <p class="text-lg font-bold text-slate-900 dark:text-white">hello@portfolio.com</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-6 group">
                            <div class="w-14 h-14 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 flex items-center justify-center text-primary-600 shadow-sm group-hover:shadow-md group-hover:scale-110 transition-all duration-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <div>
                                <h4 class="text-xs uppercase tracking-widest font-black text-slate-400 dark:text-slate-600 mb-1">{{ __('Office Location') }}</h4>
                                <p class="text-lg font-bold text-slate-900 dark:text-white">{{ __('Remote / Worldwide') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Form Card --}}
                <div class="hero-fade-in" style="animation-delay:0.4s">
                    <div class="bg-white dark:bg-slate-900 rounded-[3rem] p-10 md:p-14 border border-slate-200 dark:border-slate-800 shadow-premium relative">
                        <form action="#" method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-3 ml-2">{{ __('Your Name') }}</label>
                                    <input type="text" placeholder="{{ __('John Doe') }}" class="w-full bg-zinc-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-3 ml-2">{{ __('Email Address') }}</label>
                                    <input type="email" placeholder="john@example.com" class="w-full bg-zinc-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-3 ml-2">{{ __('Subject') }}</label>
                                <input type="text" placeholder="{{ __('General Inquiry') }}" class="w-full bg-zinc-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 dark:text-slate-600 mb-3 ml-2">{{ __('Message') }}</label>
                                <textarea rows="6" placeholder="{{ __('Tell me about your project...') }}" class="w-full bg-zinc-50 dark:bg-slate-950 border border-slate-100 dark:border-slate-800 rounded-2xl px-6 py-4 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary-600/20 focus:border-primary-600 transition-all"></textarea>
                            </div>
                            <button type="button" class="w-full py-5 bg-slate-900 dark:bg-primary-600 text-white rounded-2xl font-bold uppercase tracking-widest text-[10px] shadow-lg hover:shadow-premium transition-all transform hover:-translate-y-1 active:scale-95">
                                {{ __('Send Message') }}
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
