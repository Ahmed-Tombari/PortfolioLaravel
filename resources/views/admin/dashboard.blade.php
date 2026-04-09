@extends('admin.layout.main')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Aurora Overview')

@section('content')
@php
    $heroCount = \App\Models\Hero::count();
    $categoryCount = \App\Models\Category::count();
    $productCount = \App\Models\Product::count();

    $categoriesList = \App\Models\Category::withCount('products')->get();
    $catNames = $categoriesList->pluck('name')->toArray();
    $catCounts = $categoriesList->pluck('products_count')->toArray();
@endphp

<style>
/* Counter animation */
@keyframes countUp {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}
.count-num { animation: countUp 0.6s cubic-bezier(0.4,0,0.2,1) both; }

/* Progress bar */
@keyframes progress-fill {
    from { width: 0; }
}
.progress-bar { animation: progress-fill 1.2s 0.5s cubic-bezier(0.4,0,0.2,1) both; }

/* Floating orb */
@keyframes orb-float {
    0%,100% { transform: translate(0,0) scale(1); }
    33%      { transform: translate(8px,-12px) scale(1.05); }
    66%      { transform: translate(-6px,6px) scale(0.97); }
}

/* Rotating ring */
@keyframes ring-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

.card-animate { animation: fadeInUp 0.5s ease both; }
.card-animate:nth-child(1) { animation-delay: 0s; }
.card-animate:nth-child(2) { animation-delay: 0.08s; }
.card-animate:nth-child(3) { animation-delay: 0.16s; }

/* Activity ring */
.ring-animate { animation: ring-spin 12s linear infinite; }
</style>

<div class="space-y-8 pb-12">

    {{-- ─── Greeting Hero Banner ─── --}}
    <div class="greeting-section animate-fade-up">
        <!-- Decorative orbs -->
        <div class="absolute top-6 right-20 w-20 h-20 rounded-full bg-white/5" style="animation: orb-float 7s ease-in-out infinite;"></div>
        <div class="absolute bottom-4 right-6 w-10 h-10 rounded-full bg-white/8" style="animation: orb-float 5s ease-in-out infinite reverse;"></div>

        <div class="relative z-10 flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div>
                <p class="text-purple-200/80 text-sm font-medium mb-1">👋 Welcome back</p>
                <h2 class="text-3xl font-bold text-white mb-2">
                    {{ explode(' ', Auth::user()->name)[0] }}
                </h2>
                <p class="text-white/60 text-sm max-w-md">
                    Your portfolio is looking great. Here's a quick snapshot of everything in your studio.
                </p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.product.create') }}"
                   class="flex items-center gap-2 px-5 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur text-white text-sm font-semibold rounded-xl border border-white/25 transition-all hover:scale-105">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Project
                </a>
            </div>
        </div>

        <!-- Stats row inside banner -->
        <div class="relative z-10 mt-8 flex flex-row items-center bg-black/10 rounded-2xl p-5 border border-white/10 shadow-inner">
            <div class="text-center flex-1">
                <p class="text-3xl font-bold text-white count-num">{{ $productCount }}</p>
                <p class="text-white/55 text-xs font-medium mt-0.5">Projects</p>
            </div>
            <div class="text-center flex-1 border-x border-white/15">
                <p class="text-3xl font-bold text-white count-num" style="animation-delay:0.1s">{{ $categoryCount }}</p>
                <p class="text-white/55 text-xs font-medium mt-0.5">Categories</p>
            </div>
            <div class="text-center flex-1">
                <p class="text-3xl font-bold text-white count-num" style="animation-delay:0.2s">{{ $heroCount > 0 ? '✓' : '—' }}</p>
                <p class="text-white/55 text-xs font-medium mt-0.5">Hero Active</p>
            </div>
        </div>
    </div>

    {{-- ─── Stat Cards Row ─── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        {{-- Total Projects --}}
        <div class="stat-card stat-card-violet card-animate">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-white/60 text-xs font-semibold uppercase tracking-widest mb-1">Total Projects</p>
                    <h2 class="text-4xl font-black text-white leading-none count-num">{{ $productCount }}</h2>
                </div>
                <div class="stat-icon-box">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-9 5.25-9-5.25v-2.25"/>
                    </svg>
                </div>
            </div>
            <!-- Progress -->
            <div class="h-1 bg-white/20 rounded-full mb-3 overflow-hidden">
                <div class="h-full bg-white/60 rounded-full progress-bar" style="width: {{ min(100, $productCount * 10) }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-white/60 text-xs">Portfolio capacity</span>
                <a href="{{ route('admin.product.index') }}"
                   class="text-white/80 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                    View all <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Categories --}}
        <div class="stat-card stat-card-indigo card-animate">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-white/60 text-xs font-semibold uppercase tracking-widest mb-1">Categories</p>
                    <h2 class="text-4xl font-black text-white leading-none count-num" style="animation-delay:0.08s">{{ $categoryCount }}</h2>
                </div>
                <div class="stat-icon-box">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6h.008v.008H6V6z"/>
                    </svg>
                </div>
            </div>
            <div class="h-1 bg-white/20 rounded-full mb-3 overflow-hidden">
                <div class="h-full bg-white/60 rounded-full progress-bar" style="width: {{ min(100, $categoryCount * 15) }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-white/60 text-xs">Active groupings</span>
                <a href="{{ route('admin.category.index') }}"
                   class="text-white/80 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                    Manage <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        {{-- Hero Status --}}
        <div class="stat-card {{ $heroCount > 0 ? 'stat-card-rose' : 'stat-card-amber' }} card-animate">
            <div class="flex items-start justify-between mb-4">
                <div>
                    <p class="text-white/60 text-xs font-semibold uppercase tracking-widest mb-1">Hero Section</p>
                    <h2 class="text-4xl font-black text-white leading-none count-num" style="animation-delay:0.16s">
                        {{ $heroCount > 0 ? 'Live' : 'Empty' }}
                    </h2>
                </div>
                <div class="stat-icon-box">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                    </svg>
                </div>
            </div>
            <div class="h-1 bg-white/20 rounded-full mb-3 overflow-hidden">
                <div class="h-full bg-white/60 rounded-full progress-bar" style="width: {{ $heroCount > 0 ? '100' : '0' }}%"></div>
            </div>
            <div class="flex items-center justify-between">
                @if($heroCount == 0)
                    <a href="{{ route('admin.hero.create') }}"
                       class="text-white/80 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                        + Add Hero Section
                    </a>
                @else
                    <span class="text-white/60 text-xs">Configured & active</span>
                    <a href="{{ route('admin.hero.index') }}"
                       class="text-white/80 hover:text-white text-xs font-semibold flex items-center gap-1 transition-colors">
                        Edit <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- ─── Charts Section ─── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 animate-fade-up-3">

        {{-- Performance Chart --}}
        <div class="lg:col-span-2 craftable-card p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-base font-bold text-slate-800">Portfolio Performance</h3>
                    <p class="text-xs text-slate-400 font-medium mt-0.5">Monthly project activity</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="px-3 py-1.5 bg-gradient-to-r from-violet-50 to-indigo-50 text-violet-700 rounded-xl text-xs font-semibold border border-violet-100">
                        Last 8 months
                    </span>
                </div>
            </div>
            <div id="auroraPerformanceChart" class="min-h-[280px]"></div>
        </div>

        {{-- Donut Chart --}}
        <div class="lg:col-span-1 craftable-card p-6 flex flex-col">
            <div class="mb-5">
                <h3 class="text-base font-bold text-slate-800">Categories</h3>
                <p class="text-xs text-slate-400 font-medium mt-0.5">Project distribution</p>
            </div>

            <div id="auroraDistributionChart" class="flex-1 flex items-center justify-center min-h-[180px]"></div>

            <div class="space-y-3 mt-4 pt-4 border-t border-slate-100">
                @php
                    $dotColors = ['#a855f7','#6366f1','#ec4899','#0ea5e9','#10b981'];
                @endphp
                @foreach($categoriesList->take(4) as $i => $cat)
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-2.5 h-2.5 rounded-full flex-shrink-0" style="background: {{ $dotColors[$i % count($dotColors)] }}"></div>
                        <span class="text-sm font-medium text-slate-600 truncate max-w-[120px]">{{ $cat->name }}</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-bold text-slate-800">{{ $cat->products_count }}</span>
                        <span class="text-xs text-slate-400">items</span>
                    </div>
                </div>
                @endforeach
                @if($categoriesList->isEmpty())
                <p class="text-xs text-slate-400 text-center py-2">No categories yet</p>
                @endif
            </div>
        </div>
    </div>

    {{-- ─── Quick Actions ─── --}}
    <div class="animate-fade-up-4">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Quick Actions</h3>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <a href="{{ route('admin.product.create') }}"
               class="craftable-card p-5 flex items-center gap-4 group cursor-pointer hover:border-violet-200">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center text-violet-600 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4v16m8-8H4"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-violet-700 transition-colors">Add Project</p>
                    <p class="text-xs text-slate-400 mt-0.5">Create new portfolio item</p>
                </div>
            </a>

            <a href="{{ route('admin.category.create') }}"
               class="craftable-card p-5 flex items-center gap-4 group cursor-pointer hover:border-indigo-200">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-100 to-blue-100 flex items-center justify-center text-indigo-600 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 10.5v6m3-3H9m4.06-7.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">New Category</p>
                    <p class="text-xs text-slate-400 mt-0.5">Organize your work</p>
                </div>
            </a>

            <a href="{{ route('admin.hero.index') }}"
               class="craftable-card p-5 flex items-center gap-4 group cursor-pointer hover:border-rose-200">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center text-rose-500 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-rose-600 transition-colors">Hero Section</p>
                    <p class="text-xs text-slate-400 mt-0.5">Manage hero banners</p>
                </div>
            </a>

            <a href="{{ route('home') }}" target="_blank"
               class="craftable-card p-5 flex items-center gap-4 group cursor-pointer hover:border-sky-200">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-sky-100 to-cyan-100 flex items-center justify-center text-sky-500 group-hover:scale-110 transition-transform duration-300 flex-shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 group-hover:text-sky-600 transition-colors">View Website</p>
                    <p class="text-xs text-slate-400 mt-0.5">Open frontend live</p>
                </div>
            </a>

        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // ─── Color palette ───
        const palette = {
            violet: '#a855f7',
            indigo: '#6366f1',
            rose:   '#ec4899',
            sky:    '#0ea5e9',
            teal:   '#14b8a6',
        };
        const textColor = '#64748b';
        const gridColor = '#f1f5f9';

        // ─── Performance Chart ───
        const perfOptions = {
            series: [{
                name: 'Projects Added',
                data: [12, 24, 18, 38, 29, 52, 43, {{ $productCount > 0 ? $productCount : 28 }}]
            }, {
                name: 'Category Growth',
                data: [4, 6, 5, 9, 7, 11, 10, {{ $categoryCount > 0 ? $categoryCount : 6 }}]
            }],
            chart: {
                type: 'area',
                height: 280,
                toolbar: { show: false },
                background: 'transparent',
                fontFamily: 'Inter, sans-serif',
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 900,
                    animateGradually: { enabled: true, delay: 150 }
                }
            },
            stroke: { curve: 'smooth', width: [2.5, 2] },
            fill: {
                type: ['gradient', 'gradient'],
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: [0.25, 0.15],
                    opacityTo:   [0.0,  0.0],
                    stops: [0, 85, 100]
                }
            },
            colors: [palette.violet, palette.indigo],
            grid: {
                borderColor: gridColor,
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } },
                padding: { top: 0, right: 4, bottom: 0, left: 4 }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: textColor, fontWeight: '600', fontSize: '11px' } }
            },
            yaxis: {
                labels: { style: { colors: textColor, fontWeight: '600', fontSize: '11px' } }
            },
            markers: {
                size: [4, 4],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: { size: 7 }
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right',
                fontWeight: 600,
                fontSize: '12px',
                labels: { colors: textColor }
            },
            tooltip: {
                theme: 'light',
                style: { fontSize: '12px', fontFamily: 'Inter, sans-serif' }
            }
        };

        const perfChart = new ApexCharts(document.querySelector("#auroraPerformanceChart"), perfOptions);
        perfChart.render();

        // ─── Donut Chart ───
        const series = {!! json_encode($catCounts) !!};
        const labels = {!! json_encode($catNames) !!};

        const distOptions = {
            series: series.length > 0 ? series : [1],
            chart: {
                type: 'donut',
                width: '100%',
                height: 200,
                fontFamily: 'Inter, sans-serif',
                animations: { enabled: true, easing: 'easeinout', speed: 900 }
            },
            labels: labels.length > 0 ? labels : ['No data'],
            colors: [palette.violet, palette.indigo, palette.rose, palette.sky, palette.teal],
            stroke: { show: false },
            dataLabels: { enabled: false },
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '82%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Projects',
                                fontWeight: 800,
                                fontSize: '13px',
                                color: '#334155',
                                formatter: function (w) {
                                    return series.length > 0
                                        ? w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                        : 0;
                                }
                            }
                        }
                    }
                }
            },
            tooltip: {
                theme: 'light',
                style: { fontSize: '12px', fontFamily: 'Inter, sans-serif' }
            }
        };

        const distChart = new ApexCharts(document.querySelector("#auroraDistributionChart"), distOptions);
        distChart.render();
    });
</script>
@endsection
