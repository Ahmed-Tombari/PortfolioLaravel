{{-- ─── Tech Stack Marquee ─── --}}
<section class="py-12 border-y border-slate-200 dark:border-slate-800 bg-white/30 dark:bg-slate-900/30 backdrop-blur-sm overflow-hidden relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-[10px] uppercase tracking-[0.4em] font-black text-slate-400 dark:text-slate-600 mb-8">{{ __('Powering My Solutions With') }}</p>
        
        <div class="flex flex-wrap justify-center items-center gap-12 opacity-50 grayscale hover:grayscale-0 transition-all duration-700">
            @php
                $logos = [
                    ['name' => 'Laravel', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/laravel/laravel-original.svg'],
                    ['name' => 'Tailwind', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/tailwindcss/tailwindcss-original.svg'],
                    ['name' => 'Alpine.js', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/alpinejs/alpinejs-original.svg'],
                    ['name' => 'MySQL', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/mysql/mysql-original.svg'],
                    ['name' => 'Vite', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/vite/vite-original.svg'],
                    ['name' => 'PHP', 'icon' => 'https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg'],
                ];
            @endphp
            @foreach($logos as $logo)
                <div class="flex items-center gap-3 transition-transform hover:scale-110">
                    <img src="{{ $logo['icon'] }}" alt="{{ $logo['name'] }}" class="w-8 h-8">
                    <span class="text-sm font-bold text-slate-700 dark:text-slate-400">{{ $logo['name'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
