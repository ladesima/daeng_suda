{{-- resources/views/admin/villages/partials/identitas.blade.php --}}
@php
  // Pastikan variabel $sector & $village dipass dari create/edit
  // $village bisa instance kosong (new Village([...])) saat create
@endphp

<div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
  {{-- Info sektor (readonly, tidak bisa dipilih) --}}
  <div class="flex items-center justify-between gap-3">
    <div class="flex items-center gap-2">
      <span class="text-sm text-slate-600">Sektor:</span>
      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
        {{ $sector->name }}
      </span>
    </div>

    {{-- (Opsional) Info ringkas desa saat edit --}}
    @isset($village->id)
      <span class="text-xs text-slate-500">Terakhir diubah: {{ $village->updated_at?->format('d M Y H:i') ?? '-' }}</span>
    @endisset
  </div>

  {{-- (Opsional) hidden id sektor (tidak dipakai di controller, tapi aman) --}}
  <input type="hidden" name="sector_id" value="{{ $sector->id }}"/>

  {{-- Identitas Desa/Kelurahan --}}
  <div>
    <label class="block text-sm font-medium mb-1">
      Nama Desa/Kelurahan <span class="text-rose-600">*</span>
    </label>
    <input type="text" name="nama" class="w-full rounded border-slate-300"
           value="{{ old('nama', $village->nama ?? '') }}" required>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Kecamatan</label>
      <input type="text" name="kecamatan" class="w-full rounded border-slate-300"
             value="{{ old('kecamatan', $village->kecamatan ?? '') }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Kepala Desa/Lurah</label>
      <input type="text" name="kepala_desa" class="w-full rounded border-slate-300"
             value="{{ old('kepala_desa', $village->kepala_desa ?? '') }}">
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Kontak Person</label>
      <input type="text" name="kontak_person" class="w-full rounded border-slate-300"
             value="{{ old('kontak_person', $village->kontak_person ?? '') }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Luas Wilayah (Ha)</label>
      <input type="number" step="0.01" name="luas_wilayah_ha" class="w-full rounded border-slate-300"
             value="{{ old('luas_wilayah_ha', $village->luas_wilayah_ha ?? '') }}">
    </div>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Jumlah Penduduk</label>
      <input type="number" name="jumlah_penduduk" class="w-full rounded border-slate-300"
             value="{{ old('jumlah_penduduk', $village->jumlah_penduduk ?? '') }}">
    </div>
    <div>
      <label class="block text-sm font-medium mb-1">Kelompok Masyarakat/UMKM terkait SDA</label>
      <input type="text" name="kelompok_umkm" class="w-full rounded border-slate-300"
             value="{{ old('kelompok_umkm', $village->kelompok_umkm ?? '') }}">
    </div>
  </div>
</div>
