@php
  $perkebunan = is_array(old('perkebunan'))
    ? old('perkebunan')
    : (array) ($village->perkebunan ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Perkebunan</h3>

  <div>
    <label class="block text-sm font-medium mb-1">Jenis tanaman perkebunan</label>
    <input type="text" name="perkebunan[jenis_tanaman]" class="w-full rounded border-slate-300"
           value="{{ $perkebunan['jenis_tanaman'] ?? '' }}">
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Luas areal (Ha)</label>
      <input type="number" step="0.01" name="perkebunan[luas_areal_ha]" class="w-full rounded border-slate-300"
             value="{{ $perkebunan['luas_areal_ha'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Produksi rata-rata per tahun</label>
      <input type="number" step="0.01" name="perkebunan[produksi_rata_tahun]" class="w-full rounded border-slate-300"
             value="{{ $perkebunan['produksi_rata_tahun'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan</label>
    <textarea name="perkebunan[permasalahan]" rows="3" class="w-full rounded border-slate-300">{{ $perkebunan['permasalahan'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="perkebunan[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $perkebunan['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
