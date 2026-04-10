{{-- ─── Process Section ─── --}}
<section class="py-32 bg-slate-900 text-white relative overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_var(--tw-gradient-stops))] from-primary-900/20 via-transparent to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="flex flex-col lg:flex-row gap-20 items-center">
            <div class="w-full lg:w-1/2" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'">
                <span class="text-primary-400 font-semibold uppercase tracking-widest text-sm mb-4 block">{{ __('How I Work') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold tracking-tight mb-8 leading-tight">
                    {{ __('A Proven Path') }} <br> {{ __('From') }} <span class="text-primary-400">{{ __('Concept to Code.') }}</span>
                </h2>
                <p class="text-slate-400 text-lg font-light leading-relaxed mb-12">
                    {{ __('I follow a structured methodology designed to ensure every project is delivered with the highest standards of quality, performance, and user delight.') }}
                </p>
                <div class="flex flex-col gap-6">
                    @php
                        $steps = [
                            ['num' => '01', 'title' => __('Discovery'), 'desc' => __('We dive deep into your goals, audience, and technical needs.')],
                            ['num' => '02', 'title' => __('Design'), 'desc' => __('Creating minimalist prototypes that focus on UX and clarity.')],
                            ['num' => '03', 'title' => __('Develop'), 'desc' => __('Writing clean, scalable code using the best modern practices.')],
                        ];
                    @endphp
                    @foreach($steps as $step)
                    <div class="flex gap-6 group">
                        <span class="text-2xl font-black text-slate-700 group-hover:text-primary-500 transition-colors duration-500 tabular-nums">{{ $step['num'] }}</span>
                        <div>
                            <h4 class="text-xl font-bold mb-1">{{ $step['title'] }}</h4>
                            <p class="text-slate-500 font-light">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="w-full lg:w-1/2 relative" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up delay-300' : 'opacity-0 translate-y-8'">
                <div class="relative rounded-[3rem] overflow-hidden border border-slate-700 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1555066931-4365d14bab8c?q=80&w=2670&auto=format&fit=crop" alt="{{ __('Development Process') }}" class="w-full h-full object-cover grayscale opacity-40 hover:grayscale-0 hover:opacity-100 transition-all duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent"></div>
                </div>
                
                <!-- Floating Card -->
                <div class="absolute -bottom-10 -left-10 p-10 bg-white dark:bg-slate-800 rounded-3xl border border-slate-200 dark:border-slate-700 shadow-premium max-w-xs transition-transform hover:-translate-y-2">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 bg-primary-100 dark:bg-primary-900/30 rounded-full flex items-center justify-center text-primary-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <h5 class="text-slate-900 dark:text-white font-bold">{{ __('Fast Delivery') }}</h5>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-light">{{ __('Optimized workflows that don\'t compromise on quality.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
