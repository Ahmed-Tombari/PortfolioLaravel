@php
    $isEdit = isset($product);
    $formAction = $isEdit ? route('admin.product.update', $product->id) : route('admin.product.store');
    $pageTitle = $isEdit ? 'Edit Project' : 'New Project';
@endphp
@extends('admin.layout.main')
@section('page_title', $pageTitle)

@section('styles')
<style>
.admin-input {
    width: 100%;
    padding: 11px 16px;
    background: rgba(248,250,252,0.8);
    border: 1.5px solid #e2e8f0;
    border-radius: 12px;
    font-size: 14px;
    color: #1e293b;
    transition: all 0.25s;
    outline: none;
    font-family: inherit;
}
.admin-input:focus {
    border-color: #a855f7;
    background: white;
    box-shadow: 0 0 0 4px rgba(168,85,247,0.12), 0 2px 8px rgba(168,85,247,0.08);
}
.admin-input::placeholder { color: #94a3b8; }
.admin-input.error {
    border-color: #f43f5e;
    box-shadow: 0 0 0 4px rgba(244,63,94,0.1);
}
select.admin-input { cursor: pointer; }

/* Upload zone */
.upload-zone {
    border: 2px dashed #e2e8f0;
    border-radius: 16px;
    transition: all 0.25s;
    cursor: pointer;
    background: #fafaff;
}
.upload-zone:hover, .upload-zone.dragging {
    border-color: #a855f7;
    background: #faf5ff;
}
</style>
@endsection

@section('content')
<div class="space-y-6 animate-fade-up">

    {{-- Back link --}}
    <a href="{{ route('admin.product.index') }}"
       class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-violet-600 transition-colors group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to projects
    </a>

    <form action="{{ $formAction }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if($isEdit) @method('PUT') @endif

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ─── Main Form ─── --}}
            <div class="xl:col-span-2 space-y-5">
                <div class="craftable-card p-6 lg:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-5 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center text-violet-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Basic Information</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Fill in the core details for your project</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        {{-- Title --}}
                        <div>
                            <label class="aurora-label">
                                Project Title <span class="text-rose-500">*</span>
                            </label>
                            <input type="text" name="title"
                                   value="{{ old('title', $product->title ?? '') }}"
                                   class="admin-input @error('title') error @enderror"
                                   placeholder="e.g., Luxury Watch Marketplace"
                                   required>
                            @error('title')
                            <p class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                {{ $message }}
                            </p>
                            @enderror
                        </div>

                        {{-- Category --}}
                        <div>
                            <label class="aurora-label">
                                Category <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="category_id"
                                        class="admin-input appearance-none pr-10 @error('category_id') error @enderror"
                                        required>
                                    <option value="">Select a category...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                </div>
                            </div>
                            @error('category_id')
                            <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="aurora-label">
                                Description <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="description" rows="7"
                                      class="admin-input resize-none @error('description') error @enderror"
                                      placeholder="Describe your project in detail — tools used, goals, outcome..."
                                      required>{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description')
                            <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Submit Bar --}}
                <div class="craftable-card px-6 py-4 flex items-center justify-between gap-4">
                    <a href="{{ route('admin.product.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        @if($isEdit)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Changes
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Create Project
                        @endif
                    </button>
                </div>
            </div>

            {{-- ─── Image Upload ─── --}}
            <div class="xl:col-span-1 space-y-5">
                <div class="craftable-card p-6">
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center text-rose-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Media</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Project cover image</p>
                        </div>
                    </div>

                    {{-- Current Image (Edit) --}}
                    @if($isEdit && $product->image)
                    <div class="mb-4">
                        <label class="aurora-label mb-2">Current Image</label>
                        <div class="rounded-2xl overflow-hidden border border-slate-100 aspect-video bg-slate-50 shadow-sm">
                            <img src="{{ asset('storage/' . $product->image) }}"
                                 class="w-full h-full object-cover" alt="{{ $product->title }}">
                        </div>
                        <p class="text-xs text-slate-400 text-center mt-2">Upload a new image to replace it</p>
                    </div>
                    @endif

                    {{-- Upload Zone --}}
                    <div x-data="{ isDragging: false, fileName: null, previewUrl: null }"
                         @dragover.prevent="isDragging = true"
                         @dragleave="isDragging = false"
                         @drop.prevent="isDragging = false; const f = $event.dataTransfer.files[0]; if(f){ fileName = f.name; const r = new FileReader(); r.onload = e => previewUrl = e.target.result; r.readAsDataURL(f); document.getElementById('img-upload').files = $event.dataTransfer.files; }"
                         class="upload-zone"
                         :class="isDragging ? 'dragging' : ''"
                         @click="document.getElementById('img-upload').click()">

                        <input id="img-upload" name="image" type="file" accept="image/*" class="sr-only"
                               @change="const f = $event.target.files[0]; if(f){ fileName = f.name; const r = new FileReader(); r.onload = e => previewUrl = e.target.result; r.readAsDataURL(f); }"
                               {{ !$isEdit ? 'required' : '' }}>

                        {{-- Preview --}}
                        <div x-show="previewUrl" class="relative">
                            <img :src="previewUrl" class="w-full h-40 object-cover rounded-[14px]">
                            <div class="absolute inset-0 bg-black/40 rounded-[14px] flex items-center justify-center">
                                <span class="text-white text-xs font-semibold bg-black/30 px-3 py-1 rounded-full">Click to change</span>
                            </div>
                        </div>

                        {{-- Placeholder --}}
                        <div x-show="!previewUrl" class="py-10 px-6 flex flex-col items-center text-center gap-3">
                            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center text-violet-500 group-hover:scale-110 transition-transform">
                                <svg class="w-7 h-7" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-semibold text-slate-700" x-text="fileName ?? 'Click or drag to upload'"></p>
                                <p class="text-xs text-slate-400 mt-0.5" x-show="!fileName">PNG, JPG, WEBP — max 2MB</p>
                            </div>
                        </div>
                    </div>

                    @error('image')
                    <p class="text-xs text-rose-500 font-medium mt-2 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Tips Card --}}
                <div class="craftable-card p-5">
                    <div class="flex items-start gap-3">
                        <div class="w-8 h-8 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 mt-0.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-700 mb-1">Image Tips</p>
                            <ul class="text-xs text-slate-500 space-y-1">
                                <li>• Use 16:9 ratio for best display</li>
                                <li>• Minimum 800×450px recommended</li>
                                <li>• WEBP format for faster loading</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
