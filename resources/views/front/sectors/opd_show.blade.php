@extends('layouts.app')

@section('title', $opd->nama.' — Data OPD')
@push('styles')
  @vite('resources/css/front-sectors.css')
@endpush

@section('content')
<section class="front-sectors max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Header OPD --}}
  <div class="homecard mb-6">
    <div class="homecard-head">
      <div class="homecard-icon sky">{{ $opd->icon ?? '🏛️' }}</div>
      <div class="min-w-0">
        <h1 class="homecard-title">{{ $opd->nama }}</h1>
        <p class="homecard-sub">{{ $opd->summary }}</p>
      </div>
      <span class="homecard-badge sky">{{ number_format($rows->total()) }} data</span>
    </div>

    {{-- Filter --}}
    <form method="get" class="mt-4 grid gap-3 sm:grid-cols-3">
      <div>
        <label class="block text-sm text-slate-600 mb-1">Desa</label>
        <select name="village_id" class="w-full border rounded-lg px-3 py-2">
          <option value="">Semua desa</option>
          @foreach($villages as $v)
            <option value="{{ $v->id }}" @selected((string)$villageId===(string)$v->id)>{{ $v->nama }}</option>
          @endforeach
        </select>
      </div>
      <div>
        <label class="block text-sm text-slate-600 mb-1">Tahun</label>
        <input type="number" name="tahun" value="{{ $tahun }}" class="w-full border rounded-lg px-3 py-2" placeholder="mis. 2025">
      </div>
      <div class="self-end">
        <button class="fs-btn fs-btn-primary">Terapkan</button>
        <a href="{{ route('opd.public.show', $opd->slug) }}" class="fs-btn fs-btn-ghost">Reset</a>
      </div>
    </form>
  </div>

  {{-- Tabel data --}}
  @if($rows->count())
    <div class="overflow-x-auto bg-white border rounded-xl">
      <table class="min-w-full text-sm">
        <thead class="bg-slate-50 text-slate-600">
          <tr>
            <th class="text-left px-4 py-3">Judul / Uraian</th>
            <th class="text-left px-4 py-3">Desa</th>
            <th class="text-left px-4 py-3">Tanggal</th>
            {{-- Header dinamis dari key JSON "ringkas" --}}
            @foreach(($ringkasKeys ?? collect()) as $key)
              <th class="text-left px-4 py-3">
                {{ \Illuminate\Support\Str::of($key)->replace('_',' ')->title() }}
              </th>
            @endforeach
          </tr>
        </thead>

        <tbody class="divide-y divide-slate-200">
          @foreach($rows as $r)
            @php
              // Ambil & normalisasi isi ringkas
              $ringkasArr = [];

              // 1) Prioritas kolom "ringkas" (JSON string)
              if (!empty($r->ringkas)) {
                $tmp = json_decode($r->ringkas, true);
                if (is_array($tmp)) $ringkasArr = $tmp;
              }

              // 2) Fallback ke "payload" jika ada
              if (!$ringkasArr && isset($r->payload)) {
                if (is_array($r->payload))       $ringkasArr = $r->payload;
                elseif (is_string($r->payload))  $ringkasArr = json_decode($r->payload, true) ?: [];
              }

              // Tanggal aman (fallback created_at)
              $tgl = $r->tanggal ?? null;
              if (!$tgl && isset($r->created_at)) { $tgl = $r->created_at; }

              // Helper format angka
              $formatNum = function($val) {
                if (is_numeric($val)) {
                  $hasDecimal = (strpos((string)$val, '.') !== false);
                  return number_format((float)$val, $hasDecimal ? 2 : 0, ',', '.');
                }
                return $val;
              };
            @endphp
            <tr>
              <td class="px-4 py-3 font-semibold text-slate-900">
                {{ $r->judul ?? ('Data #'.$r->id) }}
              </td>
              <td class="px-4 py-3">
                {{ $r->village->nama ?? '—' }}
              </td>
              <td class="px-4 py-3">
                @if($tgl)
                  {{ \Carbon\Carbon::parse($tgl)->translatedFormat('d M Y') }}
                @else
                  —
                @endif
              </td>

              {{-- Nilai per kolom "ringkas" sesuai urutan $ringkasKeys --}}
              @foreach(($ringkasKeys ?? collect()) as $key)
                @php $val = $ringkasArr[$key] ?? null; @endphp
                <td class="px-4 py-3 text-slate-700">
                  {{ $val !== null && $val !== '' ? $formatNum($val) : '—' }}
                </td>
              @endforeach
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-4 fs-pagination">
      {!! $rows->onEachSide(1)->links() !!}
    </div>
  @else
    <div class="homecard">Belum ada data pada filter ini.</div>
  @endif

  <div class="mt-6">
    <a href="{{ route('sectors.all', ['opd_page'=>request('opd_page'), 'desa_page'=>request('desa_page')]) }}" class="fs-btn fs-btn-ghost">
      ← Kembali ke daftar sektor
    </a>
  </div>
</section>
@endsection
