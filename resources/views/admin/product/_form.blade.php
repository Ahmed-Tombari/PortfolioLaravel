@php
    $isEdit = isset($product);
    $formAction = $isEdit ? route('admin.product.update', $product->id) : route('admin.product.store');
    $pageTitle = $isEdit ? 'Edit Project' : 'New Project';
    $pageSubtitle = $isEdit ? 'Update portfolio showcase piece' : 'Add a new portfolio showcase piece';
@endphp
@extends('admin.layout.main')
@section('page_title', $pageTitle)
@section('page_subtitle', $pageSubtitle)

@section('content')
<div class="flex items-center justify-between mb-10">
    <a href="{{ route('admin.product.index') }}"
       class="inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-teal-600 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Inventory Gallery
    </a>
</div>

<form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
        {{-- Main Form --}}
        <div class="xl:col-span-2 space-y-8">
            <div class="aurora-card p-8 lg:p-10">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Identity Details</h3>
                    <div class="w-8 h-1 bg-slate-100 rounded-full"></div>
                </div>

                <div class="space-y-8">
                    <div>
                        <label class="admin-label">Narrative Title <span class="text-teal-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $product->title ?? '') }}"
                               class="admin-input @error('title') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror"
                               placeholder="e.g., Luxury Watch Marketplace" required>
                        @error('title') <p class="text-rose-500 text-[11px] font-bold mt-2 ml-1 flex items-center gap-1.5 uppercase tracking-wider"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="admin-label">Segment Selection <span class="text-teal-500">*</span></label>
                        <div class="relative group">
                            <select name="category_id"
                                    class="admin-input appearance-none pr-12 @error('category_id') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror text-slate-900"
                                    required>
                                <option value="" class="text-slate-400">Classify this project…</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-5 pointer-events-none text-slate-300 group-hover:text-teal-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                        @error('category_id') <p class="text-rose-500 text-[11px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="admin-label">Deep Storytelling <span class="text-teal-500">*</span></label>
                        <textarea name="description" rows="8"
                                  class="admin-input resize-none @error('description') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror"
                                  placeholder="Describe the challenges, the vision, and the execution details of this masterpiece…" required>{{ old('description', $product->description ?? '') }}</textarea>
                        @error('description') <p class="text-rose-500 text-[11px] font-bold mt-2 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="flex items-center justify-between gap-6 p-1 bg-white/50 rounded-[2rem]">
                <a href="{{ route('admin.product.index') }}"
                   class="px-8 py-4 rounded-2xl border border-transparent text-slate-400 text-xs font-black uppercase tracking-widest hover:text-slate-900 hover:bg-white transition-all">
                    Discard Changes
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-3 px-10 py-4 aurora-gradient text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-teal-500/20 hover:scale-105 active:scale-95 transition-all">
                    @if($isEdit)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        Update Masterpiece
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
                        Establish Project
                    @endif
                </button>
            </div>
        </div>

        {{-- Image Upload --}}
        <div class="xl:col-span-1 space-y-8">
            <div class="aurora-card p-8 group">
                <div class="flex items-center justify-between mb-8">
                    <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400">Visual Component</h3>
                    <div class="w-2 h-2 rounded-full bg-teal-500 shadow-[0_0_10px_rgba(20,184,166,0.5)]"></div>
                </div>

                {{-- Current Image (Edit mode) --}}
                @if($isEdit && $product->image)
                <div class="mb-8">
                    <label class="admin-label">Existing Media</label>
                    <div class="rounded-3xl overflow-hidden border border-slate-100 aspect-video bg-slate-50 relative group/img shadow-xl shadow-slate-200/50">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="w-full h-full object-cover" alt="{{ $product->title }}">
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover/img:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
                            <span class="text-white text-[10px] font-black uppercase tracking-widest bg-white/20 border border-white/30 rounded-full px-4 py-1.5 backdrop-blur-xl">Active Frame</span>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Upload Zone --}}
                <div x-data="{ isDragging: false, fileName: null }"
                     @dragover.prevent="isDragging = true"
                     @dragleave="isDragging = false"
                     @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0]?.name; document.getElementById('img-upload').files = $event.dataTransfer.files"
                     class="relative rounded-3xl border-2 border-dashed transition-all duration-500 cursor-pointer overflow-hidden group/zone"
                     :class="isDragging ? 'border-teal-500 bg-teal-50 shadow-inner' : 'border-slate-200 bg-slate-50/50 hover:border-teal-400 hover:bg-white'"
                     @click="document.getElementById('img-upload').click()">

                    <input id="img-upload" name="image" type="file" accept="image/*"
                           class="sr-only"
                           @change="fileName = $event.target.files[0]?.name"
                           {{ !$isEdit ? 'required' : '' }}>

                    <div class="py-12 px-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center shadow-sm mb-6 group-hover/zone:scale-110 group-hover/zone:text-teal-600 transition-all duration-500">
                            <svg class="w-7 h-7 text-slate-300 transition-colors group-hover/zone:text-teal-500" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <p class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2" x-text="fileName ?? 'Drop masterpiece here'"></p>
                        <p class="text-[10px] text-slate-300 font-bold italic" x-show="!fileName">OPTIMIZED FOR WEBP / 2MB</p>
                    </div>
                </div>
                @error('image') <p class="text-rose-500 text-[11px] font-bold mt-3 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
            </div>
        </div>
    </div>
</form>
/div>
</form>
@endsection
