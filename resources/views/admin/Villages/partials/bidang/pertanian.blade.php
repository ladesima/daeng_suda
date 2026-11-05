@php
  $pertanian = is_array(old('pertanian'))
    ? old('pertanian')
    : (array) ($village->pertanian ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Pertanian</h3>

  <div class="grid md:grid-cols-3 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Luas sawah (Ha)</label>
      <input type="number" step="0.01" name="pertanian[luas_sawah_ha]" class="w-full rounded border-slate-300"
             value="{{ $pertanian['luas_sawah_ha'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Luas lahan jagung (Ha)</label>
      <input type="number" step="0.01" name="pertanian[luas_jagung_ha]" class="w-full rounded border-slate-300"
             value="{{ $pertanian['luas_jagung_ha'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Lahan tadah hujan (Ha)</label>
      <input type="number" step="0.01" name="pertanian[lahan_tadah_hujan_ha]" class="w-full rounded border-slate-300"
             value="{{ $pertanian['lahan_tadah_hujan_ha'] ?? '' }}">
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Komoditas utama</label>
      <input type="text" name="pertanian[komoditas_utama]" class="w-full rounded border-slate-300"
             value="{{ $pertanian['komoditas_utama'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Produksi per tahun (ton)</label>
      <input type="number" step="0.01" name="pertanian[produksi_ton_per_tahun]" class="w-full rounded border-slate-300"
             value="{{ $pertanian['produksi_ton_per_tahun'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan</label>
    <textarea name="pertanian[permasalahan]" rows="3" class="w-full rounded border-slate-300">{{ $pertanian['permasalahan'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="pertanian[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $pertanian['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
