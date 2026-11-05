@extends('layouts.admin')

@section('title', 'Desa - '.$sector->name)
@section('pageTitle', 'Data Desa')
@section('pageSub', 'Sektor: '.$sector->name)

@section('content')
<div class="max-w-7xl mx-auto">

  {{-- Breadcrumb --}}
  <nav class="text-sm text-slate-500 mb-4" aria-label="Breadcrumb">
    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
    <span class="mx-1">/</span>
    <a href="{{ route('admin.sectors.index') }}" class="hover:underline">Sektor</a>
    <span class="mx-1">/</span>
    <span class="text-slate-700 font-medium">Desa ({{ $sector->name }})</span>
  </nav>

  {{-- Header --}}
  <div class="flex items-center justify-between gap-3 mb-4">
    <div class="flex items-center gap-3">
      <h1 class="text-2xl font-bold">Data Desa</h1>
      <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
        {{ $sector->name }}
      </span>
      @if(method_exists($items,'total'))
        <span class="text-sm text-slate-500">• {{ number_format($items->total()) }} data</span>
      @endif
    </div>
    <div class="flex items-center gap-2">
      <a href="{{ route('admin.sectors.index') }}"
         class="px-3 py-2 rounded border border-slate-300 hover:bg-slate-50">Kembali ke Sektor</a>
      <a href="{{ route('admin.sectors.villages.create', $sector) }}"
         class="px-3 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded">Tambah Desa</a>
    </div>
  </div>

  {{-- Flash message --}}
  @if(session('success'))
    <div class="mb-4 rounded-lg border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  {{-- Table --}}
  <div class="bg-white border rounded-xl overflow-hidden shadow-sm">
    <div class="overflow-x-auto">
      <table class="w-full table-auto">
        <thead>
          <tr class="bg-slate-50 border-b">
            <th class="p-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Desa/Kel</th>
            <th class="p-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Kecamatan</th>
            <th class="p-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Penduduk</th>
            <th class="p-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">UMKM/CP</th>
            <th class="p-3 text-left text-xs font-semibold text-slate-600 uppercase tracking-wider">Diubah</th>
            <th class="p-3 text-right text-xs font-semibold text-slate-600 uppercase tracking-wider w-[320px]">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100">
          @forelse($items as $v)
            <tr class="hover:bg-slate-50">
              <td class="p-3">
                <div class="font-medium text-slate-900">{{ $v->nama }}</div>
              </td>
              <td class="p-3 text-slate-700">
                {{ $v->kecamatan ?: '—' }}
              </td>
              <td class="p-3 text-slate-700">
                {{ $v->jumlah_penduduk !== null ? number_format($v->jumlah_penduduk,0,',','.') : '—' }}
              </td>
              <td class="p-3 text-slate-700">
                <div class="text-xs">
                  <div><span class="text-slate-500">UMKM:</span> {{ $v->kelompok_umkm ?: '—' }}</div>
                  <div><span class="text-slate-500">CP:</span> {{ $v->kontak_person ?: '—' }}</div>
                </div>
              </td>
              <td class="p-3 text-slate-600">
                {{ optional($v->updated_at)->format('d M Y') ?: '—' }}
              </td>
              <td class="p-3 text-right">
                <div class="inline-flex flex-wrap items-center justify-end gap-2">

                  {{-- Export PDF per-desa --}}
                  <a href="{{ route('admin.sectors.villages.pdf', [$sector->slug, $v->id]) }}"
                     class="px-3 py-1.5 rounded border border-slate-300 text-slate-700 hover:bg-slate-50 text-xs"
                     title="Unduh PDF data desa ini">
                    Export PDF
                  </a>

                  {{-- Edit Desa --}}
                  <a href="{{ route('admin.villages.edit', $v) }}"
                     class="px-3 py-1.5 rounded bg-slate-800 text-white hover:bg-slate-900 text-xs">
                    Edit
                  </a>

                  {{-- Picker OPD untuk Desa ini --}}
                  <a href="{{ route('admin.sectors.villages.opd.picker', [$sector->slug, $v->id]) }}"
                     class="px-3 py-1.5 rounded bg-sky-600 text-white hover:bg-sky-700 text-xs">
                    Isi Data OPD
                  </a>

                  {{-- Hapus Desa --}}
                  <form action="{{ route('admin.villages.destroy', $v) }}" method="POST"
                        onsubmit="return confirm('Hapus desa ini?')" class="inline">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1.5 rounded bg-rose-600 text-white hover:bg-rose-700 text-xs">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="p-10">
                <div class="text-center text-slate-500">
                  <div class="mx-auto w-12 h-12 rounded-full bg-slate-100 grid place-content-center mb-3">
                    <svg class="w-6 h-6 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                      <path d="M20 13V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v7m16 0v5a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-5m16 0h-2.586a1 1 0 0 0-.707.293l-2.414 2.414a1 1 0 0 1-.707.293H8.414a1 1 0 0 1-.707-.293L5.293 13.293A1 1 0 0 0 4.586 13H4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                  </div>
                  Belum ada desa pada sektor ini.
                  <div class="mt-3">
                    <a href="{{ route('admin.sectors.villages.create', $sector) }}"
                       class="inline-flex items-center gap-2 px-3 py-2 bg-emerald-600 text-white rounded">
                      Tambah Desa
                    </a>
                  </div>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination footer --}}
    @if(method_exists($items,'hasPages') && $items->hasPages())
      <div class="px-4 py-3 bg-slate-50 border-t flex items-center justify-between">
        <div class="text-sm text-slate-600">
          Menampilkan
          <b>{{ $items->firstItem() }}</b>–<b>{{ $items->lastItem() }}</b>
          dari <b>{{ $items->total() }}</b> data
        </div>
        <div>{{ $items->links() }}</div>
      </div>
    @endif
  </div>

  {{-- Tombol kembali (mobile) --}}
  <div class="mt-4 md:hidden">
    <a href="{{ route('admin.sectors.index') }}"
       class="inline-block px-3 py-2 rounded border border-slate-300 hover:bg-slate-50">
      Kembali ke Sektor
    </a>
  </div>
</div>
@endsection
