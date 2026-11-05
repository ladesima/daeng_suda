@extends('layouts.admin')
@section('pageTitle', 'Input Data — '.$sector->nama)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold">{{ $sector->icon }} {{ $sector->nama }}</h1>
      <p class="text-slate-600">{{ $sector->summary }}</p>
      <p class="text-sm text-slate-500 mt-1">
        Desa: <b>{{ $village->nama }}</b> — Kecamatan {{ $village->kecamatan ?? '—' }}
      </p>
    </div>

    <a href="{{ route('admin.opd.index', $sector->slug) }}"
       class="px-3 py-2 rounded border border-slate-300 hover:bg-slate-50">Kembali</a>
  </div>

  @if($errors->any())
    <div class="rounded border border-rose-200 bg-rose-50 text-rose-700 px-4 py-3">
      <div class="font-semibold mb-1">Periksa kembali isian:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <form method="POST"
        action="{{ route('admin.opd.store', ['sector'=>$sector->slug,'village'=>$village->id]) }}"
        class="bg-white rounded-xl border p-6 space-y-6">
    @csrf

    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label class="text-sm text-slate-600">Periode Tahun</label>
        <input type="number" name="periode_tahun" class="w-full rounded border-slate-300"
               value="{{ old('periode_tahun', now()->year) }}">
      </div>
      <div>
        <label class="text-sm text-slate-600">Tanggal</label>
        <input type="date" name="tanggal" class="w-full rounded border-slate-300"
               value="{{ old('tanggal', now()->toDateString()) }}">
      </div>
      <div>
        <label class="text-sm text-slate-600">Status</label>
        <select name="status" class="w-full rounded border-slate-300">
          <option value="draft" {{ old('status')==='draft'?'selected':'' }}>Draft</option>
          <option value="published" {{ old('status')==='published'?'selected':'' }}>Published</option>
        </select>
      </div>
    </div>

    <hr class="my-2">

    {{-- Field dinamis dari schema --}}
    <div class="grid sm:grid-cols-2 gap-4">
      @foreach($schema as $f)
        @php($key = $f['key'])
        @php($label = $f['label'] ?? $key)
        @php($type = $f['type'] ?? 'text')
        <div>
          <label class="block text-sm text-slate-600 mb-1">{{ $label }}</label>

          @if($type === 'number')
            <input type="number" step="{{ $f['step'] ?? '1' }}" name="{{ $key }}"
                   value="{{ old($key) }}" class="w-full rounded border-slate-300">
          @elseif($type === 'select')
            <select name="{{ $key }}" class="w-full rounded border-slate-300">
              <option value="">— pilih —</option>
              @foreach(($f['options'] ?? []) as $opt)
                <option value="{{ $opt }}" {{ old($key)===$opt?'selected':'' }}>{{ $opt }}</option>
              @endforeach
            </select>
          @elseif($type === 'textarea')
            <textarea name="{{ $key }}" rows="3" class="w-full rounded border-slate-300">{{ old($key) }}</textarea>
          @else
            <input type="text" name="{{ $key }}" value="{{ old($key) }}"
                   class="w-full rounded border-slate-300">
          @endif
        </div>
      @endforeach
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.opd.index', $sector->slug) }}"
         class="px-4 py-2 rounded border border-slate-300 hover:bg-slate-50">Batal</a>
      <button class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
        Simpan
      </button>
    </div>
  </form>
</div>
@endsection
