@extends('admin.layout.main')
@section('page_title', 'Projects')
@section('page_subtitle', 'Manage your portfolio showcase items')

@section('content')
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6 mb-10">
    <div>
        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-teal-600 mb-2">Portfolio Inventory</p>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight">Project Gallery</h2>
    </div>
    <a href="{{ route('admin.product.create') }}"
       class="inline-flex items-center gap-2.5 px-6 py-3.5 aurora-gradient text-white rounded-[1.25rem] font-bold text-sm shadow-xl shadow-teal-500/20 hover:-translate-y-1 hover:shadow-teal-500/30 transition-all active:scale-95">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
        Create New
    </a>
</div>

<div class="aurora-table-card">
    <div class="overflow-x-auto min-h-[400px]">
        <table class="w-full text-sm">
            <thead>
                <tr>
                    <th class="text-left w-24">Media</th>
                    <th class="text-left min-w-[200px]">Project Identity</th>
                    <th class="text-left hidden md:table-cell">Category</th>
                    <th class="text-left hidden lg:table-cell">Unique Path</th>
                    <th class="text-right">Manage</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr class="group">
                    <td>
                        <div class="w-16 h-16 rounded-[1.25rem] overflow-hidden border border-slate-100 bg-slate-50 transition-all group-hover:scale-105 group-hover:shadow-lg group-hover:shadow-slate-200/50">
                            <img src="{{ $product->image ? asset('storage/'.$product->image) : 'https://placehold.co/100x100/f1f5f9/94a3b8?text=?' }}"
                                 class="w-full h-full object-cover" alt="{{ $product->title }}">
                        </div>
                    </td>
                    <td>
                        <div class="max-w-[240px]">
                            <p class="font-extrabold text-slate-900 text-base leading-tight truncate group-hover:text-teal-600 transition-colors">{{ $product->title }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-1 truncate">{{ $product->description }}</p>
                        </div>
                    </td>
                    <td class="hidden md:table-cell">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-slate-50 text-slate-500 text-[10px] font-black uppercase tracking-widest border border-slate-100">
                            {{ $product->category->name }}
                        </span>
                    </td>
                    <td class="hidden lg:table-cell">
                        <span class="text-[11px] font-bold text-slate-300 font-mono italic">/{{ $product->slug }}</span>
                    </td>
                    <td>
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.product.edit', $product->id) }}"
                               class="w-10 h-10 rounded-xl bg-slate-50 text-slate-400 flex items-center justify-center hover:bg-amber-100/50 hover:text-amber-600 transition-all group/btn" title="Edit">
                                <svg class="w-4 h-4 transition-transform group-hover/btn:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="inline"
                                  x-data x-on:submit.prevent="if(confirm('Delete this project permanently?')) $el.submit()">
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
                    <td colspan="5" class="px-6 py-20 text-center">
                        <div class="flex flex-col items-center gap-6">
                            <div class="w-20 h-20 bg-slate-50 rounded-[2rem] flex items-center justify-center text-slate-200">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900 mb-2">Gallery Empty</h3>
                                <p class="text-sm text-slate-400 max-w-[280px] mx-auto">Your masterpiece awaits. Start by creating your first portfolio showcase.</p>
                            </div>
                            <a href="{{ route('admin.product.create') }}" class="inline-flex items-center gap-2 px-8 py-3.5 aurora-gradient text-white rounded-2xl text-sm font-bold shadow-xl shadow-teal-500/20 active:scale-95 transition-all">
                                Initialize Gallery
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
