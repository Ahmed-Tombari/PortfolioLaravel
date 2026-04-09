@extends('admin.layout.main')
@section('page_title', 'Hero Section')
@section('page_subtitle', 'Manage the landing page hero content')

@section('content')
@if(!$hero)
    {{-- ─── Empty State + Create Form ─── --}}
    <div class="max-w-3xl">
        <div class="mb-10 p-6 bg-amber-50 border border-amber-100 rounded-3xl flex items-center gap-4 text-amber-900 shadow-sm shadow-amber-900/5">
            <div class="w-12 h-12 rounded-2xl bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="font-black uppercase tracking-widest text-[10px] text-amber-600 mb-1">Configuration Required</p>
                <p class="text-sm font-bold opacity-80 leading-relaxed">Your digital stage is currently empty. Initialize the Hero section to activate your profile's narrative.</p>
            </div>
        </div>

        <div class="aurora-card p-8 lg:p-12">
            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="admin-label">Primary Narrative (Title) <span class="text-teal-500">*</span></label>
                        <input type="text" name="title" class="admin-input" placeholder="e.g., Creative Architect & Developer" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="admin-label">Supporting Vision (Subtitle)</label>
                        <input type="text" name="subtitle" class="admin-input" placeholder="e.g., Sculpting high-performance digital ecosystems">
                    </div>
                    <div>
                        <label class="admin-label">Action Label</label>
                        <input type="text" name="btn_text" class="admin-input" placeholder="Explore Work">
                    </div>
                    <div>
                        <label class="admin-label">Destination URL</label>
                        <input type="text" name="btn_url" class="admin-input" placeholder="/portfolio">
                    </div>
                </div>
                
                <div class="flex justify-end pt-4 border-t border-slate-50">
                    <button type="submit"
                        class="px-10 py-4 aurora-gradient text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-teal-500/20 hover:scale-105 transition-all active:scale-95">
                        Initialize Identity
                    </button>
                </div>
            </form>
        </div>
    </div>

@else
    {{-- ─── Preview + Edit ─── --}}
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">

        {{-- Details --}}
        <div class="xl:col-span-2 space-y-8">
            <div class="aurora-table-card">
                <div class="px-10 py-6 border-b border-slate-50 bg-slate-50/50">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Current active profile configuration</h3>
                </div>
                <div class="divide-y divide-slate-50">
                    @php
                        $fields = [
                            ['label' => 'Narrative', 'value' => $hero->title],
                            ['label' => 'Subtext', 'value' => $hero->subtitle ?: '—'],
                            ['label' => 'Action Call', 'value' => $hero->btn_text ?: '—'],
                            ['label' => 'Target Route', 'value' => $hero->btn_url ?: '—'],
                        ];
                    @endphp
                    @foreach($fields as $f)
                    <div class="flex items-start group">
                        <div class="w-48 shrink-0 px-10 py-6 bg-slate-50/30 text-[10px] font-black uppercase tracking-widest text-slate-400 border-r border-slate-50">{{ $f['label'] }}</div>
                        <div class="px-10 py-6 text-slate-900 font-extrabold text-base flex-1 group-hover:bg-slate-50/30 transition-colors">{{ $f['value'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-start">
                <a href="{{ route('admin.hero.edit', $hero->id) }}"
                   class="px-8 py-4 bg-amber-500 text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-amber-500/20 hover:-translate-y-1 transition-all flex items-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Modify Hero Settings
                </a>
            </div>
        </div>

        {{-- Image Preview --}}
        <div class="xl:col-span-1">
            <div class="aurora-card p-8 group">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Atmosphere</h3>
                    <div class="w-2 h-2 rounded-full bg-teal-500 shadow-[0_0_10px_rgba(20,184,166,0.5)]"></div>
                </div>

                @if($hero->image)
                    <div class="rounded-3xl overflow-hidden border border-slate-100 aspect-[4/5] relative shadow-2xl shadow-slate-200/50 transition-transform duration-500 group-hover:scale-[1.02]">
                        <img src="{{ asset('storage/' . $hero->image) }}"
                             class="w-full h-full object-cover" alt="Hero Image">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex items-center justify-center backdrop-blur-sm">
                            <span class="px-6 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-[10px] font-black uppercase tracking-widest border border-white/30">Current Visual</span>
                        </div>
                    </div>
                @else
                    <div class="aspect-[4/5] bg-slate-50 border border-dashed border-slate-200 rounded-3xl flex flex-col items-center justify-center text-slate-300 gap-4">
                        <div class="w-16 h-16 rounded-full bg-white flex items-center justify-center shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-xs font-black uppercase tracking-widest">Visual Missing</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
@endsection
