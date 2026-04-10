<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" 
      dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" 
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('page_title', 'Studio') | Admin Studio</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @yield('styles')

    <!-- Dark Mode Initializer -->
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <style>
        :root {
            --sidebar-bg: #0f0c29;
            --sidebar-width: 260px;
            --accent-1: #a855f7;
            --accent-2: #6366f1;
            --accent-3: #ec4899;
            --glow-1: rgba(168,85,247,0.35);
            --glow-2: rgba(99,102,241,0.3);
        }

        * { box-sizing: border-box; }

        body {
            font-family: 'Inter', 'Plus Jakarta Sans', sans-serif;
            background: #f0f2ff;
            transition: background 0.3s, color 0.3s;
        }

        .dark body {
            background: #0b0f1a;
            color: #f1f5f9;
        }

        /* ═══ SCROLLBAR ═══ */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #a855f7, #6366f1); border-radius: 10px; }

        /* ═══ SIDEBAR ═══ */
        .sidebar {
            background: #ffffff;
            position: relative;
            border-right: 1px solid rgba(99,102,241,0.08);
            transition: background 0.3s, border 0.3s;
        }

        .dark .sidebar {
            background: linear-gradient(160deg, #0f0c29 0%, #151033 40%, #1a0a3b 70%, #0d1b4b 100%);
            border-right: 1px solid rgba(255,255,255,0.05);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse at 30% 20%, rgba(168,85,247,0.05) 0%, transparent 60%);
            pointer-events: none;
            opacity: 0.5;
        }
        .dark .sidebar::before {
            background: radial-gradient(ellipse at 30% 20%, rgba(168,85,247,0.15) 0%, transparent 60%),
                        radial-gradient(ellipse at 70% 80%, rgba(99,102,241,0.12) 0%, transparent 55%);
            opacity: 1;
        }

        /* ═══ LOGO ═══ */
        .logo-icon {
            width: 40px; height: 40px;
            background: linear-gradient(135deg, #a855f7, #6366f1);
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 800; font-size: 18px;
            box-shadow: 0 0 20px var(--glow-1), 0 4px 12px rgba(0,0,0,0.3);
            position: relative; flex-shrink: 0;
        }
        .logo-icon::after {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(135deg, #c084fc, #818cf8);
            border-radius: 14px;
            z-index: -1;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .logo-icon:hover::after { opacity: 1; }

        /* ═══ NAV SECTION LABELS ═══ */
        .nav-section-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #64748b;
            padding: 0 12px;
            margin-bottom: 6px;
        }
        .dark .nav-section-label {
            color: rgba(167,139,250,0.5);
        }

        /* ═══ SIDEBAR LINKS ═══ */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 13.5px;
            font-weight: 500;
            color: #475569;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            text-decoration: none;
        }
        .dark .sidebar-link {
            color: rgba(203,213,253,0.65);
        }
        .sidebar-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(168,85,247,0.15), rgba(99,102,241,0.1));
            border-radius: 12px;
            opacity: 0;
            transition: opacity 0.25s;
        }
        .sidebar-link:hover {
            color: #7c3aed;
            transform: translateX(3px);
            background: rgba(124, 58, 237, 0.04);
        }
        .dark .sidebar-link:hover {
            color: #e0d7ff;
            background: transparent;
        }
        .sidebar-link:hover::before { opacity: 1; }

        .sidebar-link:hover .nav-icon {
            color: #c084fc;
            filter: drop-shadow(0 0 6px rgba(192,132,252,0.6));
        }

        .sidebar-link.active {
            background: linear-gradient(135deg, rgba(168,85,247,0.1), rgba(99,102,241,0.05));
            color: #7c3aed;
            font-weight: 600;
            border: 1px solid rgba(168,85,247,0.1);
            box-shadow: 0 4px 12px rgba(168,85,247,0.05);
        }
        .dark .sidebar-link.active {
            background: linear-gradient(135deg, rgba(168,85,247,0.3), rgba(99,102,241,0.2));
            color: #f3e8ff;
            border-color: rgba(168,85,247,0.25);
            box-shadow: 0 4px 24px rgba(168,85,247,0.15), inset 0 1px 0 rgba(255,255,255,0.08);
        }
        .sidebar-link.active .nav-icon {
            color: #7c3aed;
            filter: drop-shadow(0 0 8px rgba(124,58,237,0.3));
        }
        .dark .sidebar-link.active .nav-icon {
            color: #d8b4fe;
            filter: drop-shadow(0 0 8px rgba(216,180,254,0.7));
        }
        .sidebar-link.active::after {
            content: '';
            position: absolute;
            left: 0; top: 50%;
            transform: translateY(-50%);
            width: 3px; height: 60%;
            background: linear-gradient(180deg, #a855f7, #6366f1);
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 20px; height: 20px;
            flex-shrink: 0;
            color: #94a3b8;
            transition: all 0.25s;
        }
        .dark .nav-icon {
            color: rgba(139,130,230,0.7);
        }

        /* ═══ BADGE ═══ */
        .nav-badge {
            margin-left: auto;
            font-size: 10px; font-weight: 700;
            padding: 2px 7px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(168,85,247,0.3), rgba(99,102,241,0.2));
            color: #c4b5fd;
            border: 1px solid rgba(168,85,247,0.2);
        }

        /* ═══ HEADER ═══ */
        .admin-header {
            background: rgba(255,255,255,0.96);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(99,102,241,0.1);
            box-shadow: 0 1px 16px rgba(99,102,241,0.06);
            transition: background 0.3s, border 0.3s;
        }

        .dark .admin-header {
            background: rgba(15, 23, 42, 0.9);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        /* ═══ CRAFTABLE CARD ═══ */
        .craftable-card {
            background: white;
            border: 1px solid rgba(226,232,240,0.8);
            border-radius: 20px;
            box-shadow: 0 2px 16px rgba(99,102,241,0.06);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dark .craftable-card {
            background: #1e293b;
            border-color: rgba(255, 255, 255, 0.05);
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.15);
        }
        .craftable-card:hover {
            box-shadow: 0 8px 32px rgba(99,102,241,0.12);
            transform: translateY(-2px);
        }

        /* ═══ STAT CARDS ═══ */
        .stat-card {
            border-radius: 20px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid rgba(255,255,255,0.25);
        }
        .stat-card::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 130px; height: 130px;
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            transition: transform 0.4s;
        }
        .stat-card:hover::before { transform: scale(1.3); }
        .stat-card:hover { transform: translateY(-4px); }

        .stat-card-violet {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 50%, #c084fc 100%);
            box-shadow: 0 8px 32px rgba(124,58,237,0.35), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .stat-card-indigo {
            background: linear-gradient(135deg, #4338ca 0%, #6366f1 50%, #818cf8 100%);
            box-shadow: 0 8px 32px rgba(67,56,202,0.35), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .stat-card-rose {
            background: linear-gradient(135deg, #be185d 0%, #ec4899 50%, #f472b6 100%);
            box-shadow: 0 8px 32px rgba(190,24,93,0.35), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .stat-card-sky {
            background: linear-gradient(135deg, #0369a1 0%, #0ea5e9 50%, #38bdf8 100%);
            box-shadow: 0 8px 32px rgba(3,105,161,0.35), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .stat-card-amber {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 50%, #fcd34d 100%);
            box-shadow: 0 8px 32px rgba(180,83,9,0.35), 0 0 0 1px rgba(255,255,255,0.1);
        }

        /* ═══ ICON BOX ═══ */
        .stat-icon-box {
            width: 52px; height: 52px;
            border-radius: 16px;
            background: rgba(255,255,255,0.2);
            backdrop-filter: blur(8px);
            display: flex; align-items: center; justify-content: center;
            border: 1px solid rgba(255,255,255,0.3);
            flex-shrink: 0;
        }

        /* ═══ INPUTS ═══ */
        .aurora-input {
            width: 100%;
            padding: 11px 16px;
            background: rgba(248,250,252,0.8);
            border: 1.5px solid #e2e8f0;
            border-radius: 12px;
            font-size: 14px;
            color: #1e293b;
            transition: all 0.25s;
            outline: none;
        }
        .dark .aurora-input {
            background: rgba(30, 41, 59, 0.5);
            border-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .aurora-input:focus {
            border-color: #a855f7;
            background: white;
            box-shadow: 0 0 0 4px rgba(168,85,247,0.12), 0 2px 8px rgba(168,85,247,0.08);
        }
        .aurora-input::placeholder { color: #94a3b8; }

        .aurora-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            margin-bottom: 6px;
            letter-spacing: 0.01em;
        }
        .dark .aurora-label {
            color: #94a3b8;
        }

        /* ═══ BUTTONS ═══ */
        .btn-primary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            background: linear-gradient(135deg, #7c3aed, #a855f7);
            color: white;
            border: none; border-radius: 12px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(124,58,237,0.35);
            text-decoration: none;
        }
        .btn-primary:hover {
            background: linear-gradient(135deg, #6d28d9, #9333ea);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(124,58,237,0.45);
            color: white;
        }
        .btn-secondary {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            background: white;
            color: #6366f1;
            border: 1.5px solid #e0e7ff; border-radius: 12px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 2px 8px rgba(99,102,241,0.08);
            text-decoration: none;
        }
        .btn-secondary:hover {
            background: #f5f3ff;
            border-color: #a855f7;
            color: #7c3aed;
            transform: translateY(-1px);
        }
        .btn-danger {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px;
            background: linear-gradient(135deg, #dc2626, #ef4444);
            color: white;
            border: none; border-radius: 12px;
            font-size: 13.5px; font-weight: 600;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 14px rgba(220,38,38,0.3);
            text-decoration: none;
        }
        .btn-danger:hover {
            background: linear-gradient(135deg, #b91c1c, #dc2626);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(220,38,38,0.4);
        }

        /* ═══ TABLE ═══ */
        table thead th {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #7c3aed;
            padding: 14px 20px;
            background: linear-gradient(135deg, #faf5ff, #f0f2ff);
            border-bottom: 2px solid #e8e3ff;
        }
        .dark table thead th {
            background: linear-gradient(135deg, #2e1065, #1e1b4b);
            border-bottom-color: rgba(255, 255, 255, 0.1);
            color: #c084fc;
        }
        table tbody td {
            padding: 14px 20px;
            font-size: 14px;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
            transition: background 0.18s;
        }
        .dark table tbody td {
            color: #cbd5e1;
            border-bottom-color: rgba(255, 255, 255, 0.05);
        }
        table tbody tr:last-child td { border-bottom: 0; }
        table tbody tr:hover td { background: #faf7ff; }
        .dark table tbody tr:hover td { background: rgba(255, 255, 255, 0.02); }

        /* ═══ ANIMATIONS ═══ */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 0 0 rgba(168,85,247,0.3); }
            50% { box-shadow: 0 0 0 8px rgba(168,85,247,0); }
        }
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }
        @keyframes spin-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-fade-up { animation: fadeInUp 0.5s ease both; }
        .animate-fade-up-2 { animation: fadeInUp 0.5s 0.1s ease both; }
        .animate-fade-up-3 { animation: fadeInUp 0.5s 0.2s ease both; }
        .animate-fade-up-4 { animation: fadeInUp 0.5s 0.3s ease both; }

        .pulse-dot {
            animation: pulse-glow 2s infinite;
        }

        /* ═══ GREETING ═══ */
        .greeting-section {
            background: linear-gradient(135deg, #7c3aed 0%, #a855f7 40%, #ec4899 100%);
            border-radius: 24px;
            padding: 32px;
            position: relative;
            overflow: hidden;
            color: white;
            box-shadow: 0 12px 40px rgba(124,58,237,0.35);
        }
        .greeting-section::before {
            content: '';
            position: absolute;
            top: -60px; right: -60px;
            width: 240px; height: 240px;
            border-radius: 50%;
            background: rgba(255,255,255,0.07);
            animation: float 6s ease-in-out infinite;
        }
        .greeting-section::after {
            content: '';
            position: absolute;
            bottom: -40px; left: 40%;
            width: 160px; height: 160px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            animation: float 8s ease-in-out infinite reverse;
        }

        /* ═══ ONLINE STATUS ═══ */
        .status-online {
            display: flex; align-items: center; gap: 7px;
            background: rgba(16,185,129,0.1);
            border: 1px solid rgba(16,185,129,0.2);
            border-radius: 20px;
            padding: 5px 12px;
            font-size: 12px; font-weight: 600;
            color: #059669;
        }
        .status-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #10b981;
            animation: pulse-glow 2s infinite;
        }

        /* ═══ SUCCESS FLASH ═══ */
        .flash-success {
            background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(5,150,105,0.08));
            border: 1px solid rgba(16,185,129,0.25);
            border-radius: 16px;
            padding: 16px 20px;
        }
        .flash-error {
            background: linear-gradient(135deg, rgba(239,68,68,0.08), rgba(220,38,38,0.06));
            border: 1px solid rgba(239,68,68,0.2);
            border-radius: 16px;
            padding: 16px 20px;
        }

        /* ═══ SIDEBAR USER AVATAR ═══ */
        .sidebar-avatar {
            width: 36px; height: 36px;
            border-radius: 12px;
            background: linear-gradient(135deg, #a855f7, #6366f1);
            display: flex; align-items: center; justify-content: center;
            color: white; font-weight: 800; font-size: 15px;
            box-shadow: 0 4px 12px rgba(168,85,247,0.4);
            flex-shrink: 0;
        }

        /* Main scrollable */
        .main-scroll { overflow-y: auto; overflow-x: hidden; }
    </style>
</head>
<body class="antialiased bg-[#f0f2ff] dark:bg-[#0b0f1a] text-slate-900 dark:text-slate-100 flex h-screen overflow-hidden"
    x-data="{ sidebarOpen: false }"
    x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))">

    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" x-transition.opacity
         class="fixed inset-0 z-20 bg-black/60 backdrop-blur-sm lg:hidden"
         @click="sidebarOpen = false"></div>

    <!-- ═══ SIDEBAR ═══ -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
           class="sidebar fixed inset-y-0 left-0 z-30 w-[260px] flex flex-col border-r border-slate-200 dark:border-white/5 transition-transform duration-300 lg:static lg:translate-x-0 shadow-2xl shrink-0">

        <!-- Mobile Close -->
        <button @click="sidebarOpen = false"
                class="lg:hidden absolute top-5 right-5 p-2 rounded-xl bg-slate-100 dark:bg-white/10 text-slate-500 dark:text-white/60 hover:text-slate-700 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-white/15 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>

        <!-- Logo Area -->
        <div class="flex items-center gap-3.5 h-[70px] px-5 border-b border-slate-100 dark:border-white/8 shrink-0 relative z-10">
            <div class="logo-icon">✦</div>
            <div class="hidden lg:block">
                <p class="font-bold text-slate-800 dark:text-white text-[15px] leading-none">{{ __('Studio') }}</p>
                <p class="text-[11px] text-slate-500 dark:text-purple-300/70 font-medium mt-0.5">{{ __('Admin Panel') }}</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-5 space-y-0.5 relative z-10">

            <p class="nav-section-label mb-3">{{ __('Main') }}</p>

            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 21V12h6v9"/>
                </svg>
                <span>{{ __('Dashboard') }}</span>
            </a>

            <div class="pt-4 pb-1">
                <p class="nav-section-label">{{ __('Content') }}</p>
            </div>

            <a href="{{ route('admin.hero.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.hero.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/>
                </svg>
                <span>{{ __('Hero Section') }}</span>
            </a>

            <a href="{{ route('admin.category.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6h.008v.008H6V6z"/>
                </svg>
                <span>{{ __('Categories') }}</span>
                @php $catCount = \App\Models\Category::count(); @endphp
                @if($catCount > 0)
                <span class="nav-badge">{{ $catCount }}</span>
                @endif
            </a>

            <a href="{{ route('admin.product.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-9 5.25-9-5.25v-2.25"/>
                </svg>
                <span>{{ __('Projects') }}</span>
                @php $prodCount = \App\Models\Product::count(); @endphp
                @if($prodCount > 0)
                <span class="nav-badge">{{ $prodCount }}</span>
                @endif
            </a>

            <div class="pt-4 pb-1">
                <p class="nav-section-label">{{ __('Settings') }}</p>
            </div>

            <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>
                </svg>
                <span>{{ __('View Website') }}</span>
                <svg class="ml-auto w-3 h-3 text-purple-400/40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>

        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 border-t border-slate-100 dark:border-white/8 shrink-0 relative z-10">
            <div class="flex items-center gap-3 p-2 rounded-xl hover:bg-slate-50 dark:hover:bg-white/5 transition-all cursor-pointer group">
                <div class="sidebar-avatar">{{ substr(Auth::user()->name, 0, 1) }}</div>
                <div class="min-w-0 flex-1">
                    <p class="text-[13px] font-semibold text-slate-800 dark:text-white/90 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-[11px] text-slate-500 dark:text-purple-300/60 font-medium">{{ __('Administrator') }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" title="{{ __('Logout') }}"
                            class="p-1.5 rounded-lg text-slate-400 dark:text-white/30 hover:text-red-400 dark:hover:text-red-400 hover:bg-red-500/10 transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- ═══ MAIN CONTENT ═══ -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- Top Header -->
        <header class="admin-header h-[70px] px-6 flex items-center justify-between shrink-0 z-10">

            <div class="flex items-center gap-4">
                <!-- Mobile Hamburger -->
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-purple-600 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Breadcrumb -->
                <div class="hidden lg:flex items-center gap-2">
                    <span class="text-slate-400 text-sm font-medium">Admin</span>
                    <svg class="w-4 h-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-sm font-700 font-semibold text-slate-700">@yield('page_title', 'Dashboard')</span>
                </div>
            </div>

            <!-- Header Right -->
            <div class="flex items-center gap-4">
                <div class="status-online">
                    <span class="status-dot"></span>
                    <span>{{ __('System Online') }}</span>
                </div>

                <div class="w-px h-6 bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" 
                        class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-purple-600 transition-all duration-300 border border-transparent">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" /></svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </button>

                <!-- Language Switcher -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" 
                            class="p-2.5 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 hover:text-purple-600 transition-all duration-300 border border-transparent flex items-center gap-1.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 11.37 9.198 15.298 6 18" /></svg>
                        <span class="text-xs font-bold uppercase">{{ app()->getLocale() }}</span>
                    </button>
                    <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl overflow-hidden shadow-2xl py-2 px-2 z-[60]">
                        <a href="{{ route('set.locale', ['locale' => 'en']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'en' ? 'text-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'text-slate-600 dark:text-slate-300' }}">
                            <span>🇺🇸</span> {{ __('English') }}
                        </a>
                        <a href="{{ route('set.locale', ['locale' => 'fr']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'fr' ? 'text-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'text-slate-600 dark:text-slate-300' }}">
                            <span>🇫🇷</span> {{ __('French') }}
                        </a>
                        <a href="{{ route('set.locale', ['locale' => 'ar']) }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors {{ app()->getLocale() == 'ar' ? 'text-purple-600 bg-purple-50 dark:bg-purple-900/20' : 'text-slate-600 dark:text-slate-300' }}">
                            <span>🇸🇦</span> {{ __('Arabic') }}
                        </a>
                    </div>
                </div>

                <div class="w-px h-6 bg-slate-200 dark:bg-slate-800 hidden md:block"></div>

                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit"
                            class="flex items-center gap-2 text-sm text-slate-500 hover:text-purple-600 dark:hover:text-purple-400 transition-colors font-semibold px-3 py-1.5 rounded-xl hover:bg-purple-50 dark:hover:bg-purple-900/10">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="main-scroll flex-1 relative">
            <div class="p-6 lg:p-8">
                <div class="max-w-[1400px] mx-auto">

                @if(session('success'))
                <div class="flash-success mb-6 flex items-center gap-3"
                    x-data="{ show: true }" x-show="show" x-transition>
                    <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center shrink-0 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <span class="text-sm font-semibold text-emerald-700 flex-1">{{ session('success') }}</span>
                    <button @click="show = false" class="text-emerald-400 hover:text-emerald-600 transition-colors p-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                @endif

                @if($errors->any())
                <div class="flash-error mb-6">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-9 h-9 bg-red-100 rounded-xl flex items-center justify-center shrink-0 text-red-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        </div>
                        <p class="text-sm font-bold text-red-700">Please fix the following errors:</p>
                    </div>
                    <ul class="space-y-1 pl-12">
                        @foreach($errors->all() as $error)
                        <li class="text-sm text-red-600">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                @yield('content')
                </div>
            </div>
        </main>
    </div>

    @yield('scripts')
</body>
</html>
