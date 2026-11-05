{{-- A. Identitas --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">A. Identitas Desa/Kelurahan</h3>
  <div class="grid md:grid-cols-2 gap-4">
    <x-input label="Nama Desa/Kelurahan" name="desa" :value="old('desa', $potential->desa ?? '')" />
    <x-input label="Kecamatan" name="kecamatan" :value="old('kecamatan', $potential->kecamatan ?? '')" />
    <x-input label="Nama Kepala Desa/Lurah" name="kepala_desa" :value="old('kepala_desa', $potential->kepala_desa ?? '')" />
    <x-input label="Kontak Person" name="kontak_person" :value="old('kontak_person', $potential->kontak_person ?? '')" />
    <x-input label="Luas Wilayah (Ha)" name="luas_wilayah_ha" type="number" step="0.01" :value="old('luas_wilayah_ha', $potential->luas_wilayah_ha ?? '')" />
    <x-input label="Jumlah Penduduk" name="jumlah_penduduk" type="number" :value="old('jumlah_penduduk', $potential->jumlah_penduduk ?? '')" />
    <div class="md:col-span-2">
      <x-textarea label="Kelompok Masyarakat/UMKM terkait SDA" name="kelompok_umkm">{{ old('kelompok_umkm', $potential->kelompok_umkm ?? '') }}</x-textarea>
    </div>
  </div>
</div>

{{-- B. 1 Pertanian --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.1 Pertanian</h3>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Luas sawah (Ha)" name="pertanian[luas_sawah_ha]" type="number" step="0.01" :value="old('pertanian.luas_sawah_ha', $potential->pertanian['luas_sawah_ha'] ?? '')" />
    <x-input label="Luas lahan jagung (Ha)" name="pertanian[luas_jagung_ha]" type="number" step="0.01" :value="old('pertanian.luas_jagung_ha', $potential->pertanian['luas_jagung_ha'] ?? '')" />
    <x-input label="Lahan tadah hujan (Ha)" name="pertanian[lahan_tadah_hujan_ha]" type="number" step="0.01" :value="old('pertanian.lahan_tadah_hujan_ha', $potential->pertanian['lahan_tadah_hujan_ha'] ?? '')" />
  </div>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Komoditas utama" name="pertanian[komoditas_utama]" :value="old('pertanian.komoditas_utama', $potential->pertanian['komoditas_utama'] ?? '')" />
    <x-input label="Produksi per tahun (ton)" name="pertanian[produksi_ton]" type="number" step="0.01" :value="old('pertanian.produksi_ton', $potential->pertanian['produksi_ton'] ?? '')" />
  </div>
  <x-textarea label="Permasalahan" name="pertanian[permasalahan]">{{ old('pertanian.permasalahan', $potential->pertanian['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="pertanian[usulan_program]">{{ old('pertanian.usulan_program', $potential->pertanian['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 2 Perkebunan --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.2 Perkebunan</h3>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Jenis tanaman" name="perkebunan[jenis]" :value="old('perkebunan.jenis', $potential->perkebunan['jenis'] ?? '')" />
    <x-input label="Luas areal (Ha)" name="perkebunan[luas_ha]" type="number" step="0.01" :value="old('perkebunan.luas_ha', $potential->perkebunan['luas_ha'] ?? '')" />
    <x-input label="Produksi rata-rata/tahun" name="perkebunan[produksi_tahunan]" type="number" step="0.01" :value="old('perkebunan.produksi_tahunan', $potential->perkebunan['produksi_tahunan'] ?? '')" />
  </div>
  <x-textarea label="Permasalahan" name="perkebunan[permasalahan]">{{ old('perkebunan.permasalahan', $potential->perkebunan['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="perkebunan[usulan_program]">{{ old('perkebunan.usulan_program', $potential->perkebunan['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 3 Perikanan & Kelautan --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.3 Perikanan & Kelautan</h3>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Jenis usaha (tangkap/budidaya)" name="perikanan[jenis_usaha]" :value="old('perikanan.jenis_usaha', $potential->perikanan['jenis_usaha'] ?? '')" />
    <x-input label="Luas tambak/kolam (Ha)" name="perikanan[luas_tambak_ha]" type="number" step="0.01" :value="old('perikanan.luas_tambak_ha', $potential->perikanan['luas_tambak_ha'] ?? '')" />
    <x-input label="Produksi per tahun (ton)" name="perikanan[produksi_ton]" type="number" step="0.01" :value="old('perikanan.produksi_ton', $potential->perikanan['produksi_ton'] ?? '')" />
  </div>
  <x-input label="Jenis ikan/udang utama" name="perikanan[jenis_utama]" :value="old('perikanan.jenis_utama', $potential->perikanan['jenis_utama'] ?? '')" />
  <x-textarea label="Permasalahan" name="perikanan[permasalahan]">{{ old('perikanan.permasalahan', $potential->perikanan['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="perikanan[usulan_program]">{{ old('perikanan.usulan_program', $potential->perikanan['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 4 Peternakan --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.4 Peternakan</h3>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Jenis ternak dominan" name="peternakan[jenis_dominan]" :value="old('peternakan.jenis_dominan', $potential->peternakan['jenis_dominan'] ?? '')" />
    <x-input label="Populasi ternak" name="peternakan[populasi]" :value="old('peternakan.populasi', $potential->peternakan['populasi'] ?? '')" />
    <x-input label="Produksi hasil peternakan" name="peternakan[produksi]" :value="old('peternakan.produksi', $potential->peternakan['produksi'] ?? '')" />
  </div>
  <x-textarea label="Permasalahan" name="peternakan[permasalahan]">{{ old('peternakan.permasalahan', $potential->peternakan['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="peternakan[usulan_program]">{{ old('peternakan.usulan_program', $potential->peternakan['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 5 Energi & EBT --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.5 Energi & Energi Terbarukan</h3>
  <div class="grid md:grid-cols-4 gap-4">
    <x-input label="Potensi tenaga surya (kWp)" name="energi[potensi_surya_kwp]" type="number" step="0.01" :value="old('energi.potensi_surya_kwp', $potential->energi['potensi_surya_kwp'] ?? '')" />
    <x-input label="Potensi tenaga angin (kWp)" name="energi[potensi_angin_kwp]" type="number" step="0.01" :value="old('energi.potensi_angin_kwp', $potential->energi['potensi_angin_kwp'] ?? '')" />
    <x-input label="Potensi mikrohidro (kWp)" name="energi[potensi_mikrohidro_kwp]" type="number" step="0.01" :value="old('energi.potensi_mikrohidro_kwp', $potential->energi['potensi_mikrohidro_kwp'] ?? '')" />
    <x-input label="Potensi biogas/biomassa" name="energi[potensi_biogas]" :value="old('energi.potensi_biogas', $potential->energi['potensi_biogas'] ?? '')" />
  </div>
  <x-textarea label="Permasalahan" name="energi[permasalahan]">{{ old('energi.permasalahan', $potential->energi['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="energi[usulan_program]">{{ old('energi.usulan_program', $potential->energi['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 6 Pertambangan/Galian C --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.6 Pertambangan/Galian C</h3>
  <div class="grid md:grid-cols-3 gap-4">
    <x-input label="Jenis galian" name="pertambangan[jenis_galian]" :value="old('pertambangan.jenis_galian', $potential->pertambangan['jenis_galian'] ?? '')" />
    <x-input label="Luas wilayah tambang (Ha)" name="pertambangan[luas_ha]" type="number" step="0.01" :value="old('pertambangan.luas_ha', $potential->pertambangan['luas_ha'] ?? '')" />
    <x-input label="Status izin (legal/ilegal)" name="pertambangan[status_izin]" :value="old('pertambangan.status_izin', $potential->pertambangan['status_izin'] ?? '')" />
  </div>
  <x-textarea label="Dampak lingkungan" name="pertambangan[dampak_lingkungan]">{{ old('pertambangan.dampak_lingkungan', $potential->pertambangan['dampak_lingkungan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="pertambangan[usulan_program]">{{ old('pertambangan.usulan_program', $potential->pertambangan['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- B. 7 Lingkungan Hidup --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">B.7 Lingkungan Hidup</h3>
  <x-input label="Kondisi hutan/mangrove" name="lingkungan_hidup[kondisi_hutan]" :value="old('lingkungan_hidup.kondisi_hutan', $potential->lingkungan_hidup['kondisi_hutan'] ?? '')" />
  <x-input label="Data pencemaran (air, tanah, udara)" name="lingkungan_hidup[pencemaran]" :value="old('lingkungan_hidup.pencemaran', $potential->lingkungan_hidup['pencemaran'] ?? '')" />
  <x-input label="Potensi kawasan konservasi" name="lingkungan_hidup[kawasan_konservasi]" :value="old('lingkungan_hidup.kawasan_konservasi', $potential->lingkungan_hidup['kawasan_konservasi'] ?? '')" />
  <x-textarea label="Permasalahan utama" name="lingkungan_hidup[permasalahan]">{{ old('lingkungan_hidup.permasalahan', $potential->lingkungan_hidup['permasalahan'] ?? '') }}</x-textarea>
  <x-textarea label="Usulan program" name="lingkungan_hidup[usulan_program]">{{ old('lingkungan_hidup.usulan_program', $potential->lingkungan_hidup['usulan_program'] ?? '') }}</x-textarea>
</div>

{{-- C. Data Pendukung --}}
<div class="rounded-xl bg-white border border-slate-200 p-4 md:p-6 space-y-4">
  <h3 class="text-lg font-semibold">C. Data Pendukung</h3>
  <x-textarea label="Kebutuhan dukungan CSR/Stakeholder" name="data_pendukung[kebutuhan_csr]">{{ old('data_pendukung.kebutuhan_csr', $potential->data_pendukung['kebutuhan_csr'] ?? '') }}</x-textarea>
  <x-textarea label="Potensi kerja sama dengan OPD Teknis" name="data_pendukung[kerjasama_opd]">{{ old('data_pendukung.kerjasama_opd', $potential->data_pendukung['kerjasama_opd'] ?? '') }}</x-textarea>
  <x-textarea label="Data SDM pengelola (kelompok tani, nelayan, dll)" name="data_pendukung[data_sdm]">{{ old('data_pendukung.data_sdm', $potential->data_pendukung['data_sdm'] ?? '') }}</x-textarea>
</div>
