<?php

// database/seeders/DinasSectorsSeeder.php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\DinasSector;
use Illuminate\Support\Str;

class DinasSectorsSeeder extends Seeder {
  public function run(): void {
    $rows = [

/* ===== 1. KELOMPOK INTI TEKNIS SDA (LINGKUNGAN & INFRASTRUKTUR) ===== */
[
 'nama'=>'Dinas PUPR', 'group'=>'inti_sda','icon'=>'🏗️','summary'=>'Irigasi, bendungan, embung, tata ruang.',
 'schema'=>[
   ['key'=>'jml_irigasi','label'=>'Jumlah jaringan irigasi (unit)','type'=>'number'],
   ['key'=>'panjang_irigasi_km','label'=>'Panjang jaringan irigasi (km)','type'=>'number','step'=>'0.01'],
   ['key'=>'jml_bendungan','label'=>'Jumlah bendungan/embung (unit)','type'=>'number'],
   ['key'=>'rencana_tataruang','label'=>'Status rencana tata ruang','type'=>'select','options'=>['Ada & berlaku','Dalam revisi','Belum ada']],
 ]
],
[
 'nama'=>'DLH', 'group'=>'inti_sda','icon'=>'🌿','summary'=>'Kualitas air, udara, pengelolaan sampah.',
 'schema'=>[
   ['key'=>'lokasi_sungai','label'=>'Lokasi sungai/danau','type'=>'text'],
   ['key'=>'indeks_kualitas_air','label'=>'Indeks kualitas air','type'=>'number','step'=>'0.01'],
   ['key'=>'indeks_kualitas_udara','label'=>'Indeks kualitas udara (ISPU)','type'=>'number','step'=>'0.01'],
   ['key'=>'sampah_terkelola_ton','label'=>'Sampah terkelola (ton/hari)','type'=>'number','step'=>'0.01'],
 ]],
[
 'nama'=>'Dinas Kehutanan','group'=>'inti_sda','icon'=>'🌲','summary'=>'Kawasan hutan, konservasi, illegal logging.',
 'schema'=>[
   ['key'=>'luas_hutan_ha','label'=>'Luas kawasan hutan (Ha)','type'=>'number','step'=>'0.01'],
   ['key'=>'luas_konservasi_ha','label'=>'Luas kawasan konservasi (Ha)','type'=>'number','step'=>'0.01'],
   ['key'=>'kasus_illegal_logging','label'=>'Kasus illegal logging (thn)','type'=>'number'],
 ]
],
[
 'nama'=>'DKP','group'=>'inti_sda','icon'=>'🐟','summary'=>'Perikanan: hasil tangkap/budidaya, kualitas air pesisir.',
 'schema'=>[
   ['key'=>'produksi_tangkap_ton','label'=>'Produksi perikanan tangkap (ton/th)','type'=>'number','step'=>'0.01'],
   ['key'=>'produksi_budidaya_ton','label'=>'Produksi budidaya (ton/th)','type'=>'number','step'=>'0.01'],
   ['key'=>'kualitas_air_pesisir','label'=>'Kualitas air pesisir','type'=>'select','options'=>['Baik','Sedang','Buruk']],
 ]
],
[
 'nama'=>'Dinas Pertanian','group'=>'inti_sda','icon'=>'🌾','summary'=>'Luas lahan, panen/gagal panen, kekeringan.',
 'schema'=>[
   ['key'=>'luas_tanam_padi_ha','label'=>'Luas tanam padi (Ha)','type'=>'number','step'=>'0.01'],
   ['key'=>'produksi_padi_ton','label'=>'Produksi padi (ton)','type'=>'number','step'=>'0.01'],
   ['key'=>'kejadian_gagal_panen','label'=>'Kejadian gagal panen (kasus)','type'=>'number'],
   ['key'=>'desa_terdampak_kekeringan','label'=>'Desa terdampak kekeringan (desa)','type'=>'number'],
 ]
],
[
 'nama'=>'PDAM (BUMD)','group'=>'inti_sda','icon'=>'🚰','summary'=>'Lokasi & volume pengambilan air baku, kualitas.',
 'schema'=>[
   ['key'=>'sumber_air_baku','label'=>'Sumber air baku','type'=>'text'],
   ['key'=>'debit_l_per_detik','label'=>'Debit (liter/detik)','type'=>'number','step'=>'0.01'],
   ['key'=>'kualitas_air_baku','label'=>'Kualitas air baku','type'=>'select','options'=>['Baik','Sedang','Buruk']],
 ]
],
[
 'nama'=>'PERKIMTAN','group'=>'inti_sda','icon'=>'🏡','summary'=>'RTH, permukiman, data sanitasi.',
 'schema'=>[
   ['key'=>'rth_eksisting_ha','label'=>'RTH eksisting (Ha)','type'=>'number','step'=>'0.01'],
   ['key'=>'rumah_tidak_layak_huni','label'=>'Rumah tidak layak huni (unit)','type'=>'number'],
   ['key'=>'akses_sanitasi_layak_persen','label'=>'Akses sanitasi layak (%)','type'=>'number','step'=>'0.01'],
 ]
],

/* ===== 2. DUKUNGAN PERENCANAAN & KEUANGAN ===== */
[
 'nama'=>'Bappeda','group'=>'perencanaan','icon'=>'🧭','summary'=>'RPJMD/RKPD, indikator & target SDA.',
 'schema'=>[
   ['key'=>'dok_rpjmd_rkpd','label'=>'Ketersediaan dok. RPJMD/RKPD','type'=>'select','options'=>['Lengkap','Sebagian','Tidak tersedia']],
   ['key'=>'jml_indikator_sda','label'=>'Jumlah indikator SDA','type'=>'number'],
 ]
],
[
 'nama'=>'BPKAD','group'=>'perencanaan','icon'=>'💰','summary'=>'Realisasi anggaran bidang SDA dan infrastruktur SDA.',
 'schema'=>[
   ['key'=>'anggaran_sda_m','label'=>'Realisasi anggaran SDA (Miliar)','type'=>'number','step'=>'0.01'],
   ['key'=>'anggaran_infrastruktur_m','label'=>'Realisasi infrastruktur SDA (Miliar)','type'=>'number','step'=>'0.01'],
]
],
[
 'nama'=>'Bapenda','group'=>'perencanaan','icon'=>'🧾','summary'=>'Retribusi Jasa Usaha SDA (air), pajak tambang, PBB sektor pertanian/kehutanan.',
 'schema'=>[
   ['key'=>'retribusi_usiair_m','label'=>'Realisasi retribusi jasa usaha SDA (Miliar)','type'=>'number','step'=>'0.01'],
   ['key'=>'pajak_tambang_m','label'=>'Pajak pertambangan (Miliar)','type'=>'number','step'=>'0.01'],
 ]
],
[
 'nama'=>'Bagian Adm Pembangunan','group'=>'perencanaan','icon'=>'📊','summary'=>'Capaian kinerja fisik/keuangan program SDA.',
 'schema'=>[
   ['key'=>'capaian_fisik_persen','label'=>'Capaian fisik (%)','type'=>'number','step'=>'0.01'],
   ['key'=>'capaian_keu_persen','label'=>'Capaian keuangan (%)','type'=>'number','step'=>'0.01'],
 ]
],
[
 'nama'=>'Bagian Perekonomian','group'=>'perencanaan','icon'=>'📈','summary'=>'Analisis ekonomi sektoral SDA, kontribusi PDRB.',
 'schema'=>[
   ['key'=>'kontribusi_pdrb_sda_persen','label'=>'Kontribusi PDRB sektor SDA (%)','type'=>'number','step'=>'0.01'],
 ]
],
[
 'nama'=>'Bagian Hukum','group'=>'perencanaan','icon'=>'⚖️','summary'=>'Daftar Perda/Perbup terkait SDA & tata ruang.',
 'schema'=>[
   ['key'=>'jml_perda_terkait','label'=>'Jumlah Perda terkait SDA','type'=>'number'],
   ['key'=>'jml_perbup_terkait','label'=>'Jumlah Perbup terkait SDA','type'=>'number'],
 ]
],

/* ===== 3. SOSIAL, SDM & KEAMANAN ===== */
[
 'nama'=>'Dinas Sosial','group'=>'sosial_sdm','icon'=>'🤝','summary'=>'Data keluarga miskin terdampak bencana/kekeringan & penyaluran bantuan.',
 'schema'=>[
   ['key'=>'kk_terdampak','label'=>'KK terdampak bencana/kekeringan','type'=>'number'],
   ['key'=>'bantuan_disalurkan','label'=>'Bantuan disalurkan (paket)','type'=>'number'],
 ]
],
[
 'nama'=>'Disnakertrans','group'=>'sosial_sdm','icon'=>'👷','summary'=>'Tenaga kerja sektoral SDA (pertanian, perikanan).',
 'schema'=>[
   ['key'=>'tenaga_kerja_pertanian','label'=>'Tenaga kerja pertanian','type'=>'number'],
   ['key'=>'tenaga_kerja_perikanan','label'=>'Tenaga kerja perikanan','type'=>'number'],
 ]
],
[
 'nama'=>'Dukcapil','group'=>'sosial_sdm','icon'=>'🧑‍💼','summary'=>'Kependudukan berdasar profesi di sektor SDA.',
 'schema'=>[
   ['key'=>'nelayan_aktif','label'=>'Jumlah nelayan aktif','type'=>'number'],
   ['key'=>'petani_aktif','label'=>'Jumlah petani aktif','type'=>'number'],
 ]
],
[
 'nama'=>'BKPSDM','group'=>'sosial_sdm','icon'=>'🎓','summary'=>'Jumlah & kompetensi SDM teknis OPD SDA.',
 'schema'=>[
   ['key'=>'sdm_teknis','label'=>'Jumlah SDM teknis OPD SDA','type'=>'number'],
   ['key'=>'sdm_bersertifikat','label'=>'SDM bersertifikat','type'=>'number'],
 ]
],
[
 'nama'=>'Satpol PP','group'=>'sosial_sdm','icon'=>'🛡️','summary'=>'Penertiban pelanggaran Perda SDA.',
 'schema'=>[
   ['key'=>'pelanggaran_sda','label'=>'Kasus pelanggaran SDA (thn)','type'=>'number'],
 ]
],
[
 'nama'=>'Kesbangpol','group'=>'sosial_sdm','icon'=>'🤝','summary'=>'Potensi konflik sosial terkait SDA.',
 'schema'=>[
   ['key'=>'konflik_sda','label'=>'Kasus konflik SDA (thn)','type'=>'number'],
 ]
],

/* ===== 4. PEMANFAATAN & PEMBERDAYAAN ===== */
[
 'nama'=>'Disdagperin','group'=>'pemanfaatan','icon'=>'🏭','summary'=>'Harga komoditas & industri olahan SDA.',
 'schema'=>[
   ['key'=>'harga_komoditas_utama','label'=>'Harga komoditas utama (Rp/kg)','type'=>'number','step'=>'0.01'],
   ['key'=>'jml_industri_pengolahan','label'=>'Jumlah industri pengolahan','type'=>'number'],
 ]
],
[
 'nama'=>'Perhubungan','group'=>'pemanfaatan','icon'=>'🚚','summary'=>'Aksesibilitas sektor SDA (jalan, pelabuhan).',
 'schema'=>[
   ['key'=>'kondisi_jalan_persen_baik','label'=>'Kondisi jalan baik (%)','type'=>'number','step'=>'0.01'],
   ['key'=>'pelabuhan_aktif','label'=>'Jumlah pelabuhan aktif','type'=>'number'],
 ]
],
[
 'nama'=>'Pariwisata','group'=>'pemanfaatan','icon'=>'🗺️','summary'=>'Destinasi wisata alam & daya dukung.',
 'schema'=>[
   ['key'=>'destinasi_wisata_alam','label'=>'Jumlah destinasi wisata alam','type'=>'number'],
   ['key'=>'daya_dukung_dds','label'=>'Daya dukung kawasan (DDS)','type'=>'number'],
 ]
],
[
 'nama'=>'DPMD','group'=>'pemanfaatan','icon'=>'🏘️','summary'=>'Realisasi Dana Desa untuk infrastruktur SDA skala kecil.',
 'schema'=>[
   ['key'=>'jml_embung_desa','label'=>'Embung desa (unit)','type'=>'number'],
   ['key'=>'irigasi_desa_unit','label'=>'Irigasi tersier desa (unit)','type'=>'number'],
 ]
],
[
 'nama'=>'Pemerintah Kecamatan','group'=>'pemanfaatan','icon'=>'🏛️','summary'=>'Potensi kewilayahan & rekap masalah SDA tingkat kecamatan.',
 'schema'=>[
   ['key'=>'potensi_kec','label'=>'Potensi SDA utama kecamatan','type'=>'textarea'],
   ['key'=>'isu_masalah_kec','label'=>'Isu/masalah utama','type'=>'textarea'],
 ]
],

/* ===== 5. OPD LAINNYA (TERKAIT APLIKASI) ===== */
[
 'nama'=>'BPBD','group'=>'lain','icon'=>'🚨','summary'=>'Data bencana: lokasi, frekuensi, kerugian.',
 'schema'=>[
   ['key'=>'jenis_bencana','label'=>'Jenis bencana','type'=>'select','options'=>['Banjir','Kekeringan','Longsor','Angin kencang','Lainnya']],
   ['key'=>'lokasi','label'=>'Lokasi (desa/kec)','type'=>'text'],
   ['key'=>'kejadian','label'=>'Jumlah kejadian (thn)','type'=>'number'],
   ['key'=>'kerugian_juta','label'=>'Estimasi kerugian (juta Rp)','type'=>'number','step'=>'0.01'],
 ]
],
[
 'nama'=>'DKP3','group'=>'lain','icon'=>'🍚','summary'=>'Data cadangan & kerawanan pangan.',
 'schema'=>[
   ['key'=>'stok_pangan_ton','label'=>'Stok pangan (ton)','type'=>'number','step'=>'0.01'],
   ['key'=>'wilayah_rawan_pangan','label'=>'Wilayah rawan pangan (desa)','type'=>'number'],
 ]
],
[
 'nama'=>'DP3A','group'=>'lain','icon'=>'👩','summary'=>'Laporan/isu kerentanan gender bencana SDA.',
 'schema'=>[
   ['key'=>'kasus_gbv_sda','label'=>'Kasus terkait gender (thn)','type'=>'number'],
 ]
],
[
 'nama'=>'Diskominfo','group'=>'lain','icon'=>'💻','summary'=>'Integrasi sistem, kanal data, diseminasi.',
 'schema'=>[
   ['key'=>'integrasi_sistem','label'=>'Status integrasi sistem','type'=>'select','options'=>['Penuh','Sebagian','Belum']],
   ['key'=>'portal_data','label'=>'Portal data aktif (ya/tidak)','type'=>'select','options'=>['Ya','Tidak']],
 ]
],
[
 'nama'=>'Inspektorat','group'=>'lain','icon'=>'📝','summary'=>'LHP audit program/proyek SDA.',
 'schema'=>[
   ['key'=>'lhp_audit_jumlah','label'=>'Jumlah LHP terkait SDA','type'=>'number'],
 ]
],
[
 'nama'=>'Dinas Koperasi & UMKM','group'=>'lain','icon'=>'🧺','summary'=>'UMKM/Koperasi pengolahan hasil SDA.',
 'schema'=>[
   ['key'=>'umkm_pengolahan','label'=>'Jumlah UMKM pengolahan','type'=>'number'],
   ['key'=>'koperasi_aktif','label'=>'Jumlah koperasi aktif','type'=>'number'],
 ]
],
[
 'nama'=>'BAPELITBANGDA','group'=>'lain','icon'=>'🧪','summary'=>'Hasil riset/kajian & peta inovasi SDA.',
 'schema'=>[
   ['key'=>'jml_riset','label'=>'Jumlah riset/kajian SDA','type'=>'number'],
   ['key'=>'tema_riset','label'=>'Tema riset utama','type'=>'textarea'],
 ]]
];

    $order = 1;
    foreach ($rows as $r) {
      DinasSector::updateOrCreate(
        ['slug'=>Str::slug($r['nama'])],
        [
          'nama'=>$r['nama'],
          'slug'=>Str::slug($r['nama']),
          'group_key'=>$r['group'],
          'icon'=>$r['icon'] ?? null,
          'summary'=>$r['summary'] ?? null,
          'form_schema'=>$r['schema'],
          'display_order'=>$order++,
          'is_active'=>true,
        ]
      );
    }
  }
}
