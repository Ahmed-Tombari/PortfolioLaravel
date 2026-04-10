@extends('admin.layout.main')
@section('page_title', __('Categories'))

@section('content')
<div class="space-y-6 animate-fade-up">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">{{ __('Categories') }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ __('Organize your portfolio projects into segments') }}</p>
        </div>
        <a href="{{ route('admin.category.create') }}" class="btn-primary self-start sm:self-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            {{ __('New Category') }}
        </a>
    </div>

    {{-- Table --}}
    <div class="craftable-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left w-24">{{ __('ID') }}</th>
                        <th class="text-left min-w-[200px]">{{ __('Category Name') }}</th>
                        <th class="text-left hidden md:table-cell">{{ __('Slug') }}</th>
                        <th class="text-left hidden lg:table-cell">{{ __('Projects') }}</th>
                        <th class="text-right">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    @php $projectCount = $category->products()->count(); @endphp
                    <tr>
                        <td>
                            <span class="text-[11px] text-slate-400 font-mono bg-slate-50 px-2 py-0.5 rounded-lg border border-slate-100">#{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</span>
                        </td>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-violet-100 to-indigo-100 flex items-center justify-center font-bold text-sm text-violet-700 flex-shrink-0">
                                    {{ strtoupper(substr($category->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800 text-sm">{{ $category->name }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5">{{ $projectCount }} {{ trans_choice('project|projects', $projectCount) }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="hidden md:table-cell">
                            <span class="text-xs text-slate-400 font-mono bg-slate-50 px-2.5 py-1 rounded-lg border border-slate-100">/{{ $category->slug }}</span>
                        </td>
                        <td class="hidden lg:table-cell">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold"
                                style="background: linear-gradient(135deg,#f5f3ff,#eef2ff); color: #7c3aed;">
                                {{ $projectCount }}
                            </span>
                        </td>
                        <td>
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.category.edit', $category->id) }}"
                                   title="{{ __('Edit') }}"
                                   class="w-8 h-8 rounded-xl border border-violet-100 bg-violet-50 text-violet-600 flex items-center justify-center hover:bg-violet-100 transition-all hover:scale-110">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST" class="inline"
                                      x-data x-on:submit.prevent="if(confirm('{{ __('Delete') }} {{ $category->name }}? {{ __('Projects in this category may be affected.') }}')) $el.submit()">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="{{ __('Delete') }}"
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
                                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 6h.008v.008H6V6z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">{{ __('No categories yet') }}</h3>
                                    <p class="text-sm text-slate-400 mt-1">{{ __('Create a category to start organizing your projects.') }}</p>
                                </div>
                                <a href="{{ route('admin.category.create') }}" class="btn-primary">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    {{ __('Create First Category') }}
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
