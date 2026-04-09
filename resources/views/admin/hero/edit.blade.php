@extends('admin.layout.main')
@section('page_title', 'Edit Hero')

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
    box-shadow: 0 0 0 4px rgba(168,85,247,0.12);
}
.admin-input::placeholder { color: #94a3b8; }
.admin-input.error { border-color: #f43f5e; }
</style>
@endsection

@section('content')
<div class="space-y-6 animate-fade-up">

    {{-- Back --}}
    <a href="{{ route('admin.hero.index') }}"
       class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-violet-600 transition-colors group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Hero Section
    </a>

    <form action="{{ route('admin.hero.update', $hero->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- Main Fields --}}
            <div class="xl:col-span-2 space-y-5">
                <div class="craftable-card p-6 md:p-8">
                    <div class="flex items-center gap-3 mb-6 pb-5 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center text-violet-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Hero Content</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Update your landing page hero narrative</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label class="aurora-label">Title <span class="text-rose-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $hero->title) }}"
                                   class="admin-input @error('title') error @enderror"
                                   placeholder="e.g., Creative Developer & Designer" required>
                            @error('title') <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="aurora-label">Subtitle</label>
                            <textarea name="subtitle" rows="4"
                                      class="admin-input resize-none @error('subtitle') error @enderror"
                                      placeholder="A brief description to complement the title...">{{ old('subtitle', $hero->subtitle) }}</textarea>
                            @error('subtitle') <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="aurora-label">Button Text</label>
                                <input type="text" name="btn_text" value="{{ old('btn_text', $hero->btn_text) }}"
                                       class="admin-input" placeholder="Explore Work">
                            </div>
                            <div>
                                <label class="aurora-label">Button URL</label>
                                <input type="text" name="btn_url" value="{{ old('btn_url', $hero->btn_url) }}"
                                       class="admin-input" placeholder="/portfolio">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="craftable-card px-6 py-4 flex items-center justify-between gap-4">
                    <a href="{{ route('admin.hero.index') }}" class="btn-secondary">Discard</a>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Changes
                    </button>
                </div>
            </div>

            {{-- Image --}}
            <div class="xl:col-span-1">
                <div class="craftable-card p-6">
                    <div class="flex items-center gap-3 mb-5 pb-4 border-b border-slate-100">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center text-rose-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                        </div>
                        <div>
                            <h3 class="text-base font-bold text-slate-800">Hero Image</h3>
                            <p class="text-xs text-slate-400 mt-0.5">Upload a replacement image</p>
                        </div>
                    </div>

                    @if($hero->image)
                    <div class="mb-4">
                        <label class="aurora-label mb-2">Current Image</label>
                        <div class="rounded-2xl overflow-hidden border border-slate-100 aspect-[4/5] shadow-sm group relative">
                            <img src="{{ asset('storage/' . $hero->image) }}"
                                 class="w-full h-full object-cover" alt="Hero Image">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center rounded-2xl">
                                <span class="text-white text-xs font-semibold bg-black/40 px-3 py-1.5 rounded-full">Current Image</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div x-data="{ isDragging: false, fileName: null }"
                         @dragover.prevent="isDragging = true"
                         @dragleave="isDragging = false"
                         @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0]?.name; document.getElementById('hero-img').files = $event.dataTransfer.files"
                         class="border-2 border-dashed border-slate-200 rounded-2xl p-6 text-center cursor-pointer transition-all hover:border-violet-400 hover:bg-violet-50/30"
                         :class="isDragging ? 'border-violet-400 bg-violet-50' : ''"
                         @click="document.getElementById('hero-img').click()">
                        <input id="hero-img" name="image" type="file" accept="image/*" class="sr-only"
                               @change="fileName = $event.target.files[0]?.name">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center text-violet-500 mx-auto mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700" x-text="fileName ?? 'Click or drag to upload'"></p>
                        <p class="text-xs text-slate-400 mt-0.5" x-show="!fileName">PNG, JPG, WEBP — max 2MB</p>
                    </div>
                    @error('image') <p class="text-xs text-rose-500 font-medium mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
