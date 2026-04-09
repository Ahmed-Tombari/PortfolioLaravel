@extends('admin.layout.main')
@section('page_title', 'Edit Category')
@section('page_subtitle', 'Update category details')
@section('content')

<div class="flex items-center justify-between mb-8">
    <a href="{{ route('admin.category.index') }}"
       class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 hover:text-slate-900 dark:hover:text-white transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Categories
    </a>
</div>

<div class="max-w-xl">
    <div class="admin-card p-6 md:p-8">
        <form action="{{ route('admin.category.update', $category->id) }}" method="POST" class="space-y-5">
            @csrf @method('PUT')

            <div>
                <label class="admin-label">Category Name <span class="text-red-500 normal-case tracking-normal font-bold text-lg leading-none">*</span></label>
                <input type="text" name="name"
                       value="{{ old('name', $category->name) }}"
                       class="admin-input @error('name') border-red-400 ring-2 ring-red-400/20 @enderror"
                       placeholder="E.g., Web Development"
                       required>
                <p class="mt-2 text-xs text-slate-400">Current slug: <code class="bg-slate-100 dark:bg-slate-800 px-1.5 py-0.5 rounded text-xs font-mono">{{ $category->slug }}</code></p>
                @error('name') <p class="text-red-500 text-xs mt-1.5">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between gap-4 pt-2">
                <a href="{{ route('admin.category.index') }}"
                   class="px-5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-400 text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                    Cancel
                </a>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-7 py-2.5 bg-primary-600 hover:bg-primary-700 text-white rounded-xl font-bold text-sm shadow-lg shadow-primary-600/25 hover:-translate-y-0.5 transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
