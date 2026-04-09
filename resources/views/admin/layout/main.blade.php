<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Studio') | Admin Aurora</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @yield('styles')
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-link { @apply flex items-center justify-center lg:justify-start gap-4 px-4 py-3.5 rounded-2xl text-sm font-semibold transition-all duration-300; }
        .sidebar-link.active { @apply bg-teal-500 text-white shadow-2xl shadow-teal-500/40; }
        .sidebar-link:not(.active) { @apply text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-900 dark:hover:text-white; }
        
        .aurora-card { @apply bg-white border border-slate-100 rounded-[2rem] lg:rounded-[3rem] shadow-[0_20px_50px_rgba(0,0,0,0.02)] transition-all duration-500 hover:shadow-[0_40px_80px_rgba(0,0,0,0.05)]; }
        .aurora-table-card { @apply bg-white border border-slate-100 rounded-[2rem] shadow-[0_10px_30px_rgba(0,0,0,0.02)] overflow-hidden; }
        .aurora-gradient { background: linear-gradient(135deg, #14b8a6 0%, #10b981 100%); }
        
        table thead th { @apply text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 py-6 px-6 border-b border-slate-50; }
        table tbody td { @apply py-5 px-6 text-sm text-slate-600 border-b border-slate-50 transition-colors; }
        table tbody tr:last-child td { @apply border-b-0; }
        table tbody tr:hover td { @apply bg-slate-50/50; }
        .admin-label { @apply block text-[11px] font-extrabold uppercase tracking-[0.2em] text-slate-400 mb-3 ml-1; }
        .admin-input { @apply block w-full px-5 py-4 bg-white border border-slate-200 rounded-2xl text-slate-900 text-sm font-semibold placeholder:text-slate-300 transition-all duration-300 focus:outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5; }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #f1f5f9; border-radius: 10px; }
    </style>
</head>
<body class="font-sans antialiased bg-[#fcfcfd] text-slate-900 transition-colors duration-500 flex h-screen overflow-hidden"
    x-data="{ sidebarOpen: false, pageTitle: '@yield('page_title', 'Studio')' }">

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" x-transition.opacity
         class="fixed inset-0 z-20 bg-slate-950/70 backdrop-blur-sm lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- ═══ SIDEBAR ═══ -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-30 w-72 flex flex-col bg-white border-r border-slate-100 transition-transform duration-500 lg:static lg:translate-x-0 shadow-2xl lg:shadow-none">

        <!-- Mobile Close Button -->
        <button @click="sidebarOpen = false"
                class="lg:hidden absolute top-6 right-6 p-2 rounded-xl bg-slate-100 text-slate-400 hover:text-slate-900 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Logo -->
        <div class="flex items-center justify-center lg:justify-start gap-4 h-24 px-6 mb-4 shrink-0">
            <div class="w-11 h-11 rounded-[1.25rem] aurora-gradient flex items-center justify-center text-white shadow-2xl shadow-teal-500/20">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            <div class="hidden lg:block">
                <div class="text-xl font-extrabold text-slate-900 tracking-tight leading-none">Studio.</div>
                <div class="text-[10px] font-black uppercase tracking-[0.3em] text-teal-600 mt-1.5 opacity-80">Aurora</div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-1">
            <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-600 px-3 mb-3">Overview</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                </svg>
                Dashboard
            </a>

            <div class="pt-4">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-600 px-3 mb-3">Content</p>
            </div>

            <a href="{{ route('admin.hero.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"/>
                </svg>
                Hero Section
            </a>

            <a href="{{ route('admin.category.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                Categories
                @php $catCount = \App\Models\Category::count(); @endphp
                @if($catCount > 0)
                <span class="ml-auto text-[10px] font-black bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 rounded-full px-2 py-0.5">{{ $catCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.product.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
                Projects
                @php $prodCount = \App\Models\Product::count(); @endphp
                @if($prodCount > 0)
                <span class="ml-auto text-[10px] font-black bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 rounded-full px-2 py-0.5">{{ $prodCount }}</span>
                @endif
            </a>

            <div class="pt-4">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 dark:text-slate-600 px-3 mb-3">System</p>
            </div>

            <a href="{{ route('home') }}" target="_blank"
               class="sidebar-link">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                View Website
                <svg class="w-3 h-3 ml-auto text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </nav>

        <!-- Sidebar Footer -->
        <div class="px-3 py-4 border-t border-slate-200 dark:border-slate-800 shrink-0">
            <div class="flex items-center gap-3 p-3 rounded-xl bg-slate-50 dark:bg-slate-800/50 mb-3">
                <div class="w-9 h-9 rounded-lg bg-gradient-to-br from-primary-500 to-indigo-600 flex items-center justify-center text-white text-sm font-black shrink-0">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-bold text-slate-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[10px] text-slate-400 font-semibold uppercase tracking-wider">Administrator</p>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold text-red-500 hover:bg-red-50 dark:hover:bg-red-500/10 hover:text-red-600 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══ MAIN CONTENT ═══ -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden px-4 py-4 lg:py-6 lg:pr-6">

        <!-- Top Header -->
        <header class="h-20 px-8 flex items-center justify-between rounded-[2.5rem] bg-white border border-slate-100 shadow-[0_10px_40px_rgba(0,0,0,0.02)] mb-6 shrink-0 z-10">

            <!-- Mobile Hamburger -->
            <button @click="sidebarOpen = true"
                class="lg:hidden p-3 -ml-2 rounded-2xl text-slate-400 hover:bg-slate-50 hover:text-slate-900 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </button>

            <!-- Page Title (Desktop) -->
            <div class="hidden lg:block">
                <h1 class="text-lg font-black text-slate-900 dark:text-white">@yield('page_title', 'Dashboard')</h1>
                <p class="text-xs text-slate-400 font-medium">@yield('page_subtitle', 'Manage your portfolio content')</p>
            </div>

            <!-- Header Right -->
            <div class="flex items-center gap-3 ml-auto">
                <!-- Notification Bell -->
                <button class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                    </svg>
                </button>

                <!-- User Avatar -->
                <div class="flex items-center gap-3 pl-3 border-l border-slate-200 dark:border-slate-700">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-primary-500 to-indigo-600 flex items-center justify-center text-white text-sm font-black shadow-lg shadow-primary-500/20">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-sm font-bold text-slate-900 dark:text-white leading-none">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-slate-400 uppercase tracking-wider font-semibold mt-0.5">Admin</p>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content Area -->
        <main class="flex-1 overflow-y-auto overflow-x-hidden p-6 sm:p-8">
            <div class="max-w-7xl mx-auto">

                @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 rounded-2xl flex items-center gap-3 text-emerald-700 dark:text-emerald-400 shadow-sm"
                    x-data="{ show: true }" x-show="show" x-transition>
                    <div class="w-8 h-8 bg-emerald-100 dark:bg-emerald-500/20 rounded-lg flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold flex-1">{{ session('success') }}</span>
                    <button @click="show = false" class="shrink-0 text-emerald-400 hover:text-emerald-600 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                @endif

                @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 rounded-2xl shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-500/20 rounded-lg flex items-center justify-center shrink-0 text-red-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-red-700 dark:text-red-400">Please fix the following errors:</p>
                    </div>
                    <ul class="space-y-1 pl-11">
                        @foreach($errors->all() as $error)
                        <li class="text-sm text-red-600 dark:text-red-400">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
