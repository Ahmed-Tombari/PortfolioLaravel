@extends('admin.layout.main')
@section('page_title', 'Projects')

@section('content')
<div class="space-y-6 animate-fade-up">

    {{-- ─── Header ─── --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Project Gallery</h2>
            <p class="text-sm text-slate-500 mt-1">Manage your portfolio showcase items</p>
        </div>
        <a href="{{ route('admin.product.create') }}" class="btn-primary self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Project
        </a>
    </div>

    {{-- ─── Table Card ─── --}}
    <div class="craftable-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left w-24">Media</th>
                        <th class="text-left min-w-[200px]">Project</th>
                        <th class="text-left hidden md:table-cell">Category</th>
                        <th class="text-left hidden lg:table-cell">Slug</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="w-14 h-14 rounded-xl overflow-hidden border border-slate-100 bg-slate-50 shadow-sm">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/100x100/f5f3ff/a855f7?text=?' }}"
                                     class="w-full h-full object-cover" alt="{{ $product->title }}">
                            </div>
                        </td>
                        <td>
                            <div class="max-w-[240px]">
                                <p class="font-semibold text-slate-800 text-sm leading-tight truncate">{{ $product->title }}</p>
                                <p class="text-xs text-slate-400 mt-0.5 truncate max-w-[200px]">{{ Str::limit($product->description, 60) }}</p>
                            </div>
                        </td>
                        <td class="hidden md:table-cell">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold"
                                  style="background: linear-gradient(135deg,#f5f3ff,#eef2ff); color: #7c3aed; border: 1px solid #e8e3ff;">
                                <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span>
                                {{ $product->category->name }}
                            </span>
                        </td>
                        <td class="hidden lg:table-cell">
                            <span class="text-xs text-slate-400 font-mono bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">/{{ $product->slug }}</span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.product.edit', $product->id) }}"
                                   title="Edit"
                                   class="w-8 h-8 rounded-xl border border-violet-100 bg-violet-50 text-violet-600 flex items-center justify-center hover:bg-violet-100 transition-all hover:scale-110">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline"
                                      x-data x-on:submit.prevent="if(confirm('Delete this project permanently?')) $el.submit()">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Delete"
                                        class="w-8 h-8 rounded-xl border border-red-100 bg-red-50 text-red-500 flex items-center justify-center hover:bg-red-100 transition-all hover:scale-110">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="flex flex-col items-center gap-4">
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-violet-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 7.5l-2.25-1.313M21 7.5v2.25m0-2.25l-2.25 1.313M3 7.5l2.25-1.313M3 7.5l2.25 1.313M3 7.5v2.25m9 3l2.25-1.313M12 12.75l-2.25-1.313M12 12.75V15m0 6.75l2.25-1.313M12 21.75V19.5m0 2.25l-2.25-1.313m0-16.875L12 2.25l2.25 1.313M21 14.25v2.25l-9 5.25-9-5.25v-2.25"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">No projects yet</h3>
                                    <p class="text-sm text-slate-400 mt-1">Create your first portfolio project to get started.</p>
                                </div>
                                <a href="{{ route('admin.product.create') }}" class="btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    Add First Project
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Product count footer --}}
        <div class="px-6 py-3 border-t border-slate-100 flex items-center justify-between">
            <span class="text-xs text-slate-400 font-medium">
                {{ $products->count() }} {{ Str::plural('project', $products->count()) }} total
            </span>
        </div>
    </div>

</div>
@endsection
