@php
  $perikanan = is_array(old('perikanan'))
    ? old('perikanan')
    : (array) ($village->perikanan ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Perikanan & Kelautan</h3>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Jenis usaha</label>
      <input type="text" placeholder="tangkap / budidaya" name="perikanan[jenis_usaha]" class="w-full rounded border-slate-300"
             value="{{ $perikanan['jenis_usaha'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Luas tambak/kolam (Ha)</label>
      <input type="number" step="0.01" name="perikanan[luas_tambak_kolam_ha]" class="w-full rounded border-slate-300"
             value="{{ $perikanan['luas_tambak_kolam_ha'] ?? '' }}">
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Produksi per tahun (ton)</label>
      <input type="number" step="0.01" name="perikanan[produksi_ton_per_tahun]" class="w-full rounded border-slate-300"
             value="{{ $perikanan['produksi_ton_per_tahun'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Jenis ikan/udang utama</label>
      <input type="text" name="perikanan[jenis_ikan_udang]" class="w-full rounded border-slate-300"
             value="{{ $perikanan['jenis_ikan_udang'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan</label>
    <textarea name="perikanan[permasalahan]" rows="3" class="w-full rounded border-slate-300">{{ $perikanan['permasalahan'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="perikanan[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $perikanan['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
