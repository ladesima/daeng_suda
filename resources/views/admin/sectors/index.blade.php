@extends('layouts.admin')

@section('pageTitle','Kelola Sektor')

@section('content')
<div class="container mx-auto px-4 py-6">

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  @php($allSectors = \App\Models\Sector::orderBy('name')->get(['name','slug']))

  {{-- Header --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex items-center justify-between gap-3 flex-wrap">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Sektor</h1>
        <p class="text-sm text-gray-500 mt-1">Sektor dikunci. Silakan kelola data <b>Desa</b> per sektor.</p>
      </div>

      <div class="flex items-center gap-2 flex-wrap">
        {{-- ✅ Tambah Desa (pilih sektor, pakai SLUG) --}}
        <form
          onsubmit="event.preventDefault();
                    const slug = this.sector_slug.value;
                    if (slug) {
                      const tpl = this.dataset.urlTemplate; // e.g. /admin/sectors/__SLUG__/villages/create
                      location.href = tpl.replace('__SLUG__', slug);
                    }"
          data-url-template="{{ route('admin.sectors.villages.create', ['sector' => '__SLUG__']) }}"
          class="flex items-center gap-2"
        >
          <select name="sector_slug" class="rounded border-slate-300">
            <option value="">— Pilih Sektor —</option>
            @foreach($allSectors as $s)
              <option value="{{ $s->slug }}">{{ $s->name }}</option>
            @endforeach
          </select>
          <button class="px-3 py-2.5 rounded bg-emerald-600 text-white text-sm">Tambah Desa</button>
        </form>

       

        {{-- ❌ Hapus tombol Tambah Sektor (sektor dikunci) --}}
      </div>
    </div>
  </div>

  {{-- Tabel sektor --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
            <th class="px-6 py-4 text-left"><span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Sektor</span></th>
            <th class="px-6 py-4 text-center w-24"><span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Ikon</span></th>
            <th class="px-6 py-4 text-left"><span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Ringkasan</span></th>
            <th class="px-6 py-4 text-center w-48"><span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Aksi</span></th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
        @forelse($items as $it)
          <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <div class="text-sm font-semibold text-gray-900">{{ $it->name }}</div>
                @if(!is_null($it->is_active))
                  <span class="text-[11px] rounded-full px-2 py-0.5 {{ $it->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $it->is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
                @endif
                @if(!is_null($it->order))
                  <span class="text-[11px] rounded-full px-2 py-0.5 bg-slate-100 text-slate-600">#{{ $it->order }}</span>
                @endif
              </div>
            </td>

            <td class="px-6 py-4 text-center">
              <div class="inline-flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg">
                <span class="text-sm font-mono text-gray-700">{{ $it->icon }}</span>
              </div>
            </td>

            <td class="px-6 py-4">
              <p class="text-sm text-gray-600 line-clamp-2">{{ $it->summary }}</p>
            </td>

            <td class="px-6 py-4">
              <div class="flex items-center justify-center gap-2">
                <a href="{{ route('admin.sectors.villages.index', $it) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg">
                  Lihat Desa ({{ $it->villages_count ?? 0 }})
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-6 py-12 text-center text-slate-500">Belum ada sektor.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    @if($items->hasPages())
      <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
        <div class="flex items-center justify-between">
          <div class="text-sm text-gray-600">
            Menampilkan <b>{{ $items->firstItem() }}</b>–<b>{{ $items->lastItem() }}</b> dari <b>{{ $items->total() }}</b> data
          </div>
          <div>{{ $items->links() }}</div>
        </div>
      </div>
    @endif
  </div>
</div>
@endsection
