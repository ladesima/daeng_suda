@extends('layouts.app')
@section('title', $sector->name)

@section('content')
@php
  $slug = $sector->slug;

  // Mapping kolom per-sektor (key di JSON => Label kolom)
  $columns = [
    'energi' => [
      'potensi_surya_kwp'      => 'Surya (kWp)',
      'potensi_angin_kwp'      => 'Angin (kWp)',
      'potensi_mikrohidro_kwp' => 'Mikrohidro (kWp)',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
    'pertanian' => [
      'luas_sawah_ha'          => 'Sawah (Ha)',
      'luas_jagung_ha'         => 'Jagung (Ha)',
      'lahan_tadah_hujan_ha'   => 'Tadah hujan (Ha)',
      'produksi_ton'           => 'Produksi/th (ton)',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
    'perkebunan' => [
      'jenis_tanaman'          => 'Tanaman',
      'luas_ha'                => 'Luas (Ha)',
      'produksi_tahunan'       => 'Produksi/th',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
    'perikanan' => [
      'jenis_usaha'            => 'Jenis usaha',
      'luas_tambak_ha'         => 'Tambak/Kolam (Ha)',
      'produksi_ton'           => 'Produksi/th (ton)',
      'jenis_ikan_utama'       => 'Komoditas',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
    'peternakan' => [
      'jenis_ternak'           => 'Ternak dominan',
      'populasi_ternak'        => 'Populasi',
      'produksi_hasil'         => 'Hasil (susu/telur/daging)',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
    'pertambangan' => [
      'jenis_galian'           => 'Jenis galian',
      'luas_ha'                => 'Luas (Ha)',
      'status_izin'            => 'Status izin',
      'dampak_lingkungan'      => 'Dampak lingkungan',
      'usulan_program'         => 'Usulan program',
    ],
    'kehutanan' => [
      'luas_hutan_ha'          => 'Luas hutan (Ha)',
      'luas_mangrove_ha'       => 'Mangrove (Ha)',
      'kawasan_konservasi_ha'  => 'Konservasi (Ha)',
      'permasalahan'           => 'Permasalahan',
      'usulan_program'         => 'Usulan program',
    ],
  ];

  // pilih set kolom untuk sektor aktif
  $colSet = $columns[$slug] ?? [];

  // formatter angka sederhana
  $fmt = function ($x) {
    if ($x === null || $x === '') return '-';
    return is_numeric($x) ? number_format((float)$x, 2, ',', '.') : $x;
  };
@endphp

<div class="flex items-center justify-between mb-6">
  <div>
    <h1 class="text-2xl font-extrabold text-emerald-800">{{ $sector->name }}</h1>
    <p class="text-slate-600">{{ $sector->summary }}</p>
  </div>
  <a href="{{ route('sectors.index') }}" class="text-sm text-emerald-700 hover:underline">← Semua Sektor</a>
</div>

<div class="bg-white border rounded overflow-x-auto">
  <table class="w-full text-sm min-w-[960px]">
    <thead class="bg-slate-50">
      <tr>
        <th class="p-3 text-left">Desa/Kelurahan</th>
        <th class="p-3 text-left">Kecamatan</th>
        <th class="p-3 text-left">Kontak</th>
        <th class="p-3 text-left">Penduduk</th>
        @foreach($colSet as $label)
          <th class="p-3 text-left">{{ $label }}</th>
        @endforeach
        <th class="p-3 text-left">Diubah</th>
      </tr>
    </thead>

    <tbody>
      @forelse($villages as $v)
        <tr class="border-t align-top">
          <td class="p-3">{{ $v->nama }}</td>
          <td class="p-3">{{ $v->kecamatan ?? '-' }}</td>
          <td class="p-3">{{ $v->kontak_person ?? '-' }}</td>
          <td class="p-3">{{ $v->jumlah_penduduk ? number_format($v->jumlah_penduduk,0,',','.') : '-' }}</td>

          {{-- kolom dinamis sesuai sektor, ambil dari JSON: $slug.$key --}}
          @foreach($colSet as $key => $label)
            <td class="p-3">
              {{ $fmt(data_get($v, $slug.'.'.$key)) }}
            </td>
          @endforeach

          <td class="p-3 text-slate-600">{{ optional($v->updated_at)->format('d M Y') }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="{{ 5 + count($colSet) }}" class="p-6 text-center text-slate-500">
            Belum ada desa pada sektor ini.
          </td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-4">{{ $villages->links() }}</div>
@endsection
