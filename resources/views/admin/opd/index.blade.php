{{-- resources/views/admin/opd/index.blade.php --}}
@extends('layouts.admin')

@section('pageTitle', 'Data '.$sector->nama)

@section('content')
<div class="max-w-6xl mx-auto">
  {{-- Header + Export --}}
  <div class="flex items-center justify-between mb-4">
    <div>
      <h1 class="text-2xl font-bold">{{ $sector->icon }} {{ $sector->nama }}</h1>
      <p class="text-slate-600">{{ $sector->summary }}</p>
    </div>

    <div class="flex items-center gap-2">
      @php
        // Ambil koleksi item dari paginator/koleksi apa pun
        $items = method_exists($rows, 'getCollection')
          ? $rows->getCollection()
          : (is_iterable($rows) ? collect($rows) : collect());

        // Kumpulkan daftar kecamatan unik secara aman
        $kecs = $items->map(function ($r) {
            $desa = (method_exists($r, 'relationLoaded') && $r->relationLoaded('village')) ? $r->village : null;
            return $desa->kecamatan ?? $r->kecamatan;
          })
          ->filter()
          ->unique()
          ->values();
      @endphp

      {{-- Export PDF per kecamatan --}}
      <form method="GET"
            action="{{ route('admin.opd.pdf', $sector->slug ?? $sector->id) }}"
            target="_blank"
            class="flex items-center gap-2">
        <select name="kecamatan" class="px-3 py-2 border rounded text-sm">
          <option value="">Semua kecamatan</option>
          @foreach($kecs as $k)
            <option value="{{ $k }}">{{ $k }}</option>
          @endforeach
        </select>
        <button class="px-3 py-2 bg-rose-600 text-white rounded hover:bg-rose-700 text-sm">
          Export PDF
        </button>
      </form>

      {{-- Input data --}}
      <a class="btn-primary"
         href="{{ route('admin.opd.villages.pick', $sector->slug) }}">
        Input Data
      </a>
    </div>
  </div>

  {{-- Tabel daftar OPD --}}
  <div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">Tanggal</th>
          <th class="px-4 py-3 text-left">Kecamatan/Desa</th>
          <th class="px-4 py-3 text-left">Ringkasan</th>
          <th class="px-4 py-3 text-center">Status</th>
        </tr>
      </thead>
      <tbody class="divide-y">
      @forelse($rows as $r)
        <tr>
          <td class="px-4 py-3">
            {{ $r->tanggal ? \Illuminate\Support\Carbon::parse($r->tanggal)->toDateString() : $r->created_at->toDateString() }}
          </td>

          <td class="px-4 py-3">
            @php
              $desa = (method_exists($r, 'relationLoaded') && $r->relationLoaded('village')) ? $r->village : null;
              $kec  = $desa->kecamatan ?? $r->kecamatan;
            @endphp
            {{ $kec ?: '—' }}
            @if($desa)
              / {{ $desa->nama ?? $desa->name }}
            @endif
          </td>

          <td class="px-4 py-3">
            @php
              $firstKeys = collect($sector->form_schema ?? [])->pluck('key')->take(3);
            @endphp

            @forelse($firstKeys as $k)
              @if(isset($r->payload[$k]))
                <span class="inline-block mr-3">
                  {{ str_replace('_',' ',$k) }}:
                  <b>
                    @php $val = $r->payload[$k]; @endphp
                    {{ is_numeric($val) ? number_format($val, is_float($val+0) ? 2 : 0, ',', '.') : $val }}
                  </b>
                </span>
              @endif
            @empty
              <span class="text-slate-500">—</span>
            @endforelse
          </td>

          <td class="px-4 py-3 text-center">
            {{ strtoupper($r->status ?? 'DRAFT') }}
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada data.</td>
        </tr>
      @endforelse
      </tbody>
    </table>
  </div>

  @if(method_exists($rows, 'links'))
    <div class="mt-4">{{ $rows->links() }}</div>
  @endif
</div>
@endsection
