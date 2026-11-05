@php
  // Ambil nilai lama (validasi) atau dari data desa (JSON kolom "energi")
  $energi = is_array(old('energi'))
    ? old('energi')
    : (array) ($village->energi ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <div class="flex items-center gap-2 mb-2">
    <h3 class="text-lg font-semibold">Energi & Energi Terbarukan</h3>
    <span class="text-xs px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700">Hanya bidang ini yang aktif</span>
  </div>

  <div class="grid md:grid-cols-3 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Potensi tenaga surya (kWp)</label>
      <input type="number" step="0.01" name="energi[potensi_surya_kwp]" class="w-full rounded border-slate-300"
             value="{{ $energi['potensi_surya_kwp'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Potensi tenaga angin (kWp)</label>
      <input type="number" step="0.01" name="energi[potensi_angin_kwp]" class="w-full rounded border-slate-300"
             value="{{ $energi['potensi_angin_kwp'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Potensi mikrohidro (kWp)</label>
      <input type="number" step="0.01" name="energi[potensi_mikrohidro_kwp]" class="w-full rounded border-slate-300"
             value="{{ $energi['potensi_mikrohidro_kwp'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Potensi biogas/biomassa</label>
    <input type="text" name="energi[potensi_biogas_biomassa]" class="w-full rounded border-slate-300"
           value="{{ $energi['potensi_biogas_biomassa'] ?? '' }}">
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan</label>
    <textarea name="energi[permasalahan]" rows="3" class="w-full rounded border-slate-300">{{ $energi['permasalahan'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="energi[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $energi['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
