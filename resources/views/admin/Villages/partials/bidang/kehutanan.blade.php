@php
  $kehutanan = is_array(old('kehutanan'))
    ? old('kehutanan')
    : (array) ($village->kehutanan ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Kehutanan & Lingkungan Hidup</h3>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Kondisi hutan/mangrove</label>
      <input type="text" name="kehutanan[kondisi_hutan_mangrove]" class="w-full rounded border-slate-300"
             value="{{ $kehutanan['kondisi_hutan_mangrove'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Data pencemaran (air, tanah, udara)</label>
      <input type="text" name="kehutanan[data_pencemaran]" class="w-full rounded border-slate-300"
             value="{{ $kehutanan['data_pencemaran'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Potensi kawasan konservasi</label>
    <input type="text" name="kehutanan[potensi_kawasan_konservasi]" class="w-full rounded border-slate-300"
           value="{{ $kehutanan['potensi_kawasan_konservasi'] ?? '' }}">
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan utama</label>
    <textarea name="kehutanan[permasalahan_utama]" rows="3" class="w-full rounded border-slate-300">{{ $kehutanan['permasalahan_utama'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="kehutanan[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $kehutanan['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
