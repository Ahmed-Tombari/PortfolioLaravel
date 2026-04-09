@extends('admin.layout.main')
@section('page_title', 'Studio')
@section('page_subtitle', 'Aurora Overview')

@section('content')
@php
    $heroCount = \App\Models\Hero::count();
    $categoryCount = \App\Models\Category::count();
    $productCount = \App\Models\Product::count();
    
    // Category distribution data
    $categoriesList = \App\Models\Category::withCount('products')->get();
    $catNames = $categoriesList->pluck('name')->toArray();
    $catCounts = $categoriesList->pluck('products_count')->toArray();
@endphp

<div class="space-y-6 lg:space-y-10 pb-12">
    
    {{-- ─── Luxury Header Greeting ─── --}}
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 py-4 lg:py-6">
        <div>
            <div class="flex items-center gap-3 mb-3 lg:mb-4">
                <div class="w-1.5 h-1.5 rounded-full bg-teal-500 animate-pulse"></div>
                <p class="text-[10px] lg:text-[11px] font-black uppercase tracking-[0.3em] text-slate-400">System Ready</p>
            </div>
            <h1 class="text-3xl lg:text-5xl font-black text-slate-900 tracking-tight leading-none">
                Bonjour, <span class="text-teal-600 font-black">{{ explode(' ', Auth::user()->name)[0] }}</span>.
            </h1>
            <p class="mt-3 lg:mt-4 text-slate-400 font-medium text-base lg:text-lg max-w-lg leading-relaxed">
                Your portfolio ecosystem is balanced. <span class="text-slate-900 font-bold">{{ $productCount }}</span> projects are performing optimally.
            </p>
        </div>
        
        <div class="flex items-center gap-3 lg:gap-4">
            <button class="px-6 lg:px-8 py-3 lg:py-4 bg-white border border-slate-100 rounded-2xl text-slate-900 font-bold text-xs lg:text-sm shadow-sm transition-all hover:bg-slate-50">Analytics</button>
            <a href="{{ route('admin.product.create') }}" class="px-6 lg:px-8 py-3 lg:py-4 aurora-gradient rounded-2xl text-white font-bold text-xs lg:text-sm shadow-xl shadow-teal-500/20 transition-all hover:scale-105 active:scale-95 text-center">
                New Project
            </a>
        </div>
    </div>

    {{-- ─── Minimalist Stats Row ─── --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
        {{-- Total Projects --}}
        <div class="aurora-card p-8 lg:p-10 flex flex-col justify-between min-h-[180px] lg:min-h-[220px]">
            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1 lg:mb-2 text-xs">Total Projects</p>
                <p class="text-3xl lg:text-4xl font-black text-slate-900 tabular-nums">{{ $productCount }}</p>
            </div>
        </div>

        {{-- Active Categories --}}
        <div class="aurora-card p-8 lg:p-10 flex flex-col justify-between min-h-[180px] lg:min-h-[220px]">
            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1 lg:mb-2 text-xs">Active Categories</p>
                <p class="text-3xl lg:text-4xl font-black text-slate-900 tabular-nums">{{ $categoryCount }}</p>
            </div>
        </div>

        {{-- Hero Configuration --}}
        <div class="aurora-card p-8 lg:p-10 flex flex-col justify-between min-h-[180px] lg:min-h-[220px] relative overflow-hidden group">
            <div class="w-10 h-10 lg:w-12 lg:h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
            </div>
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-1 lg:mb-2 text-xs">Hero Status</p>
                    <p class="text-2xl lg:text-3xl font-black {{ $heroCount > 0 ? 'text-teal-600' : 'text-rose-500' }} tracking-tight">
                        {{ $heroCount > 0 ? 'Optimal' : 'Missing' }}
                    </p>
                </div>
                @if($heroCount == 0)
                <a href="{{ route('admin.hero.create') }}" class="mb-1 text-[10px] font-black uppercase tracking-widest text-white bg-slate-900 px-4 py-2 rounded-xl transition-all hover:bg-teal-600 shadow-lg">Add Now</a>
                @endif
            </div>
        </div>
    </div>

    {{-- ─── Precise Analytics Section ─── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        
        {{-- Large Performance Area --}}
        <div class="lg:col-span-2 aurora-card p-12">
            <div class="flex items-center justify-between mb-12">
                <div>
                    <h3 class="text-xl font-black text-slate-900">Performance Overtime</h3>
                    <p class="text-xs font-bold text-slate-300 uppercase tracking-widest mt-2">Portfolio engagement tracking</p>
                </div>
                <div class="flex items-center gap-2 px-3 py-1.5 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                    +12.5%
                </div>
            </div>
            <div id="auroraPerformanceChart" class="min-h-[350px]"></div>
        </div>

        {{-- Balanced Category Donut --}}
        <div class="lg:col-span-1 aurora-card p-12 flex flex-col justify-between">
            <div>
                <h3 class="text-xl font-black text-slate-900">Distribution</h3>
                <p class="text-xs font-bold text-slate-300 uppercase tracking-widest mt-2">Inventory balance</p>
            </div>
            
            <div id="auroraDistributionChart" class="py-10"></div>
            
            <div class="space-y-4 pt-4 border-t border-slate-50">
                @foreach($categoriesList->take(3) as $cat)
                <div class="flex items-center justify-between">
                    <span class="text-xs font-bold text-slate-400">{{ $cat->name }}</span>
                    <span class="text-xs font-black text-slate-900">{{ $cat->products_count }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tealMain = '#14b8a6';
        const slateLight = '#e2e8f0';
        const slateText = '#94a3b8';

        // ─── Minimalist Performance Chart ───
        var perfOptions = {
            series: [{
                name: 'Projects Added',
                data: [31, 40, 28, 51, 42, 109, 100, 120]
            }],
            chart: {
                type: 'line',
                height: 350,
                toolbar: { show: false },
                background: 'transparent',
                fontFamily: 'Plus Jakarta Sans, sans-serif',
                sparkline: { enabled: false }
            },
            stroke: { curve: 'smooth', width: 4, lineCap: 'round' },
            colors: [tealMain],
            grid: {
                show: true,
                borderColor: '#f8fafc',
                strokeDashArray: 0,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } },
                padding: { top: 0, right: 0, bottom: 0, left: 0 }
            },
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'],
                axisBorder: { show: false },
                axisTicks: { show: false },
                labels: { style: { colors: slateText, fontWeight: 700, fontSize: '11px' } }
            },
            yaxis: {
                labels: { style: { colors: slateText, fontWeight: 700, fontSize: '11px' } }
            },
            markers: { size: 0, hover: { size: 6, strokeWidth: 3, strokeColor: '#fff' } },
            tooltip: { theme: 'light', x: { show: false } }
        };

        var perfChart = new ApexCharts(document.querySelector("#auroraPerformanceChart"), perfOptions);
        perfChart.render();

        // ─── Minimalist Distribution Chart ───
        var distOptions = {
            series: {!! json_encode($catCounts) !!},
            chart: {
                type: 'donut',
                width: 250,
                fontFamily: 'Plus Jakarta Sans, sans-serif'
            },
            labels: {!! json_encode($catNames) !!},
            colors: [tealMain, '#0d9488', '#0f766e', '#115e59', '#134e4a'],
            stroke: { show: false },
            dataLabels: { enabled: false },
            legend: { show: false },
            plotOptions: {
                pie: {
                    donut: {
                        size: '85%',
                        labels: {
                            show: true,
                            total: {
                                show: true,
                                label: 'Projects',
                                fontWeight: 800,
                                fontSize: '12px',
                                color: slateText,
                                formatter: function (w) {
                                    return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                }
                            }
                        }
                    }
                }
            },
            tooltip: { theme: 'light' }
        };

        var distChart = new ApexCharts(document.querySelector("#auroraDistributionChart"), distOptions);
        distChart.render();
    });
</script>
@endsection

@endsection
