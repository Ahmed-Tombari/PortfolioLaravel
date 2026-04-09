@extends('admin.layout.main')
@section('page_title', 'Categories')
@section('page_subtitle', 'Manage portfolio project categories')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-teal-600 mb-2">Category Ecosystem</p>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Taxonomy</h2>
    </div>
    <a href="{{ route('admin.category.create') }}"
       class="inline-flex items-center gap-2.5 px-6 py-3.5 aurora-gradient text-white rounded-[1.25rem] font-bold text-sm shadow-xl shadow-teal-500/20 hover:-translate-y-1 hover:shadow-teal-500/30 transition-all active:scale-95">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        New Category
    </a>
</div>

<div class="aurora-table-card">
    <div class="overflow-x-auto min-h-[400px]">
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th class="text-left w-24">Order</th>
                    <th class="text-left min-w-[200px]">Designation</th>
                    <th class="text-left hidden md:table-cell">Identity Path</th>
                    <th class="text-right">Manage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr class="group">
                    <td>
                        <span class="text-xs font-black text-slate-300 font-mono tracking-tighter">#{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</span>
                    </td>
                    <td>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xs font-black shrink-0 border border-teal-100 group-hover:bg-teal-500 group-hover:text-white transition-all duration-300">
                                {{ strtoupper(substr($category->name, 0, 1)) }}
                            </div>
                            <span class="font-extrabold text-slate-900 text-base leading-tight group-hover:text-teal-600 transition-colors">{{ $category->name }}</span>
                        </div>
                    </td>
                    <td class="hidden md:table-cell">
                        <span class="text-[11px] font-bold text-slate-300 font-mono italic">/cat-{{ $category->slug }}</span>
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.category.edit', $category->id) }}"
                               class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-amber-100/50 hover:text-amber-600 transition-all group/btn" title="Edit">
                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="inline"
                                  x-data x-on:submit.prevent="if(confirm('Delete {{ $category->name }}? Products in this category may break.')) $el.submit()">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-rose-100/50 hover:text-rose-600 transition-all group/btn" title="Delete">
                                    <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center gap-6">
                            <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center text-slate-200">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900 mb-2">Structure Wanted</h3>
                                <p class="text-sm text-slate-400 max-w-[280px] mx-auto">Organize your portfolio. Create segments for your projects here.</p>
                            </div>
                            <a href="{{ route('admin.category.create') }}" class="inline-flex items-center gap-2 px-8 py-3.5 aurora-gradient text-white rounded-2xl text-sm font-bold shadow-xl shadow-teal-500/20 active:scale-95 transition-all">
                                Define First Segment
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
