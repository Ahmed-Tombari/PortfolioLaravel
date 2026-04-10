@extends('admin.layout.main')
@section('page_title', __('Hero Section'))

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
</style>
@endsection

@section('content')
<div class="space-y-6 animate-fade-up">

@if(!$hero)
    {{-- Empty State --}}
    <div class="max-w-2xl">
        {{-- Alert --}}
        <div class="mb-6 p-4 rounded-2xl bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 flex items-start gap-3">
            <div class="w-9 h-9 rounded-xl bg-amber-100 flex items-center justify-center text-amber-600 flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <p class="text-sm font-bold text-amber-800 mb-0.5">{{ __('Hero Section Not Configured') }}</p>
                <p class="text-sm text-amber-700/80">{{ __('Your landing page currently has no hero section. Fill the form below to activate your portfolio\'s first impression.') }}</p>
            </div>
        </div>

        {{-- Create Hero Form --}}
        <div class="craftable-card p-6 lg:p-8">
            <div class="flex items-center gap-3 mb-6 pb-5 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center text-violet-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">{{ __('Create Hero Section') }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5">{{ __('Configure your landing page hero banner') }}</p>
                </div>
            </div>

            <form action="{{ route('admin.hero.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="md:col-span-2">
                        <label class="aurora-label">{{ __('Title') }} <span class="text-rose-500">*</span></label>
                        <input type="text" name="title" class="admin-input"
                               placeholder="{{ __('e.g., Creative Architect & Developer') }}" required>
                        @error('title') <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p> @enderror
                    </div>
                    <div class="md:col-span-2">
                        <label class="aurora-label">{{ __('Subtitle') }}</label>
                        <input type="text" name="subtitle" class="admin-input"
                               placeholder="{{ __('e.g., Sculpting high-performance digital ecosystems') }}">
                    </div>
                    <div>
                        <label class="aurora-label">{{ __('Button Text') }}</label>
                        <input type="text" name="btn_text" class="admin-input" placeholder="{{ __('Explore Work') }}">
                    </div>
                    <div>
                        <label class="aurora-label">{{ __('Button URL') }}</label>
                        <input type="text" name="btn_url" class="admin-input" placeholder="/portfolio">
                    </div>
                    <div class="md:col-span-2">
                        <label class="aurora-label">{{ __('Hero Image') }}</label>
                        <div x-data="{ isDragging: false, fileName: null }"
                             @dragover.prevent="isDragging = true"
                             @dragleave="isDragging = false"
                             @drop.prevent="isDragging = false; fileName = $event.dataTransfer.files[0]?.name; document.getElementById('hero-img').files = $event.dataTransfer.files"
                             class="border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center cursor-pointer transition-all hover:border-violet-400 hover:bg-violet-50/30"
                             :class="isDragging ? 'border-violet-400 bg-violet-50' : ''"
                             @click="document.getElementById('hero-img').click()">
                            <input id="hero-img" name="image" type="file" accept="image/*" class="sr-only"
                                   @change="fileName = $event.target.files[0]?.name">
                            <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center text-violet-500 mx-auto mb-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5"/></svg>
                            </div>
                            <p class="text-sm font-semibold text-slate-700" x-text="fileName ?? '{{ __('Click or drag to upload') }}'"></p>
                            <p class="text-xs text-slate-400 mt-1" x-show="!fileName">{{ __('PNG, JPG, WEBP — max 2MB') }}</p>
                        </div>
                        @error('image') <p class="text-xs text-rose-500 font-medium mt-1.5">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="flex justify-end pt-4 border-t border-slate-100">
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        {{ __('Create Hero Section') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

@else
    {{-- Preview + Edit --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-2">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">{{ __('Hero Section') }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ __('Your landing page hero configuration') }}</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span> {{ __('Live') }}
            </span>
            <a href="{{ route('admin.hero.edit', $hero->id) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                {{ __('Edit Settings') }}
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- Details Card --}}
        <div class="xl:col-span-2">
            <div class="craftable-card overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-purple-100 flex items-center justify-center text-violet-600">
                        <svg class="w-4.5 h-4.5 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700">{{ __('Active Configuration') }}</h3>
                </div>
                <div class="divide-y divide-slate-50">
                    @php
                        $fields = [
                            ['label' => __('Title'), 'value' => $hero->title, 'icon' => 'M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z'],
                            ['label' => __('Subtitle'), 'value' => $hero->subtitle ?: '—', 'icon' => 'M3.75 9h16.5m-16.5 6.75h16.5'],
                            ['label' => __('Button Text'), 'value' => $hero->btn_text ?: '—', 'icon' => 'M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5'],
                            ['label' => __('Button URL'), 'value' => $hero->btn_url ?: '—', 'icon' => 'M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244'],
                        ];
                    @endphp
                    @foreach($fields as $f)
                    <div class="flex items-start hover:bg-slate-50/50 transition-colors">
                        <div class="w-1/3 shrink-0 px-6 py-4 flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="{{ $f['icon'] }}"/></svg>
                            <span class="text-xs font-semibold text-slate-500 uppercase tracking-wide">{{ $f['label'] }}</span>
                        </div>
                        <div class="px-6 py-4 text-slate-800 font-medium text-sm flex-1 break-all">{{ $f['value'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Image Preview --}}
        <div class="xl:col-span-1">
            <div class="craftable-card p-5">
                <div class="flex items-center gap-3 mb-4 pb-4 border-b border-slate-100">
                    <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-rose-100 to-pink-100 flex items-center justify-center text-rose-500">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-700">{{ __('Hero Image') }}</h3>
                </div>

                @if($hero->image)
                    <div class="rounded-2xl overflow-hidden border border-slate-100 aspect-[4/5] shadow-sm">
                        <img src="{{ asset('storage/' . $hero->image) }}"
                             class="w-full h-full object-cover" alt="{{ __('Hero Image') }}">
                    </div>
                @else
                    <div class="aspect-[4/5] bg-gradient-to-br from-slate-50 to-indigo-50/30 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center text-slate-400 gap-2">
                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5z"/></svg>
                        <span class="text-xs font-semibold text-slate-400">{{ __('No image uploaded') }}</span>
                        <a href="{{ route('admin.hero.edit', $hero->id) }}" class="text-xs text-violet-500 hover:text-violet-700 font-semibold transition-colors">{{ __('Add an image') }} →</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
</div>
@endsection
