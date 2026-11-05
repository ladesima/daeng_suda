{{-- resources/views/admin/opd/form.blade.php --}}
@extends('layouts.admin')
@section('pageTitle', 'Input Data: '.$sector->nama)

@section('content')
<div class="max-w-5xl mx-auto p-6 bg-white rounded-xl shadow">
  <h1 class="text-2xl font-bold mb-1">{{ $sector->icon }} {{ $sector->nama }}</h1>
  <p class="text-slate-600 mb-6">{{ $sector->summary }}</p>

  <form method="post" enctype="multipart/form-data"
        action="{{ route('admin.opd.store', $sector) }}" class="space-y-5">
    @csrf

    <div class="grid md:grid-cols-3 gap-4">
      <x-input label="Kecamatan" name="kecamatan"/>
      <x-input label="Tahun" name="periode_tahun" type="number"/>
      <x-input label="Tanggal" name="tanggal" type="date"/>
    </div>

    <div class="grid md:grid-cols-2 gap-5">
      @foreach($schema as $f)
        @php($name = "payload[{$f['key']}]")
        <div>
          <label class="block text-sm font-medium text-slate-700 mb-1">{{ $f['label'] }}</label>

          @if(($f['type'] ?? 'text') === 'select')
            <select name="{{ $name }}" class="form-select">
              <option value="">— pilih —</option>
              @foreach($f['options'] ?? [] as $opt)
                <option value="{{ $opt }}">{{ $opt }}</option>
              @endforeach
            </select>
          @elseif(($f['type'] ?? 'text') === 'textarea')
            <textarea name="{{ $name }}" rows="3" class="form-textarea"></textarea>
          @else
            <input type="{{ $f['type'] ?? 'text' }}"
                   name="{{ $name }}"
                   step="{{ $f['step'] ?? null }}"
                   class="form-input">
          @endif

          @error("payload.{$f['key']}")<p class="text-sm text-red-600">{{ $message }}</p>@enderror
        </div>
      @endforeach
    </div>

    <div>
      <label class="block text-sm font-medium text-slate-700 mb-1">Lampiran (opsional, multi)</label>
      <input type="file" name="lampiran[]" multiple class="form-input">
      @error('lampiran.*')<p class="text-sm text-red-600">{{ $message }}</p>@enderror
    </div>

    <div class="flex gap-3">
      <a href="{{ url()->previous() }}" class="btn-outline">Batal</a>
      <button class="btn-primary">Simpan</button>
    </div>
  </form>
</div>
@endsection
