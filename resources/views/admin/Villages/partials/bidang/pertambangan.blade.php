@php
  $tambang = is_array(old('pertambangan'))
    ? old('pertambangan')
    : (array) ($village->pertambangan ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Pertambangan / Galian C</h3>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Jenis galian (pasir, batu, tanah, dll)</label>
      <input type="text" name="pertambangan[jenis_galian]" class="w-full rounded border-slate-300"
             value="{{ $tambang['jenis_galian'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Luas wilayah tambang (Ha)</label>
      <input type="number" step="0.01" name="pertambangan[luas_wilayah_tambang_ha]" class="w-full rounded border-slate-300"
             value="{{ $tambang['luas_wilayah_tambang_ha'] ?? '' }}">
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Status izin</label>
      <input type="text" placeholder="legal / ilegal" name="pertambangan[status_izin]" class="w-full rounded border-slate-300"
             value="{{ $tambang['status_izin'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Dampak lingkungan</label>
      <input type="text" name="pertambangan[dampak_lingkungan]" class="w-full rounded border-slate-300"
             value="{{ $tambang['dampak_lingkungan'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="pertambangan[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $tambang['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
