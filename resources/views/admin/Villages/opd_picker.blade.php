@extends('layouts.admin')
@section('pageTitle','Pilih Desa untuk '.$sector->nama)

@section('content')
<div class="max-w-4xl mx-auto">
  <h1 class="text-2xl font-bold mb-4">{{ $sector->icon }} {{ $sector->nama }}</h1>
  <p class="text-slate-600 mb-6">{{ $sector->summary }}</p>

  <div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="min-w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left w-40">Kecamatan</th>
          <th class="px-4 py-3 text-left">Desa/Kelurahan</th>
          <th class="px-4 py-3 text-right w-40">Aksi</th>
        </tr>
      </thead>
      <tbody class="divide-y">
        @forelse($villages as $v)
          <tr>
            <td class="px-4 py-2">{{ $v->kecamatan ?: '—' }}</td>
            <td class="px-4 py-2">{{ $v->nama }}</td>
            <td class="px-4 py-2 text-right">
              <a class="btn-primary"
                 href="{{ route('admin.opd.create', [$sector->slug, $v->id]) }}">
                Isi Data
              </a>
            </td>
          </tr>
        @empty
          <tr><td colspan="3" class="px-4 py-8 text-center text-slate-500">Belum ada desa.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection
