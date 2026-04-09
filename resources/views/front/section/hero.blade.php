{{-- ══════════════════════════════════════════
   HERO — Modern Minimalist
══════════════════════════════════════════ --}}
<section id="hero" class="relative min-h-screen flex flex-col lg:flex-row items-center justify-center overflow-hidden bg-zinc-50 dark:bg-slate-950 transition-colors duration-300 px-6 lg:px-20 gap-12">

    {{-- Dot-grid background --}}
    <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]"
         style="background-image: radial-gradient(currentColor 1px, transparent 1px); background-size: 32px 32px; color: #64748b;"></div>

    {{-- Indigo glow blobs --}}
    <div class="absolute top-1/4 left-1/3 w-[600px] h-[600px] bg-primary-600/10 dark:bg-primary-600/20 rounded-full blur-[140px] pointer-events-none -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-1/4 w-[400px] h-[400px] bg-indigo-400/10 dark:bg-primary-500/10 rounded-full blur-[120px] pointer-events-none"></div>

    {{-- Decorative side lines --}}
    <div class="absolute left-8 top-1/2 -translate-y-1/2 flex-col items-center gap-3 hidden xl:flex">
        <div class="w-[1px] h-24 bg-gradient-to-b from-transparent to-slate-300 dark:to-slate-700"></div>
        <div class="w-1.5 h-1.5 rounded-full bg-primary-600 animate-pulse"></div>
        <div class="w-[1px] h-24 bg-gradient-to-t from-transparent to-slate-300 dark:to-slate-700"></div>
    </div>

    <div class="max-w-4xl flex-1 relative z-10 text-center lg:text-left pt-20 lg:pt-0">
        {{-- Badge --}}
        <div class="hero-fade-in inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-primary-600 dark:text-primary-400 text-xs font-semibold uppercase tracking-widest mb-10 shadow-sm" style="animation-delay:0.1s">
            <span class="w-2 h-2 rounded-full bg-primary-500 animate-pulse shadow-[0_0_8px_rgba(99,102,241,0.6)]"></span>
            Available for Projects
        </div>

        {{-- Main Headline --}}
        <h1 class="hero-fade-in font-bold tracking-tight text-slate-900 dark:text-white mb-8 leading-[1.1]"
            style="font-size: clamp(2.5rem, 6vw, 5.5rem); animation-delay:0.2s">
            {{ $hero->title ?? 'Creative' }}<br>
            <span class="relative inline-block">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-primary-600 to-indigo-400 dark:from-primary-400 dark:via-primary-500 dark:to-indigo-300">
                    {{ $hero->subtitle ?? 'Developer' }}
                </span>
            </span>
        </h1>

        {{-- Sub-headline --}}
        <p class="hero-fade-in text-slate-600 dark:text-slate-400 max-w-2xl mx-auto lg:mx-0 text-lg md:text-xl font-light leading-relaxed mb-14" style="animation-delay:0.35s">
            Designing and building high-performance digital experiences with a focus on minimalist aesthetics and robust engineering.
        </p>

        {{-- CTA Buttons --}}
        <div class="hero-fade-in flex flex-wrap items-center justify-center lg:justify-start gap-5" style="animation-delay:0.5s">
            <a href="{{ $hero->btn_url ?? route('portfolio') }}"
               class="group relative px-8 py-3.5 bg-slate-900 dark:bg-primary-600 text-white rounded-full font-semibold tracking-wide overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5">
                <span class="relative z-10 flex items-center gap-2">
                    {{ $hero->btn_text ?? 'View My Work' }}
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </a>
            <a href="{{ route('about') }}"
               class="px-8 py-3.5 bg-white dark:bg-transparent border border-slate-200 dark:border-slate-800 hover:border-primary-600 dark:hover:border-slate-600 text-slate-900 dark:text-slate-300 hover:text-primary-600 dark:hover:text-white rounded-full font-semibold tracking-wide transition-all duration-300 shadow-sm hover:shadow-md">
                About Me
            </a>
        </div>
    </div>

    {{-- Visual Element / Image --}}
    <div class="flex-1 relative z-10 w-full max-w-[500px] aspect-square lg:aspect-auto h-auto lg:h-[600px] hero-fade-in" style="animation-delay:0.6s">
        <div class="relative w-full h-full rounded-[3rem] overflow-hidden border border-slate-200/50 dark:border-slate-800/50 shadow-2xl group">
             @php
                $heroImageUrl = ($hero && $hero->image) 
                    ? asset('storage/' . $hero->image) 
                    : 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?q=80&w=2670&auto=format&fit=crop';
             @endphp
             <img src="{{ $heroImageUrl }}" 
                  alt="Modern Visual" 
                  class="w-full h-full object-cover grayscale-[0.2] transition-transform duration-1000 group-hover:scale-105"
                  onerror="this.src='https://placehold.co/800x1000/312e81/ffffff?text=Portfolio+Visual'">
             
             <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent"></div>
             
             {{-- Floating Tech Badge --}}
             <div class="absolute bottom-8 left-8 right-8 p-6 bg-white/10 dark:bg-slate-900/40 backdrop-blur-xl border border-white/20 rounded-2xl">
                 <div class="flex items-center gap-4">
                     <div class="w-10 h-10 rounded-xl bg-primary-600 flex items-center justify-center shrink-0">
                         <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg>
                     </div>
                     <div>
                         <p class="text-[10px] uppercase tracking-widest text-primary-400 font-bold mb-0.5">Status</p>
                         <p class="text-sm text-white font-medium">Ready for new challenges</p>
                     </div>
                 </div>
             </div>
        </div>
        
        {{-- Aesthetic Glows --}}
        <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary-600/20 blur-[60px] rounded-full"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-indigo-600/20 blur-[60px] rounded-full"></div>
    </div>

    {{-- Scroll cue --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 animate-bounce opacity-40">
        <span class="text-[10px] uppercase tracking-widest text-slate-400 font-semibold">Scroll</span>
        <div class="w-[1px] h-8 bg-gradient-to-b from-slate-400 to-transparent"></div>
    </div>
</section>


