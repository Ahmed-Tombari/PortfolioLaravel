<section id="portfolio" 
    x-data="{ 
        activeCategory: 'all',
        hoveredProject: null,
        filter(id) { this.activeCategory = id; }
    }" 
    class="transition-colors duration-500">

    <div class="max-w-7xl mx-auto">
        
        <!-- ─── Header Row ─── -->
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
            <div>
                <span class="text-primary-600 font-semibold uppercase tracking-wider text-sm mb-3 block">{{ __('Selected Works') }}</span>
                <h2 class="text-4xl md:text-5xl font-bold text-slate-900 dark:text-white tracking-tight leading-tight">
                    {{ __('My Latest') }} <span class="text-primary-600">{{ __('Creations.') }}</span>
                </h2>
            </div>

            <!-- Filter Pill Group -->
            <div class="flex flex-wrap gap-2 self-start md:self-end">
                <button @click="filter('all')"
                    :class="activeCategory === 'all'
                        ? 'bg-primary-600 text-white border-primary-600 shadow-premium'
                        : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-slate-800 hover:border-primary-400'"
                    class="px-5 py-2.5 rounded-full text-sm font-medium border transition-all duration-300">
                    {{ __('All Work') }}
                </button>
                @foreach($categories as $cat)
                <button @click="filter('{{ $cat->id }}')"
                    :class="activeCategory === '{{ $cat->id }}'
                        ? 'bg-primary-600 text-white border-primary-600 shadow-premium'
                        : 'bg-white dark:bg-slate-900 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-slate-800 hover:border-primary-400'"
                    class="px-5 py-2.5 rounded-full text-sm font-medium border transition-all duration-300">
                    {{ $cat->name }}
                </button>
                @endforeach
            </div>
        </div>

        <!-- ─── Bento Box Grid ─── -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 auto-rows-[320px]">
            @php 
                $index = 0; 
                // Bento logic: Make every 3rd item span 2 columns and 2 rows, or something similar
                // For simplicity, we can span alternating items
            @endphp
            @forelse($products as $product)
            @php 
                $isLarge = ($index % 5 === 0); // Large hero block
                $isMedium = ($index % 5 === 3); // Wide block
                $index++;
            @endphp
            <div
                x-show="activeCategory === 'all' || activeCategory === '{{ $product->category_id }}'"
                x-transition:enter="transition ease-out duration-400"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                @mouseenter="hoveredProject = {{ $product->id }}"
                @mouseleave="hoveredProject = null"
                class="group relative overflow-hidden rounded-[2rem] bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/50 cursor-pointer shadow-sm hover:shadow-premium transition-all duration-500
                    {{ $isLarge ? 'md:col-span-2 md:row-span-2' : '' }}
                    {{ $isMedium ? 'md:col-span-2' : '' }}"
            >
                <!-- Image -->
                <img
                    src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/1400x1000/e2e8f0/475569?text='.$product->title }}"
                    alt="{{ $product->title }}"
                    class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                    onerror="this.src='https://placehold.co/1400x1000/312e81/ffffff?text={{ urlencode($product->title) }}'"
                />
                
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 via-slate-900/40 to-transparent opacity-80 group-hover:opacity-100 transition-opacity duration-300"></div>

                <!-- Content -->
                <div class="absolute inset-0 p-8 flex flex-col justify-end">
                    
                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                        <!-- Category Tag -->
                        <span class="inline-block px-3 py-1 mb-4 text-xs font-semibold text-primary-50 bg-primary-600/80 backdrop-blur-md rounded-full border border-primary-400/30">
                            {{ $product->category->name }}
                        </span>

                        <h3 class="text-2xl md:text-3xl font-bold text-white tracking-tight mb-2">
                            {{ $product->title }}
                        </h3>
                        
                        <p class="text-slate-300 line-clamp-2 text-sm md:text-base font-light opacity-0 group-hover:opacity-100 transition-opacity duration-300 delay-100">
                            {{ $product->description }}
                        </p>
                    </div>

                    <!-- Arrow Link -->
                    <div class="absolute top-6 right-6 w-12 h-12 bg-white/10 backdrop-blur-md rounded-full border border-white/20 flex items-center justify-center translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <svg class="w-5 h-5 text-white transform -rotate-45 group-hover:rotate-0 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full py-24 text-center bg-white dark:bg-slate-900 rounded-[2rem] border border-slate-200 dark:border-slate-800">
                <p class="text-slate-500 text-lg font-light">{{ __('No projects yet — something great is on the way.') }}</p>
            </div>
            @endforelse
        </div>

    </div>
</section>
