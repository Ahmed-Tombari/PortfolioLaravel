@extends('admin.layout.main')
@section('page_title', isset($category) ? 'Edit Category' : 'New Category')

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
.admin-input.error { border-color: #f43f5e; box-shadow: 0 0 0 4px rgba(244,63,94,0.1); }
</style>
@endsection

@section('content')
@php $isEdit = isset($category); @endphp

<div class="space-y-6 animate-fade-up">

    {{-- Back --}}
    <a href="{{ route('admin.category.index') }}"
       class="inline-flex items-center gap-2 text-sm font-medium text-slate-400 hover:text-violet-600 transition-colors group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to categories
    </a>

    <div class="max-w-xl">
        <div class="craftable-card p-6 lg:p-8">
            {{-- Card Header --}}
            <div class="flex items-center gap-3 mb-6 pb-5 border-b border-slate-100">
                <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center text-indigo-600">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6h.008v.008H6V6z"/></svg>
                </div>
                <div>
                    <h3 class="text-base font-bold text-slate-800">{{ $isEdit ? 'Edit Category' : 'New Category' }}</h3>
                    <p class="text-xs text-slate-400 mt-0.5">{{ $isEdit ? 'Update your category details' : 'Define a new category for your projects' }}</p>
                </div>
            </div>

            <form action="{{ route('admin.category.' . ($isEdit ? 'update' : 'store'), $isEdit ? $category->id : null) }}"
                  method="POST" class="space-y-5">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <div>
                    <label class="aurora-label">Category Name <span class="text-rose-500">*</span></label>
                    <input type="text" name="name"
                           value="{{ old('name', $category->name ?? '') }}"
                           class="admin-input @error('name') error @enderror"
                           placeholder="e.g., Motion Design, Web Development..."
                           autofocus required>
                    <p class="text-xs text-slate-400 mt-1.5">A URL-friendly slug will be auto-generated from this name.</p>
                    @error('name')
                    <p class="flex items-center gap-1.5 text-xs text-rose-500 font-medium mt-1.5">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- Preview slug --}}
                @if($isEdit && $category->slug)
                <div class="px-4 py-3 bg-slate-50 rounded-xl border border-slate-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244"/></svg>
                    <span class="text-xs text-slate-500">Current slug:</span>
                    <span class="text-xs text-violet-600 font-mono font-semibold">{{ $category->slug }}</span>
                </div>
                @endif

                <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                    <a href="{{ route('admin.category.index') }}" class="btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn-primary">
                        @if($isEdit)
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Save Changes
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Create Category
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
