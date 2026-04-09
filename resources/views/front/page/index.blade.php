@extends('front.layout.main')

@section('title', 'Welcome')

@section('content')
    @include('front.section.hero')
    
    @include('front.section.trust_bar')

    <section id="portfolio-home" class="py-32 bg-zinc-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 relative z-10 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'">
            <span class="text-primary-600 font-semibold uppercase tracking-widest text-sm mb-4 block">Our Portfolio</span>
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight">Featured <span class="text-slate-400">Creations.</span></h2>
            <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-lg md:text-xl font-light leading-relaxed">A specialized glimpse into our most impactful digital architecture and design experiments.</p>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @include('front.section.products')
        </div>
        
        <div class="text-center mt-20 pb-8" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up delay-300' : 'opacity-0 translate-y-8'">
            <a href="{{ route('portfolio') }}" class="inline-flex items-center justify-center px-10 py-4 bg-slate-900 dark:bg-primary-600 text-white rounded-full font-bold uppercase tracking-widest text-[10px] shadow-lg transition-all duration-300 hover:shadow-premium hover:-translate-y-1">
                View All Projects
            </a>
        </div>
    </section>

    @include('front.section.services_summary')

    @include('front.section.process')

    @include('front.section.faq')

    <!-- About Small Section -->
    <section id="about" class="py-32 bg-white dark:bg-slate-950 relative z-10 overflow-hidden border-t border-slate-100 dark:border-slate-900 transition-colors duration-300">
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-primary-900/5 via-slate-900/0 to-slate-900/0 dark:from-primary-900/10 dark:via-slate-950/0 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="flex flex-col md:flex-row gap-20 items-center" x-data="{ intersecting: false }" x-intersect.once="intersecting = true">
                <div class="w-full md:w-5/12 transition-all duration-1000 ease-out" :class="intersecting ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-12'">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary-600 to-indigo-400 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                        <img src="https://images.unsplash.com/photo-1542382103-6059d64380ae?q=80&w=2670&auto=format&fit=crop" class="relative w-full aspect-[4/5] object-cover rounded-[2rem] border border-slate-200 dark:border-slate-800 shadow-premium" alt="About Me Workspace">
                        <div class="absolute bottom-6 -right-6 bg-white/90 backdrop-blur-md dark:bg-slate-900/90 p-5 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-xl" :class="intersecting ? 'animate-fade-in-up delay-700' : 'opacity-0'">
                            <p class="text-[10px] text-slate-500 dark:text-slate-400 uppercase tracking-widest font-bold mb-1">Status</p>
                            <p class="text-sm font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full bg-primary-500 shadow-[0_0_8px_rgba(99,102,241,0.8)] animate-pulse"></span>
                                Available
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-7/12 transition-all duration-1000 delay-300 ease-out" :class="intersecting ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-12'">
                    <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight">
                        Transforming Ideas <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-slate-600 to-slate-400 dark:from-slate-400 dark:to-slate-200">Into Reality.</span>
                    </h2>
                    <p class="text-slate-600 dark:text-slate-300 text-lg mb-10 leading-relaxed font-light">
                        I am a full-stack developer passionate about building scalable, maintainable, and visually stunning applications. With expertise in Laravel, modern JavaScript, and elite UI/UX design, I bridge the gap between imagination and execution.
                    </p>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white dark:bg-slate-900/50 p-6 rounded-[2rem] border border-slate-200 dark:border-slate-800/50 hover:border-primary-500/30 transition-colors group shadow-sm hover:shadow-md">
                            <h4 class="text-slate-900 dark:text-white text-4xl font-light mb-2 group-hover:scale-105 transition-transform origin-left">5<span class="text-primary-600 font-bold">+</span></h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Years Experience</p>
                        </div>
                        <div class="bg-white dark:bg-slate-900/50 p-6 rounded-[2rem] border border-slate-200 dark:border-slate-800/50 hover:border-primary-500/30 transition-colors group shadow-sm hover:shadow-md">
                            <h4 class="text-slate-900 dark:text-white text-4xl font-light mb-2 group-hover:scale-105 transition-transform origin-left">50<span class="text-primary-600 font-bold">+</span></h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Projects Completed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
