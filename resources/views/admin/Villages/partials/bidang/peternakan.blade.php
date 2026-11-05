@php
  $peternakan = is_array(old('peternakan'))
    ? old('peternakan')
    : (array) ($village->peternakan ?? []);
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  <h3 class="text-lg font-semibold">Peternakan</h3>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Jenis ternak dominan</label>
      <input type="text" name="peternakan[jenis_ternak_dominan]" class="w-full rounded border-slate-300"
             value="{{ $peternakan['jenis_ternak_dominan'] ?? '' }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Populasi ternak</label>
      <input type="number" step="0.01" name="peternakan[populasi_ternak]" class="w-full rounded border-slate-300"
             value="{{ $peternakan['populasi_ternak'] ?? '' }}">
    </div>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Produksi hasil (susu, telur, daging)</label>
    <input type="text" name="peternakan[produksi_hasil]" class="w-full rounded border-slate-300"
           value="{{ $peternakan['produksi_hasil'] ?? '' }}">
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Permasalahan</label>
    <textarea name="peternakan[permasalahan]" rows="3" class="w-full rounded border-slate-300">{{ $peternakan['permasalahan'] ?? '' }}</textarea>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Usulan program</label>
    <textarea name="peternakan[usulan_program]" rows="3" class="w-full rounded border-slate-300">{{ $peternakan['usulan_program'] ?? '' }}</textarea>
  </div>
</div>
