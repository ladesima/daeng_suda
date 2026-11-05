@extends('layouts.app')
@section('title', 'OPD — '.$sector->nama)
@push('styles') @vite('resources/css/front-sectors.css') @endpush

@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <nav class="text-sm text-slate-500 mb-3">
    <a href="{{ route('sectors.all') }}" class="hover:underline">Potensi & OPD</a>
    <span class="mx-1">/</span>
    <span class="text-slate-700 font-medium">{{ $sector->nama }}</span>
  </nav>

  <div class="homecard mb-4">
    <div class="homecard-head">
      <div class="homecard-icon sky">{{ $sector->icon ?? '🏛️' }}</div>
      <div class="min-w-0">
        <h1 class="homecard-title">{{ $sector->nama }}</h1>
        <p class="homecard-sub">{{ $sector->summary }}</p>
      </div>
      <span class="homecard-badge sky">{{ number_format($records->total()) }} data</span>
    </div>
  </div>

  <form method="get" class="homecard mb-4" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap">
    <input type="text" name="q" value="{{ $q }}" placeholder="Cari ringkasan/tahun…" class="border rounded px-3 py-2 grow"
           style="border-color:#e2e8f0; min-width:220px">
    <select name="village_id" class="border rounded px-3 py-2" style="border-color:#e2e8f0; min-width:220px">
      <option value="">— Semua Desa —</option>
      @foreach($villages as $v)
        <option value="{{ $v->id }}" @selected($v->id==$villageId)>{{ $v->nama }}</option>
      @endforeach
    </select>
    <button class="btn btn-primary" type="submit">Terapkan</button>
    <a href="{{ route('opd.public.show', $sector->slug) }}" class="btn btn-ghost">Reset</a>
  </form>

  <div class="homecard">
    <div class="overflow-x-auto">
      <table class="min-w-full text-sm">
        <thead>
          <tr style="background:#f8fafc">
            <th class="px-3 py-2 text-left">Tgl/Tahun</th>
            <th class="px-3 py-2 text-left">Desa</th>
            <th class="px-3 py-2 text-left">Ringkasan</th>
          </tr>
        </thead>
        <tbody>
        @forelse($records as $r)
          <tr class="border-t">
            <td class="px-3 py-2">{{ $r->year ?? $r->created_at?->format('Y-m-d') }}</td>
            <td class="px-3 py-2">{{ $r->village->nama ?? '—' }}</td>
            <td class="px-3 py-2">
              @php
                // jika ada kolom 'summary' pakai; jika bentuk JSON payload, ambil 2-3 key awal
                $summary = $r->summary ?? null;
                if(!$summary && is_array($r->payload ?? null)){
                  $pairs = [];
                  foreach(array_slice($r->payload,0,3) as $k=>$v){ $pairs[] = $k.': '.(is_numeric($v)?number_format($v,2,',','.'): $v); }
                  $summary = implode(' • ', $pairs);
                }
              @endphp
              {{ $summary ?: '—' }}
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="px-3 py-8 text-center text-slate-500">Belum ada data.</td></tr>
        @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">{{ $records->withQueryString()->links() }}</div>
  </div>
</section>
@endsection
