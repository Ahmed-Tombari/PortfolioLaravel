{{-- ─── Services Summary ─── --}}
<section class="py-32 relative overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-24" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'">
            <span class="text-primary-600 font-semibold uppercase tracking-widest text-sm mb-4 block">What I Offer</span>
            <h2 class="text-4xl md:text-6xl font-bold tracking-tight text-slate-900 dark:text-white leading-tight">
                High-End Solutions <br> For <span class="text-slate-400">Digital Success.</span>
            </h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @php
                $services = [
                    [
                        'title' => 'UI/UX Design',
                        'desc' => 'Crafting intuitive, user-centric interfaces that blend beauty with functionality.',
                        'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.172-1.172a4 4 0 015.656 0l1.172 1.172a4 4 0 010 5.656l-1.172 1.172a4 4 0 01-5.656 0l-1.172-1.172a4 4 0 010-5.656z"></path></svg>',
                        'color' => 'bg-indigo-50 dark:bg-indigo-900/10 text-indigo-600'
                    ],
                    [
                        'title' => 'Web Development',
                        'desc' => 'Building scalable, performant applications using Laravel and modern front-end tech.',
                        'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>',
                        'color' => 'bg-blue-50 dark:bg-blue-900/10 text-blue-600'
                    ],
                    [
                        'title' => 'Product Strategy',
                        'desc' => 'Helping brands define their vision and technical roadmap for market domination.',
                        'icon' => '<svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>',
                        'color' => 'bg-violet-50 dark:bg-violet-900/10 text-violet-600'
                    ]
                ];
            @endphp
            @foreach($services as $index => $s)
                <div class="group p-10 rounded-[2.5rem] bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-premium hover:-translate-y-2 transition-all duration-500" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'" style="animation-delay: {{ $index * 150 }}ms;">
                    <div class="w-16 h-16 {{ $s['color'] }} rounded-2xl flex items-center justify-center mb-10 group-hover:scale-110 transition-transform duration-500">
                        {!! $s['icon'] !!}
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-4">{{ $s['title'] }}</h3>
                    <p class="text-slate-600 dark:text-slate-400 font-light leading-relaxed mb-8">
                        {{ $s['desc'] }}
                    </p>
                    <a href="{{ route('services') }}" class="inline-flex items-center gap-2 text-sm font-bold uppercase tracking-widest text-primary-600 hover:text-primary-500 transition-colors">
                        Discover More <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
