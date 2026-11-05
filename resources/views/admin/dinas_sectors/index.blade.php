@extends('layouts.admin')

@section('pageTitle','Kelola Dinas/OPD Sektor')

@section('content')
<div class="container mx-auto px-4 py-6">

  @if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- Header --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <div class="flex items-center justify-between gap-3 flex-wrap">
      <div>
        <h1 class="text-2xl font-bold text-gray-900">Kelola Dinas/OPD Sektor</h1>
        <p class="text-sm text-gray-500 mt-1">
          Halaman ini untuk mengelola daftar <b>sektor dinas/OPD</b> beserta ringkasannya.
          <br class="hidden sm:block">
          <span class="text-xs">Catatan: pengelolaan <b>Desa</b> berada pada menu <b>Sector</b>, bukan di sini.</span>
        </p>
      </div>
    </div>
  </div>

  {{-- Tabel sektor dinas --}}
  <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-gradient-to-r from-gray-50 to-gray-100 border-b-2 border-gray-200">
            <th class="px-6 py-4 text-left">
              <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Nama Sektor (OPD)</span>
            </th>
            <th class="px-6 py-4 text-center w-24">
              <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Ikon</span>
            </th>
            <th class="px-6 py-4 text-left">
              <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Ringkasan</span>
            </th>
            <th class="px-6 py-4 text-center w-56">
              <span class="text-xs font-bold text-gray-700 uppercase tracking-wider">Data OPD</span>
            </th>
          </tr>
        </thead>

        <tbody class="divide-y divide-gray-100">
        @forelse($items as $it)
          <tr class="hover:bg-gray-50 transition-colors duration-150">
            <td class="px-6 py-4">
              <div class="flex items-center gap-2">
                <div class="text-sm font-semibold text-gray-900">
                  {{ $it->nama }}
                </div>

                @if(!is_null($it->is_active))
                  <span class="text-[11px] rounded-full px-2 py-0.5 {{ $it->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                    {{ $it->is_active ? 'Aktif' : 'Nonaktif' }}
                  </span>
                @endif

                @if(!is_null($it->display_order))
                  <span class="text-[11px] rounded-full px-2 py-0.5 bg-slate-100 text-slate-600">
                    #{{ $it->display_order }}
                  </span>
                @endif
              </div>

              @if(!empty($it->group_key))
                <div class="mt-1 text-[11px] text-slate-500">
                  Kelompok: <span class="font-medium">{{ strtoupper(str_replace('_',' ',$it->group_key)) }}</span>
                </div>
              @endif
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
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-slate-100 text-slate-700 text-xs font-medium rounded-lg">
                  Data OPD: {{ $it->records_count ?? 0 }}
                </span>
                <a href="{{ route('admin.opd.index', $it) }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-medium rounded-lg">
                  Kelola Data OPD
                </a>
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-6 py-12 text-center text-slate-500">
              Belum ada sektor dinas/OPD.
            </td>
          </tr>
        @endforelse
        </tbody>
      </table>
    </div>

    @if(method_exists($items,'hasPages') && $items->hasPages())
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
