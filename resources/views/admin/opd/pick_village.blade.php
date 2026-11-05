{{-- resources/views/admin/opd/pick_village.blade.php --}}
@extends('layouts.admin')
@section('pageTitle', 'Pilih Desa — '.($sector->nama ?? $sector->name ?? $sector->slug))

@section('content')
<div class="max-w-5xl mx-auto space-y-4">

  {{-- Header --}}
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold">Pilih Desa</h1>
      <p class="text-slate-600">
        OPD:
        <b>{{ $sector->icon ?? '' }} {{ $sector->nama ?? $sector->name ?? $sector->slug }}</b>
        @if(!empty($sector->summary)) — {{ $sector->summary }} @endif
      </p>
    </div>

    {{-- Kembali ke daftar data OPD --}}
    <a href="{{ route('admin.opd.index', $sector->slug) }}"
       class="px-3 py-2 rounded border border-slate-300 hover:bg-slate-50">
      Kembali
    </a>
  </div>

  {{-- Pencarian --}}
  <form method="get" class="flex gap-2">
    <input
      type="text"
      name="s"
      value="{{ old('s', $search ?? request('s')) }}"
      placeholder="Cari desa/kecamatan…"
      class="w-full rounded border-slate-300"
    >
    <button class="px-3 py-2 rounded bg-slate-800 text-white">Cari</button>
  </form>

  {{-- Tabel desa --}}
  <div class="bg-white rounded-xl border overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">Desa/Kel</th>
          <th class="px-4 py-3 text-left">Kecamatan</th>
          <th class="px-4 py-3 text-left">Sektor Desa</th>
          <th class="px-4 py-3 w-40"></th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @forelse($villages as $v)
          <tr>
            <td class="px-4 py-3 font-medium text-slate-900">{{ $v->nama ?? $v->name }}</td>
            <td class="px-4 py-3">{{ $v->kecamatan ?: '—' }}</td>
            <td class="px-4 py-3 text-slate-600">
              @if($v->sector)
                @php
                  $secLabel = $v->sector->name ?? $v->sector->nama ?? $v->sector->slug ?? '—';
                @endphp
                <span class="rounded-full px-2 py-0.5 text-xs bg-slate-100 text-slate-700">
                  {{ $secLabel }}
                </span>
              @else
                —
              @endif
            </td>
            <td class="px-4 py-3 text-right">
              <a
                class="px-3 py-1.5 rounded bg-emerald-600 text-white hover:bg-emerald-700 text-xs"
                href="{{ route('admin.opd.create', [$sector->slug, $v->id]) }}"
              >
                Pilih & Isi Data
              </a>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="px-4 py-10 text-center text-slate-500">Tidak ada desa.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{-- Pagination (tetap membawa query ?s=) --}}
  {{ method_exists($villages, 'withQueryString') ? $villages->withQueryString()->links() : $villages->links() }}
</div>
@endsection
