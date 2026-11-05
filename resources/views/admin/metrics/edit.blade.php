@extends('layouts.app')
@section('title','Rekap Angka')
@section('content')
<h1 class="text-2xl font-bold mb-4">Rekap Angka</h1>
<form method="POST" action="{{ route('admin.metrics.update',$metric) }}" class="space-y-3 bg-white border rounded p-4">
@csrf @method('PUT')
<div class="grid grid-cols-3 gap-3">
  <label class="block">Kecamatan <input type="number" name="districts" value="{{ old('districts',$metric->districts) }}" class="mt-1 w-full border rounded p-2"></label>
  <label class="block">Desa/Kel <input type="number" name="villages" value="{{ old('villages',$metric->villages) }}" class="mt-1 w-full border rounded p-2"></label>
  <label class="block">Sektor <input type="number" name="sectors" value="{{ old('sectors',$metric->sectors) }}" class="mt-1 w-full border rounded p-2"></label>
</div>
<button class="px-3 py-2 bg-emerald-600 text-white rounded">Simpan</button>
</form>
@endsection
