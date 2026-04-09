@extends('front.layout.main')

@section('title', 'Portfolio Showcase')

@section('content')
    {{-- ─── Hero ─── --}}
    <section class="relative pt-40 pb-20 overflow-hidden bg-zinc-50 dark:bg-slate-950 transition-colors duration-300">

        <!-- Subtle background grid -->
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]"
             style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(90deg, currentColor 1px, transparent 1px); background-size: 60px 60px; color: #64748b;">
        </div>

        <!-- Soft indigo glow -->
        <div class="absolute bottom-0 right-1/4 w-[500px] h-[400px] bg-primary-600/5 dark:bg-primary-600/10 blur-[140px] rounded-full pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-10">
                <div>
                    <span class="hero-fade-in block text-sm font-semibold uppercase tracking-wider text-primary-600 mb-4" style="animation-delay:0.1s">Portfolio Showcase</span>
                    <h1 class="hero-fade-in text-5xl sm:text-6xl md:text-[6rem] font-bold text-slate-900 dark:text-white leading-[1.1] tracking-tight" style="animation-delay:0.2s">
                        My Latest<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-400 dark:from-primary-400 dark:to-indigo-300">Creations.</span>
                    </h1>
                </div>
                <p class="hero-fade-in max-w-xs text-slate-600 dark:text-slate-400 text-lg font-light leading-relaxed md:mb-5" style="animation-delay:0.35s">
                    High-precision digital projects engineered with obsessive attention to user experience and clean code.
                </p>
            </div>

            <!-- Animated Divider -->
            <div class="hero-fade-in mt-20 flex items-center gap-6" style="animation-delay:0.5s">
                <span class="text-xs font-medium uppercase tracking-widest text-slate-500">From 2020 'til today</span>
                <div class="flex-1 h-[1px] bg-gradient-to-r from-slate-200 dark:from-slate-800 to-transparent">
                </div>
            </div>
        </div>
    </section>

    {{-- ─── Products List ─── --}}
    <div class="bg-zinc-50 dark:bg-slate-950 pb-20 transition-colors duration-300">
        @include('front.section.products')
    </div>

    {{-- ─── CTA ─── --}}
    <section class="bg-zinc-50 dark:bg-slate-950 pb-32 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" x-data="{ intersecting: false }" x-intersect="intersecting = true">
            <div class="relative overflow-hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2.5rem] p-12 md:p-24 transition-all duration-1000 shadow-premium" :class="intersecting ? 'opacity-100 scale-100' : 'opacity-0 scale-95'">
                <!-- Glow -->
                <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-primary-600/5 dark:bg-primary-600/10 blur-[120px] rounded-full translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>

                <div class="relative z-10 flex flex-col md:flex-row items-start md:items-end justify-between gap-10">
                    <div>
                        <span class="text-sm font-semibold uppercase tracking-wider text-primary-600 mb-4 block">Ready to collaborate?</span>
                        <h2 class="text-4xl md:text-6xl font-bold text-slate-900 dark:text-white tracking-tight leading-tight">
                            Let's Build<br><span class="text-primary-600">Together.</span>
                        </h2>
                    </div>
                    <a href="mailto:hello@portfolio.com"
                       class="group relative shrink-0 px-8 py-4 bg-slate-900 dark:bg-primary-600 text-white rounded-full font-semibold tracking-wide overflow-hidden transition-all duration-300 shadow-sm hover:shadow-premium hover:-translate-y-1">
                        <span class="relative z-10 flex items-center gap-2">Get in Touch <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></span>
                        <div class="absolute inset-0 bg-white/20 -translate-x-full group-hover:translate-x-full transition-transform duration-700"></div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
