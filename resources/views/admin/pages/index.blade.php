@extends('admin.layouts.app')

@section('title', 'Manajemen Halaman Statis')
@section('page_title', 'Halaman Statis')

@section('content')
<div class="space-y-6">

    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-800">Manajemen Halaman Statis</h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Kelola konten profil instansi, visi-misi, standar pelayanan, dan regulasi.</p>
        </div>
        <a href="{{ Route::has('admin.pages.create') ? route('admin.pages.create') : url('/admin/pages/create') }}" 
           class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-semibold text-xs shadow-md shadow-blue-500/20 hover:shadow-lg hover:-translate-y-0.5 transition-all self-start sm:self-auto">
            <i class="fa-solid fa-plus text-xs"></i>
            <span>Tambah Halaman Baru</span>
        </a>
    </div>

    <!-- Pages Table Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50/80 text-slate-500 font-semibold border-b border-slate-200/80">
                    <tr>
                        <th class="px-4 py-3.5 w-12 text-center">Urutan</th>
                        <th class="px-4 py-3.5">Judul Halaman</th>
                        <th class="px-4 py-3.5">Slug URL</th>
                        <th class="px-4 py-3.5">Kategori</th>
                        <th class="px-4 py-3.5">Status</th>
                        <th class="px-4 py-3.5">Terakhir Diperbarui</th>
                        <th class="px-4 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pages ?? [] as $page)
                        <tr class="hover:bg-slate-50/60 transition">
                            <td class="px-4 py-3.5 text-center font-mono font-bold text-slate-500">
                                {{ $page->order ?? 0 }}
                            </td>
                            <td class="px-4 py-3.5 font-bold text-slate-800">
                                <a href="{{ Route::has('admin.pages.edit') ? route('admin.pages.edit', $page->id) : url('/admin/pages/' . $page->id . '/edit') }}" 
                                   class="hover:text-blue-600 transition">
                                    {{ $page->title }}
                                </a>
                            </td>
                            <td class="px-4 py-3.5 font-mono text-[11px] text-slate-500 whitespace-nowrap">
                                /page/{{ $page->slug }}
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    {{ $page->category ?? 'Umum' }}
                                </span>
                            </td>
                            <td class="px-4 py-3.5 whitespace-nowrap">
                                @if($page->is_active)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-600">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span> Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-slate-400 whitespace-nowrap">
                                {{ $page->updated_at ? $page->updated_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-1.5">
                                    <!-- View on Web -->
                                    <a href="{{ url('/page/' . $page->slug) }}" target="_blank" 
                                       class="p-2 rounded-lg bg-slate-100 text-slate-600 hover:text-blue-600 hover:bg-blue-50 transition" 
                                       title="Lihat di Web">
                                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                                    </a>

                                    <!-- Edit Button -->
                                    <a href="{{ Route::has('admin.pages.edit') ? route('admin.pages.edit', $page->id) : url('/admin/pages/' . $page->id . '/edit') }}" 
                                       class="p-2 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition" 
                                       title="Edit Halaman">
                                        <i class="fa-solid fa-pen-to-square text-xs"></i>
                                    </a>

                                    <!-- Delete Button -->
                                    <form action="{{ Route::has('admin.pages.destroy') ? route('admin.pages.destroy', $page->id) : url('/admin/pages/' . $page->id) }}" 
                                          method="POST" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="p-2 rounded-lg bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition" 
                                                title="Hapus Halaman">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-12 text-center text-slate-400">
                                <i class="fa-solid fa-file-circle-question text-3xl mb-2 text-slate-300 block"></i>
                                Belum ada halaman statis yang dibuat.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($pages) && method_exists($pages, 'links'))
            <div class="p-4 border-t border-slate-100 bg-slate-50/50">
                {{ $pages->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
