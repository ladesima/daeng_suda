@extends('layouts.admin')

@section('title','Tambah Potensi (SDA)')
@section('pageTitle','Tambah Potensi (SDA)')
@section('pageSub','Lengkapi data sesuai format SDA SETDA')

@section('content')
<div class="max-w-5xl">
  {{-- Notif error --}}
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

  <form action="{{ route('admin.potentials.store') }}" method="POST" class="space-y-8">
    @csrf

    {{-- Header umum --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h2 class="text-lg font-semibold">Informasi Umum</h2>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Judul <span class="text-rose-600">*</span></label>
          <input type="text" name="title" class="w-full rounded border-slate-300"
                 value="{{ old('title') }}" required id="js-title">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Slug (opsional)</label>
          <input type="text" name="slug" class="w-full rounded border-slate-300"
                 value="{{ old('slug') }}" id="js-slug" placeholder="otomatis dari judul jika kosong">
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Sektor <span class="text-rose-600">*</span></label>
          <select name="sector_id" class="w-full rounded border-slate-300" required>
            <option value="">— pilih sektor —</option>
            @foreach($sectors as $s)
              <option value="{{ $s->id }}" @selected(old('sector_id')==$s->id)>{{ $s->name }}</option>
            @endforeach
          </select>
        </div>

        <div>
          <label class="block text-sm font-medium mb-1">Ringkasan (opsional)</label>
          <input type="text" name="excerpt" class="w-full rounded border-slate-300"
                 value="{{ old('excerpt') }}">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Deskripsi (opsional)</label>
        <textarea name="content" rows="5" class="w-full rounded border-slate-300">{{ old('content') }}</textarea>
      </div>
    </div>

    {{-- ==================== A. IDENTITAS ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">A. Identitas Desa/Kelurahan</h3>
      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Nama Desa/Kelurahan</label>
          <input type="text" name="desa" class="w-full rounded border-slate-300" value="{{ old('desa') }}">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Kecamatan</label>
          <input type="text" name="kecamatan" class="w-full rounded border-slate-300" value="{{ old('kecamatan') }}">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Nama Kepala Desa/Lurah</label>
          <input type="text" name="kepala_desa" class="w-full rounded border-slate-300" value="{{ old('kepala_desa') }}">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Kontak Person</label>
          <input type="text" name="kontak_person" class="w-full rounded border-slate-300" value="{{ old('kontak_person') }}">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Luas Wilayah (Ha)</label>
          <input type="number" step="0.01" name="luas_wilayah_ha" class="w-full rounded border-slate-300" value="{{ old('luas_wilayah_ha') }}">
        </div>
        <div>
          <label class="block text-sm font-medium mb-1">Jumlah Penduduk</label>
          <input type="number" name="jumlah_penduduk" class="w-full rounded border-slate-300" value="{{ old('jumlah_penduduk') }}">
        </div>
        <div class="md:col-span-2">
          <label class="block text-sm font-medium mb-1">Kelompok Masyarakat/UMKM terkait SDA</label>
          <textarea name="kelompok_umkm" rows="3" class="w-full rounded border-slate-300">{{ old('kelompok_umkm') }}</textarea>
        </div>
      </div>
    </div>

    {{-- ==================== B.1 Pertanian ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.1 Pertanian</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Luas sawah (Ha)" name="pertanian[luas_sawah_ha]" type="number" step="0.01" :value="old('pertanian.luas_sawah_ha')" />
        <x-input-raw label="Luas lahan jagung (Ha)" name="pertanian[luas_jagung_ha]" type="number" step="0.01" :value="old('pertanian.luas_jagung_ha')" />
        <x-input-raw label="Lahan tadah hujan (Ha)" name="pertanian[lahan_tadah_hujan_ha]" type="number" step="0.01" :value="old('pertanian.lahan_tadah_hujan_ha')" />
      </div>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Komoditas utama" name="pertanian[komoditas_utama]" :value="old('pertanian.komoditas_utama')" />
        <x-input-raw label="Produksi per tahun (ton)" name="pertanian[produksi_ton]" type="number" step="0.01" :value="old('pertanian.produksi_ton')" />
      </div>
      <x-textarea-raw label="Permasalahan" name="pertanian[permasalahan]">{{ old('pertanian.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="pertanian[usulan_program]">{{ old('pertanian.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.2 Perkebunan ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.2 Perkebunan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Jenis tanaman" name="perkebunan[jenis]" :value="old('perkebunan.jenis')" />
        <x-input-raw label="Luas areal (Ha)" name="perkebunan[luas_ha]" type="number" step="0.01" :value="old('perkebunan.luas_ha')" />
        <x-input-raw label="Produksi rata-rata per tahun" name="perkebunan[produksi_tahunan]" type="number" step="0.01" :value="old('perkebunan.produksi_tahunan')" />
      </div>
      <x-textarea-raw label="Permasalahan" name="perkebunan[permasalahan]">{{ old('perkebunan.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="perkebunan[usulan_program]">{{ old('perkebunan.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.3 Perikanan & Kelautan ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.3 Perikanan & Kelautan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Jenis usaha (tangkap/budidaya)" name="perikanan[jenis_usaha]" :value="old('perikanan.jenis_usaha')" />
        <x-input-raw label="Luas tambak/kolam (Ha)" name="perikanan[luas_tambak_ha]" type="number" step="0.01" :value="old('perikanan.luas_tambak_ha')" />
        <x-input-raw label="Produksi per tahun (ton)" name="perikanan[produksi_ton]" type="number" step="0.01" :value="old('perikanan.produksi_ton')" />
      </div>
      <x-input-raw label="Jenis ikan/udang utama" name="perikanan[jenis_utama]" :value="old('perikanan.jenis_utama')" />
      <x-textarea-raw label="Permasalahan" name="perikanan[permasalahan]">{{ old('perikanan.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="perikanan[usulan_program]">{{ old('perikanan.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.4 Peternakan ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.4 Peternakan</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Jenis ternak dominan" name="peternakan[jenis_dominan]" :value="old('peternakan.jenis_dominan')" />
        <x-input-raw label="Populasi ternak" name="peternakan[populasi]" :value="old('peternakan.populasi')" />
        <x-input-raw label="Produksi hasil peternakan" name="peternakan[produksi]" :value="old('peternakan.produksi')" />
      </div>
      <x-textarea-raw label="Permasalahan" name="peternakan[permasalahan]">{{ old('peternakan.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="peternakan[usulan_program]">{{ old('peternakan.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.5 Energi & EBT ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.5 Energi & Energi Terbarukan</h3>
      <div class="grid md:grid-cols-4 gap-4">
        <x-input-raw label="Potensi tenaga surya (kWp)" name="energi[potensi_surya_kwp]" type="number" step="0.01" :value="old('energi.potensi_surya_kwp')" />
        <x-input-raw label="Potensi tenaga angin (kWp)"  name="energi[potensi_angin_kwp]" type="number" step="0.01" :value="old('energi.potensi_angin_kwp')" />
        <x-input-raw label="Potensi mikrohidro (kWp)"     name="energi[potensi_mikrohidro_kwp]" type="number" step="0.01" :value="old('energi.potensi_mikrohidro_kwp')" />
        <x-input-raw label="Potensi biogas/biomassa"       name="energi[potensi_biogas]" :value="old('energi.potensi_biogas')" />
      </div>
      <x-textarea-raw label="Permasalahan" name="energi[permasalahan]">{{ old('energi.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="energi[usulan_program]">{{ old('energi.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.6 Pertambangan/Galian C ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.6 Pertambangan/Galian C</h3>
      <div class="grid md:grid-cols-3 gap-4">
        <x-input-raw label="Jenis galian" name="pertambangan[jenis_galian]" :value="old('pertambangan.jenis_galian')" />
        <x-input-raw label="Luas wilayah tambang (Ha)" name="pertambangan[luas_ha]" type="number" step="0.01" :value="old('pertambangan.luas_ha')" />
        <x-input-raw label="Status izin (legal/ilegal)" name="pertambangan[status_izin]" :value="old('pertambangan.status_izin')" />
      </div>
      <x-textarea-raw label="Dampak lingkungan" name="pertambangan[dampak_lingkungan]">{{ old('pertambangan.dampak_lingkungan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="pertambangan[usulan_program]">{{ old('pertambangan.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== B.7 Lingkungan Hidup ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">B.7 Lingkungan Hidup</h3>
      <x-input-raw label="Kondisi hutan/mangrove" name="lingkungan_hidup[kondisi_hutan]" :value="old('lingkungan_hidup.kondisi_hutan')" />
      <x-input-raw label="Data pencemaran (air, tanah, udara)" name="lingkungan_hidup[pencemaran]" :value="old('lingkungan_hidup.pencemaran')" />
      <x-input-raw label="Potensi kawasan konservasi" name="lingkungan_hidup[kawasan_konservasi]" :value="old('lingkungan_hidup.kawasan_konservasi')" />
      <x-textarea-raw label="Permasalahan utama" name="lingkungan_hidup[permasalahan]">{{ old('lingkungan_hidup.permasalahan') }}</x-textarea-raw>
      <x-textarea-raw label="Usulan program" name="lingkungan_hidup[usulan_program]">{{ old('lingkungan_hidup.usulan_program') }}</x-textarea-raw>
    </div>

    {{-- ==================== C. Data Pendukung ==================== --}}
    <div class="rounded-xl bg-white border border-slate-200 p-5 space-y-4">
      <h3 class="text-lg font-semibold">C. Data Pendukung</h3>
      <x-textarea-raw label="Kebutuhan dukungan CSR/Stakeholder" name="data_pendukung[kebutuhan_csr]">{{ old('data_pendukung.kebutuhan_csr') }}</x-textarea-raw>
      <x-textarea-raw label="Potensi kerja sama dengan OPD Teknis" name="data_pendukung[kerjasama_opd]">{{ old('data_pendukung.kerjasama_opd') }}</x-textarea-raw>
      <x-textarea-raw label="Data SDM pengelola (kelompok tani, nelayan, dll)" name="data_pendukung[data_sdm]">{{ old('data_pendukung.data_sdm') }}</x-textarea-raw>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.potentials.index') }}" class="px-4 py-2 rounded border border-slate-300">Batal</a>
      <button class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Simpan</button>
    </div>
  </form>
</div>

{{-- Komponen input mentah (tanpa dependency) --}}
@once
  @push('scripts')
  <script>
    const ti = document.getElementById('js-title');
    const sl = document.getElementById('js-slug');
    if (ti && sl) {
      ti.addEventListener('input', () => {
        if (!sl.value) {
          sl.value = ti.value.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
        }
      });
    }
  </script>
  @endpush
@endonce

{{-- Helpers inline (input/textarea) --}}
@php
  function inputRaw($label,$name,$value='',$type='text',$attrs=[]) {
    $attrStr = '';
    foreach($attrs as $k=>$v){ $attrStr.=" $k=\"$v\""; }
    return <<<HTML
      <div>
        <label class="block text-sm font-medium mb-1">{$label}</label>
        <input type="{$type}" name="{$name}" value="{$value}" class="w-full rounded border-slate-300" {$attrStr}>
      </div>
    HTML;
  }
@endphp
{{-- Blade components mimic --}}
@macro('input_raw', ['label','name','type'=>'text','value'=>'','step'=>null])
  {!! inputRaw($label,$name,$value,$type,$step?['step'=>$step]:[]) !!}
@endmacro
@macro('textarea_raw', ['label','name'])
  <div>
    <label class="block text-sm font-medium mb-1">{{ $label }}</label>
    <textarea name="{{ $name }}" rows="3" class="w-full rounded border-slate-300">@yield('slot')</textarea>
  </div>
@endmacro

@endsection
