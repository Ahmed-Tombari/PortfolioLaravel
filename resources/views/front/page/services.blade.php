@extends('front.layout.main')

@section('title', 'Expert Services')

@section('content')
    {{-- ─── Services Hero ─── --}}
    <section class="relative pt-40 pb-20 overflow-hidden bg-zinc-50 dark:bg-slate-950 transition-colors duration-300">
        <div class="absolute inset-0 opacity-[0.03] dark:opacity-[0.05]"
             style="background-image: linear-gradient(currentColor 1px, transparent 1px), linear-gradient(90deg, currentColor 1px, transparent 1px); background-size: 60px 60px; color: #64748b;">
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="hero-fade-in block text-sm font-semibold uppercase tracking-widest text-primary-600 mb-6" style="animation-delay:0.1s">How I can Help</span>
            <h1 class="hero-fade-in text-5xl sm:text-7xl font-bold tracking-tight text-slate-900 dark:text-white mb-6 leading-tight" style="animation-delay:0.2s">
                Full-Stack Expertise <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-indigo-400 dark:from-primary-400 dark:to-indigo-300">Delivered.</span>
            </h1>
        </div>
    </section>

    {{-- ─── Detailed Services ─── --}}
    <section class="py-24 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                @php
                    $detailedServices = [
                        [
                            'title' => 'Custom Web Applications',
                            'tags' => ['Laravel', 'Vue.js', 'API Design'],
                            'desc' => 'Tailor-made software solutions built from the ground up. I focus on performance, security, and scalability to ensure your business logic is robust and manageable.',
                            'image' => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=800'
                        ],
                        [
                            'title' => 'Premium E-Commerce',
                            'tags' => ['Stripe', 'State Management', 'Inventory'],
                            'desc' => 'High-conversion shopping experiences with seamless checkout flows and intelligent inventory management systems.',
                            'image' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=800'
                        ],
                        [
                            'title' => 'UI/UX Visual Systems',
                            'tags' => ['Figma', 'Prototyping', 'Design Tokens'],
                            'desc' => 'More than just "pretty" design. I build comprehensive visual systems that enhance user engagement and establish brand authority.',
                            'image' => 'https://images.unsplash.com/photo-1586717791821-3f44a563eb4c?auto=format&fit=crop&w=800'
                        ],
                        [
                            'title' => 'Speed & Performance Audit',
                            'tags' => ['Core Web Vitals', 'Optimization', 'SEO'],
                            'desc' => 'Is your site slow? I perform deep audits and optimization sprints to get your Core Web Vitals into the green zone.',
                            'image' => 'https://images.unsplash.com/photo-1551288049-bbbda536339a?auto=format&fit=crop&w=800'
                        ]
                    ];
                @endphp
                @foreach($detailedServices as $s)
                <div class="group relative bg-zinc-50 dark:bg-slate-950 rounded-[3rem] p-10 border border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-premium transition-all duration-500 overflow-hidden">
                    <div class="relative z-10">
                        <div class="flex flex-wrap gap-2 mb-6">
                            @foreach($s['tags'] as $tag)
                            <span class="px-3 py-1 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 text-[10px] font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400 rounded-lg">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <h3 class="text-3xl font-bold text-slate-900 dark:text-white mb-6">{{ $s['title'] }}</h3>
                        <p class="text-slate-600 dark:text-slate-400 font-light leading-relaxed mb-8">{{ $s['desc'] }}</p>
                        
                        <div class="h-64 rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-800 mb-8 transition-all duration-500 group-hover:scale-[1.02]">
                            <img src="{{ $s['image'] }}" 
                                 alt="{{ $s['title'] }}" 
                                 class="w-full h-full object-cover"
                                 onerror="this.src='https://placehold.co/800x600/312e81/ffffff?text=Service+Preview'">
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── CTA ─── --}}
    <section class="py-32 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-primary-600 rounded-[3rem] p-12 md:p-24 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_var(--tw-gradient-stops))] from-white/20 via-transparent to-transparent"></div>
                <div class="relative z-10">
                    <h2 class="text-4xl md:text-6xl font-bold text-white mb-8 tracking-tight">Need a custom solution?</h2>
                    <p class="text-primary-100 text-lg md:text-xl font-light max-w-2xl mx-auto mb-12">Let's discuss your next project and see how my expertise can help your business grow.</p>
                    <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-10 py-4 bg-white text-primary-600 rounded-full font-bold uppercase tracking-widest text-xs shadow-xl transition-transform hover:scale-105 active:scale-95">Get a Free Quote</a>
                </div>
            </div>
        </div>
    </section>
@endsection
