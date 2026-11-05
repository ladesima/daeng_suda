@extends('layouts.admin')

@section('title', 'Tambah Desa - '.$sector->name)
@section('pageTitle', 'Tambah Desa')
@section('pageSub', 'Sektor: '.$sector->name)

@section('content')
<div class="max-w-5xl">

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

  {{-- Notifikasi sukses (jika ada) --}}
  @if(session('success'))
    <div class="mb-5 rounded bg-emerald-50 text-emerald-800 px-4 py-3 border border-emerald-200">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('admin.sectors.villages.store', $sector) }}" method="POST" class="space-y-6">
    @csrf

    {{-- Identitas Desa (sektor readonly via badge) --}}
    @include('admin.villages.partials.identitas', [
      'sector'  => $sector,
      'village' => $village,  {{-- instance kosong dari controller --}}
    ])

    {{-- 🔹 Hanya tampilkan bidang sesuai sektor --}}
    @include('admin.villages.partials.tabs', [
      'sector'  => $sector,
      'village' => $village,
    ])

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.sectors.index') }}"
         class="px-4 py-2 rounded border border-slate-300 hover:bg-slate-50">
        Batal
      </a>

      <button type="submit"
              class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
