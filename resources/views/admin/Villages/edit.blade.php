@extends('layouts.admin')

@section('title', 'Edit Desa - '.$sector->name)
@section('pageTitle', 'Edit Desa')
@section('pageSub', 'Sektor: '.$sector->name)

@section('content')
<div class="max-w-5xl">

  {{-- Header + Tombol ke Picker OPD --}}
  <div class="flex items-center justify-between mb-5">
    <div class="flex items-center gap-2">
      <h2 class="text-xl font-semibold">Edit Desa: {{ $village->nama }}</h2>
      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
        {{ $sector->name }}
      </span>
    </div>
    <div class="flex items-center gap-2">
      <a class="inline-flex items-center px-3 py-2 rounded bg-sky-600 text-white text-sm"
         href="{{ route('admin.sectors.villages.opd.picker', [$sector->slug, $village->id]) }}">
        Isi Data OPD untuk Desa ini
      </a>
      <a href="{{ route('admin.sectors.villages.index', $sector) }}"
         class="px-3 py-2 rounded border border-slate-300 hover:bg-slate-50 text-sm">
        Kembali
      </a>
    </div>
  </div>

  {{-- Notifikasi error --}}
  @if($errors->any())
    <div class="mb-5 rounded bg-rose-50 text-rose-700 px-4 py-3 border border-rose-200">
      <div class="font-semibold mb-1">Periksa kembali isian:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Notifikasi sukses --}}
  @if(session('success'))
    <div class="mb-5 rounded bg-emerald-50 text-emerald-800 px-4 py-3 border border-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('admin.villages.update', $village) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    {{-- Identitas Desa (sektor readonly via badge) --}}
    @include('admin.villages.partials.identitas', [
      'sector'  => $sector,   {{-- $sector = $village->sector dari controller --}}
      'village' => $village,
    ])

    {{-- 🔹 Hanya tampilkan bidang sesuai sektor --}}
    @include('admin.villages.partials.tabs', [
      'sector'  => $sector,
      'village' => $village,
    ])

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.sectors.villages.index', $sector) }}"
         class="px-4 py-2 rounded border border-slate-300 hover:bg-slate-50">
        Batal
      </a>

      <button type="submit"
              class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
        Update
      </button>
    </div>
  </form>
</div>
@endsection
