@extends('admin.layout.main')
@section('page_title', 'New Category')
@section('page_subtitle', 'Add a new portfolio category')
@section('content')

@php
    $isEdit = isset($category);
@endphp

<div class="flex items-center justify-between mb-10">
    <a href="{{ route('admin.category.index') }}"
       class="inline-flex items-center gap-3 text-xs font-black uppercase tracking-widest text-slate-400 hover:text-teal-600 transition-colors group">
        <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Taxonomy Master
    </a>
</div>

<div class="max-w-2xl">
    <div class="aurora-card p-8 lg:p-12">
        <div class="flex items-center justify-between mb-10">
            <div>
                <p class="text-[10px] font-black uppercase tracking-[0.3em] text-teal-600 mb-2">Structural Definition</p>
                <h2 class="text-3xl font-black text-slate-900 tracking-tight">{{ $isEdit ? 'Modify Segment' : 'New Segment' }}</h2>
            </div>
            <div class="w-12 h-12 rounded-2xl bg-slate-50 flex items-center justify-center text-slate-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
        </div>

        <form action="{{ route('admin.category.' . ($isEdit ? 'update' : 'store'), $isEdit ? $category->id : null) }}" method="POST" class="space-y-10">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <div>
                <label class="admin-label">Designation <span class="text-teal-500">*</span></label>
                <input type="text" name="name"
                       value="{{ old('name', $category->name ?? '') }}"
                       class="admin-input @error('name') border-rose-400 ring-4 ring-rose-400/5 focus:border-rose-500 @enderror text-lg font-extrabold"
                       placeholder="e.g., Motion Design"
                       required>
                <div class="mt-4 flex items-center gap-2 group/tip">
                    <div class="w-1.5 h-1.5 rounded-full bg-slate-200 group-hover/tip:bg-teal-500 transition-colors"></div>
                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-wider">URL segment will be generated from this designation</p>
                </div>
                @error('name') <p class="text-rose-500 text-[11px] font-bold mt-3 ml-1 uppercase tracking-wider">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between gap-6 pt-6 border-t border-slate-50">
                <a href="{{ route('admin.category.index') }}"
                   class="px-8 py-4 rounded-xl text-slate-400 text-xs font-black uppercase tracking-widest hover:text-slate-900 hover:bg-slate-50 transition-all">
                    Discard
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-3 px-10 py-4 aurora-gradient text-white rounded-2xl font-black text-xs uppercase tracking-widest shadow-xl shadow-teal-500/20 hover:scale-105 active:scale-95 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="{{ $isEdit ? 'M5 13l4 4L19 7' : 'M12 4v16m8-8H4' }}"/>
                    </svg>
                    {{ $isEdit ? 'Update Segment' : 'Establish Segment' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
