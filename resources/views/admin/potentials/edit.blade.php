@extends('layouts.admin')

@section('title','Edit Potensi (SDA)')
@section('pageTitle','Edit Potensi (SDA)')
@section('pageSub','Perbarui data sesuai format SDA SETDA')

@section('content')
<div class="max-w-5xl">
  @if(session('success'))
    <div class="mb-6 rounded bg-emerald-50 text-emerald-800 px-4 py-3">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="mb-6 rounded bg-rose-50 text-rose-700 px-4 py-3">
      <div class="font-semibold mb-1">Ada data yang belum valid:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.potentials.update', $potential) }}" method="POST" class="space-y-8">
    @csrf @method('PUT')

    {{-- Informasi Umum --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h2 class="text-lg font-semibold">Informasi Umum</h2>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Judul <span class="text-rose-600">*</span></label>
          <input type="text" name="title" class="w-full rounded border-slate-300"
                 value="{{ old('title', $potential->title) }}" required id="js-title">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Slug (opsional)</label>
          <input type="text" name="slug" class="w-full rounded border-slate-300"
                 value="{{ old('slug', $potential->slug) }}" id="js-slug">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Sektor <span class="text-rose-600">*</span></label>
          <select name="sector_id" class="w-full rounded border-slate-300" required>
            <option value="">— pilih sektor —</option>
            @foreach($sectors as $s)
              <option value="{{ $s->id }}" @selected(old('sector_id', $potential->sector_id)==$s->id)>{{ $s->name }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Ringkasan (opsional)</label>
          <input type="text" name="excerpt" class="w-full rounded border-slate-300"
                 value="{{ old('excerpt', $potential->excerpt) }}">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Deskripsi (opsional)</label>
        <textarea name="content" rows="5" class="w-full rounded border-slate-300">{{ old('content', $potential->content) }}</textarea>
      </div>
    </div>

    {{-- A. Identitas --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">A. Identitas Desa/Kelurahan</h3>
      <div class="grid md:grid-cols-2 gap-4">
        <div><label class="block text-sm font-medium mb-1">Nama Desa/Kelurahan</label>
          <input type="text" name="desa" class="w-full rounded border-slate-300" value="{{ old('desa', $potential->desa) }}"></div>
        <div><label class="block text-sm font-medium mb-1">Kecamatan</label>
          <input type="text" name="kecamatan" class="w-full rounded border-slate-300" value="{{ old('kecamatan', $potential->kecamatan) }}"></div>
        <div><label class="block text-sm font-medium mb-1">Nama Kepala Desa/Lurah</label>
          <input type="text" name="kepala_desa" class="w-full rounded border-slate-300" value="{{ old('kepala_desa', $potential->kepala_desa) }}"></div>
        <div><label class="block text-sm font-medium mb-1">Kontak Person</label>
          <input type="text" name="kontak_person" class="w-full rounded border-slate-300" value="{{ old('kontak_person', $potential->kontak_person) }}"></div>
        <div><label class="block text-sm font-medium mb-1">Luas Wilayah (Ha)</label>
          <input type="number" step="0.01" name="luas_wilayah_ha" class="w-full rounded border-slate-300" value="{{ old('luas_wilayah_ha', $potential->luas_wilayah_ha) }}"></div>
        <div><label class="block text-sm font-medium mb-1">Jumlah Penduduk</label>
          <input type="number" name="jumlah_penduduk" class="w-full rounded border-slate-300" value="{{ old('jumlah_penduduk', $potential->jumlah_penduduk) }}"></div>
        <div class="md:col-span-2"><label class="block text-sm font-medium mb-1">Kelompok Masyarakat/UMKM terkait SDA</label>
          <textarea name="kelompok_umkm" rows="3" class="w-full rounded border-slate-300">{{ old('kelompok_umkm', $potential->kelompok_umkm) }}</textarea></div>
      </div>
    </div>

    {{-- B.1–B.7 & C (isi sama dengan create, tapi pakai old(..., data_get(...))) --}}
    @php
      $p = [
        'pertanian'        => $potential->pertanian ?? [],
        'perkebunan'       => $potential->perkebunan ?? [],
        'perikanan'        => $potential->perikanan ?? [],
        'peternakan'       => $potential->peternakan ?? [],
        'energi'           => $potential->energi ?? [],
        'pertambangan'     => $potential->pertambangan ?? [],
        'lingkungan_hidup' => $potential->lingkungan_hidup ?? [],
        'data_pendukung'   => $potential->data_pendukung ?? [],
      ];
      $v = fn($group,$key,$fallback='') => old("$group.$key", $p[$group][$key] ?? $fallback);
    @endphp

    {{-- B.1 Pertanian --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.1 Pertanian</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Luas sawah (Ha)"           name="pertanian[luas_sawah_ha]"      :value="$v('pertanian','luas_sawah_ha')" type="number" step="0.01"/>
        <x-input-plain label="Luas lahan jagung (Ha)"    name="pertanian[luas_jagung_ha]"     :value="$v('pertanian','luas_jagung_ha')" type="number" step="0.01"/>
        <x-input-plain label="Lahan tadah hujan (Ha)"    name="pertanian[lahan_tadah_hujan_ha]" :value="$v('pertanian','lahan_tadah_hujan_ha')" type="number" step="0.01"/>
      </div>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Komoditas utama"           name="pertanian[komoditas_utama]"    :value="$v('pertanian','komoditas_utama')"/>
        <x-input-plain label="Produksi per tahun (ton)"  name="pertanian[produksi_ton]"       :value="$v('pertanian','produksi_ton')" type="number" step="0.01"/>
      </div>
      <x-textarea-plain label="Permasalahan" name="pertanian[permasalahan]">{{ $v('pertanian','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="pertanian[usulan_program]">{{ $v('pertanian','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.2 Perkebunan --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.2 Perkebunan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Jenis tanaman"               name="perkebunan[jenis]"              :value="$v('perkebunan','jenis')"/>
        <x-input-plain label="Luas areal (Ha)"             name="perkebunan[luas_ha]"            :value="$v('perkebunan','luas_ha')" type="number" step="0.01"/>
        <x-input-plain label="Produksi rata-rata/tahun"    name="perkebunan[produksi_tahunan]"   :value="$v('perkebunan','produksi_tahunan')" type="number" step="0.01"/>
      </div>
      <x-textarea-plain label="Permasalahan" name="perkebunan[permasalahan]">{{ $v('perkebunan','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="perkebunan[usulan_program]">{{ $v('perkebunan','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.3 Perikanan & Kelautan --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.3 Perikanan & Kelautan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Jenis usaha (tangkap/budidaya)" name="perikanan[jenis_usaha]" :value="$v('perikanan','jenis_usaha')"/>
        <x-input-plain label="Luas tambak/kolam (Ha)"         name="perikanan[luas_tambak_ha]" :value="$v('perikanan','luas_tambak_ha')" type="number" step="0.01"/>
        <x-input-plain label="Produksi per tahun (ton)"       name="perikanan[produksi_ton]"  :value="$v('perikanan','produksi_ton')" type="number" step="0.01"/>
      </div>
      <x-input-plain label="Jenis ikan/udang utama" name="perikanan[jenis_utama]" :value="$v('perikanan','jenis_utama')"/>
      <x-textarea-plain label="Permasalahan" name="perikanan[permasalahan]">{{ $v('perikanan','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="perikanan[usulan_program]">{{ $v('perikanan','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.4 Peternakan --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.4 Peternakan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Jenis ternak dominan" name="peternakan[jenis_dominan]" :value="$v('peternakan','jenis_dominan')"/>
        <x-input-plain label="Populasi ternak"      name="peternakan[populasi]"      :value="$v('peternakan','populasi')"/>
        <x-input-plain label="Produksi hasil peternakan" name="peternakan[produksi]" :value="$v('peternakan','produksi')"/>
      </div>
      <x-textarea-plain label="Permasalahan" name="peternakan[permasalahan]">{{ $v('peternakan','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="peternakan[usulan_program]">{{ $v('peternakan','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.5 Energi & EBT --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.5 Energi & Energi Terbarukan</h3>
      <div class="grid md:grid-cols-4 gap-4">
        <x-input-plain label="Potensi tenaga surya (kWp)"     name="energi[potensi_surya_kwp]" :value="$v('energi','potensi_surya_kwp')" type="number" step="0.01"/>
        <x-input-plain label="Potensi tenaga angin (kWp)"     name="energi[potensi_angin_kwp]" :value="$v('energi','potensi_angin_kwp')" type="number" step="0.01"/>
        <x-input-plain label="Potensi mikrohidro (kWp)"       name="energi[potensi_mikrohidro_kwp]" :value="$v('energi','potensi_mikrohidro_kwp')" type="number" step="0.01"/>
        <x-input-plain label="Potensi biogas/biomassa"        name="energi[potensi_biogas]" :value="$v('energi','potensi_biogas')"/>
      </div>
      <x-textarea-plain label="Permasalahan" name="energi[permasalahan]">{{ $v('energi','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="energi[usulan_program]">{{ $v('energi','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.6 Pertambangan --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.6 Pertambangan/Galian C</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-plain label="Jenis galian" name="pertambangan[jenis_galian]" :value="$v('pertambangan','jenis_galian')"/>
        <x-input-plain label="Luas wilayah tambang (Ha)" name="pertambangan[luas_ha]" :value="$v('pertambangan','luas_ha')" type="number" step="0.01"/>
        <x-input-plain label="Status izin (legal/ilegal)" name="pertambangan[status_izin]" :value="$v('pertambangan','status_izin')"/>
      </div>
      <x-textarea-plain label="Dampak lingkungan" name="pertambangan[dampak_lingkungan]">{{ $v('pertambangan','dampak_lingkungan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="pertambangan[usulan_program]">{{ $v('pertambangan','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- B.7 Lingkungan Hidup --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.7 Lingkungan Hidup</h3>
      <x-input-plain label="Kondisi hutan/mangrove" name="lingkungan_hidup[kondisi_hutan]" :value="$v('lingkungan_hidup','kondisi_hutan')"/>
      <x-input-plain label="Data pencemaran (air, tanah, udara)" name="lingkungan_hidup[pencemaran]" :value="$v('lingkungan_hidup','pencemaran')"/>
      <x-input-plain label="Potensi kawasan konservasi" name="lingkungan_hidup[kawasan_konservasi]" :value="$v('lingkungan_hidup','kawasan_konservasi')"/>
      <x-textarea-plain label="Permasalahan utama" name="lingkungan_hidup[permasalahan]">{{ $v('lingkungan_hidup','permasalahan') }}</x-textarea-plain>
      <x-textarea-plain label="Usulan program" name="lingkungan_hidup[usulan_program]">{{ $v('lingkungan_hidup','usulan_program') }}</x-textarea-plain>
    </div>

    {{-- C. Data Pendukung --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">C. Data Pendukung</h3>
      <x-textarea-plain label="Kebutuhan dukungan CSR/Stakeholder" name="data_pendukung[kebutuhan_csr]">{{ $v('data_pendukung','kebutuhan_csr') }}</x-textarea-plain>
      <x-textarea-plain label="Potensi kerja sama dengan OPD Teknis" name="data_pendukung[kerjasama_opd]">{{ $v('data_pendukung','kerjasama_opd') }}</x-textarea-plain>
      <x-textarea-plain label="Data SDM pengelola (kelompok tani, nelayan, dll)" name="data_pendukung[data_sdm]">{{ $v('data_pendukung','data_sdm') }}</x-textarea-plain>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.potentials.index') }}" class="px-4 py-2 rounded border border-slate-300">Batal</a>
      <button class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Update</button>
    </div>
  </form>
</div>

{{-- Helper input sederhana --}}
@macro('input_plain', ['label','name','type'=>'text','value'=>'','step'=>null])
  <div>
    <label class="block text-sm font-medium mb-1">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" value="{{ $value }}" class="w-full rounded border-slate-300" @if($step) step="{{ $step }}" @endif>
  </div>
@endmacro

@macro('textarea_plain', ['label','name'])
  <div>
    <label class="block text-sm font-medium mb-1">{{ $label }}</label>
    <textarea name="{{ $name }}" rows="3" class="w-full rounded border-slate-300">@yield('slot')</textarea>
  </div>
@endmacro

@endsection
