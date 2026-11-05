@extends('layouts.admin')
@section('pageTitle','Pilih OPD untuk Desa')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-4">Pilih OPD untuk Desa</h1>
  <div class="bg-white rounded-xl border p-6">
    <div class="text-sm text-slate-500 mb-4">
      Desa: <b>{{ $village->nama }}</b> – Kecamatan {{ $village->kecamatan }}
    </div>

    <form onsubmit="event.preventDefault(); const slug=this.opd.value; if(!slug) return; location.href='{{ url('admin/opd') }}/'+slug+'/villages/{{ $village->id }}/create'">
      <label class="block text-sm mb-2">Pilih OPD</label>
      <select name="opd" class="w-full rounded border-slate-300">
        <option value="">— Pilih OPD —</option>
        @foreach($opds as $o)
          <option value="{{ $o->slug }}">{{ $o->nama }}</option>
        @endforeach
      </select>
      <button class="mt-4 px-4 py-2 rounded bg-emerald-600 text-white">Lanjut</button>
    </form>
  </div>
</div>
@endsection
