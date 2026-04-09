@extends('admin.layout.main')
@section('page_title', 'Edit Hero')
@section('page_subtitle', 'Update the main landing hero content')

@section('content')
<div class="flex items-center justify-between mb-10">
    <a href="{{ route('admin.hero.index') }}"
       class="inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-teal-600 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Identity Overview
    </a>
</div>

<form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        {{-- Main Fields --}}
        <div class="xl:col-span-2 space-y-8">
            <div class="aurora-card p-8 lg:p-10">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Content Narrative</h3>
                    <div class="w-8 h-1 bg-slate-100 rounded-full"></div>
                </div>

                <div class="space-y-8">
                    <div>
                        <label class="admin-label">Primary Headline <span class="text-teal-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $hero->title) }}"
                               class="admin-input @error('title') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror"
                               placeholder="e.g., Creative Developer" required>
                        @error('title') <p class="text-rose-500 text-[11px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="admin-label">Secondary Vision</label>
                        <textarea name="subtitle" rows="4"
                                  class="admin-input resize-none @error('subtitle') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror"
                                  placeholder="Deepen the narrative with a brief description…">{{ old('subtitle', $hero->subtitle) }}</textarea>
                        @error('subtitle') <p class="text-rose-500 text-[11px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label class="admin-label">Call to Action</label>
                            <input type="text" name="btn_text" value="{{ old('btn_text', $hero->btn_text) }}"
                                   class="admin-input" placeholder="Explore Work">
                        </div>
                        <div>
                            <label class="admin-label">Destination Link</label>
                            <input type="text" name="btn_url" value="{{ old('btn_url', $hero->btn_url) }}"
                                   class="admin-input" placeholder="/portfolio">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between gap-6 p-1 bg-white/50 rounded-[2rem]">
                <a href="{{ route('admin.hero.index') }}"
                   class="px-8 py-4 rounded-2xl text-slate-400 text-xs font-black uppercase tracking-widest hover:text-slate-900 transition-all">
                    Cancel Operation
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-3 px-10 py-4 aurora-gradient text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-teal-500/20 hover:scale-105 active:scale-95 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                    Sync Configuration
                </button>
            </div>
        </div>

        {{-- Image Upload --}}
        <div class="xl:col-span-1 space-y-8">
            <div class="aurora-card p-8 group">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Media Component</h3>
                    <div class="w-2 h-2 rounded-full bg-teal-500 shadow-[0_0_10px_rgba(20,184,166,0.5)]"></div>
                </div>

                @if($hero->image)
                <div class="mb-8">
                    <label class="admin-label">Active Atmosphere</label>
                    <div class="rounded-3xl overflow-hidden border border-slate-100 aspect-[4/5] relative group/img shadow-xl shadow-slate-200/50">
                        <img src="{{ asset('storage/' . $hero->image) }}"
                             class="w-full h-full object-cover" alt="Hero Image">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                            <span class="text-white text-[10px] font-black uppercase tracking-widest bg-white/20 border border-white/30 rounded-full px-4 py-1.5 backdrop-blur-xl">Live Background</span>
                        </div>
                    </div>
                </div>
                @endif

                <div x-data="{ isDragging: false, fileName: null }"
                     @dragover.prevent="isDragging = true"
                     @dragleave="isDragging = false"
                     @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0]?.name"
                     class="relative rounded-3xl border-2 border-dashed transition-all duration-500 cursor-pointer overflow-hidden group/zone"
                     :class="isDragging ? 'border-teal-500 bg-teal-50 shadow-inner' : 'border-slate-200 bg-slate-50/50 hover:border-teal-400 hover:bg-white'"
                     @click="document.getElementById('hero-img').click()">
                    
                    <input id="hero-img" name="image" type="file" accept="image/*"
                           class="sr-only" @change="fileName = $event.target.files[0]?.name">
                    
                    <div class="py-12 px-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover/zone:scale-110 group-hover/zone:text-teal-600 transition-all duration-500">
                            <svg class="w-7 h-7 text-slate-300 transition-colors group-hover/zone:text-teal-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2" x-text="fileName ?? 'Replace Atmosphere'"></p>
                        <p class="text-[10px] text-slate-300 font-bold italic" x-show="!fileName">OPTIMIZED FOR HIGH-RES WEBP</p>
                    </div>
                </div>
                @error('image') <p class="text-rose-500 text-[11px] font-bold mt-3 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</form>
</form>
@endsection
