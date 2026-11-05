@extends('layouts.admin')
@section('pageTitle', ($mode==='create'?'Input':'Ubah').' Data OPD')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
  <div class="mb-4 text-sm text-slate-500">
    OPD: <b>{{ $opd->nama }}</b><br>
    Desa: <b>{{ $village->nama }}</b> – Kecamatan {{ $village->kecamatan }}
  </div>

  <div class="bg-white rounded-xl border p-6">
    @if(session('success'))
      <div class="mb-4 rounded bg-emerald-50 text-emerald-700 px-3 py-2">{{ session('success') }}</div>
    @endif

    <form method="post"
          action="{{ $mode==='create'
                     ? route('opd.records.store',[$opd->slug,$village->id])
                     : route('opd.records.update',$record) }}"
          enctype="multipart/form-data">
      @csrf
      @if($mode==='edit') @method('PUT') @endif

      <div class="grid sm:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm mb-1">Periode Tahun</label>
          <input name="periode_tahun" type="number" class="w-full rounded border-slate-300"
                 value="{{ old('periode_tahun', $record->periode_tahun ?? '') }}">
        </div>
        <div>
          <label class="block text-sm mb-1">Tanggal</label>
          <input name="tanggal" type="date" class="w-full rounded border-slate-300"
                 value="{{ old('tanggal', $record->tanggal ?? '') }}">
        </div>
      </div>

      <hr class="my-5">

      <h3 class="font-semibold mb-3">Isian Utama (sesuai OPD)</h3>

      <div class="grid gap-4">
        @foreach($schema as $f)
          @php
            $key   = $f['key'];
            $label = $f['label'] ?? $key;
            $type  = $f['type'] ?? 'text';
            $val   = old("payload.$key", $record->payload[$key] ?? '');
          @endphp

          <div>
            <label class="block text-sm mb-1">{{ $label }}</label>

            @if($type === 'select')
              <select name="payload[{{ $key }}]" class="w-full rounded border-slate-300">
                <option value="">— pilih —</option>
                @foreach(($f['options'] ?? []) as $opt)
                  <option value="{{ $opt }}" @selected($val==$opt)>{{ $opt }}</option>
                @endforeach
              </select>

            @elseif($type === 'number')
              <input type="number" step="{{ $f['step'] ?? '1' }}"
                     name="payload[{{ $key }}]" class="w-full rounded border-slate-300"
                     value="{{ $val }}">

            @elseif($type === 'textarea')
              <textarea name="payload[{{ $key }}]" rows="3" class="w-full rounded border-slate-300">{{ $val }}</textarea>

            @elseif($type === 'date')
              <input type="date" name="payload[{{ $key }}]" class="w-full rounded border-slate-300"
                     value="{{ $val }}">

            @else
              <input type="text" name="payload[{{ $key }}]" class="w-full rounded border-slate-300"
                     value="{{ $val }}">
            @endif
            @error("payload.$key") <div class="text-red-600 text-xs mt-1">{{ $message }}</div> @enderror
          </div>
        @endforeach
      </div>

      <div class="mt-6">
        <label class="block text-sm mb-1">Lampiran (RAB/foto/pdf, opsional)</label>
        <input type="file" name="lampiran[]" multiple class="block w-full text-sm">
        @if($mode==='edit' && $record->lampiran)
          <div class="text-xs text-slate-500 mt-1">
            {{ count($record->lampiran) }} file tersimpan.
          </div>
        @endif
      </div>

      <div class="mt-6 flex items-center gap-3">
        <a href="{{ $mode==='create' ? route('opd.records.index',$opd) : url()->previous() }}"
           class="px-3 py-2 rounded border">Batal</a>
        <button class="px-4 py-2 rounded bg-emerald-600 text-white">
          {{ $mode==='create' ? 'Simpan' : 'Perbarui' }}
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
