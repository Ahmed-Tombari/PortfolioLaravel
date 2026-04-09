{{-- ─── FAQ Section ─── --}}
<section class="py-32 relative overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-20" x-data="{ intersecting: false }" x-intersect.once="intersecting = true" :class="intersecting ? 'animate-fade-in-up' : 'opacity-0 translate-y-8'">
            <span class="text-primary-600 font-semibold uppercase tracking-widest text-[10px] mb-4 block">Quick Answers</span>
            <h2 class="text-3xl md:text-5xl font-bold tracking-tight text-slate-900 dark:text-white leading-tight">
                Common Questions.
            </h2>
        </div>

        <div class="space-y-4" x-data="{ active: null }">
            @php
                $faqs = [
                    ['q' => 'What technologies do you specialize in?', 'a' => 'I specialize in the TALL stack (Tailwind, Alpine.js, Laravel, Livewire) as well as Vue.js, React, and high-performance backend architecture with MySQL and Redis.'],
                    ['q' => 'How long does a typical project take?', 'a' => 'A small portfolio or landing page usually takes 1-2 weeks. More complex SaaS applications or platforms take 4-12 weeks depending on features.'],
                    ['q' => 'Do you offer ongoing maintenance?', 'a' => 'Yes, I provide monthly maintenance packages to ensure your application remains secure, up-to-date, and performing at its peak.'],
                ];
            @endphp
            @foreach($faqs as $i => $item)
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-[2rem] overflow-hidden transition-all duration-300 shadow-sm">
                <button 
                    @click="active === {{ $i }} ? active = null : active = {{ $i }}"
                    class="w-full px-8 py-6 flex items-center justify-between text-left focus:outline-none"
                    :class="{ 'bg-slate-50 dark:bg-slate-800/50': active === {{ $i }} }"
                >
                    <span class="text-lg font-bold text-slate-800 dark:text-white">{{ $item['q'] }}</span>
                    <svg 
                        class="w-6 h-6 text-slate-400 transition-transform duration-300" 
                        :class="{ 'rotate-180 text-primary-600': active === {{ $i }} }"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div 
                    x-show="active === {{ $i }}" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-2"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="px-8 pb-6 text-slate-600 dark:text-slate-400 font-light leading-relaxed"
                    style="display: none;"
                >
                    {{ $item['a'] }}
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
