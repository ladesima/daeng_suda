@extends('layouts.desa')

@section('title', 'Perbaiki Laporan ESDM')

@section('content')
@php
  $typeLabel = $report->type_label ?? (\App\Models\EsdmReport::typeLabels()[$report->type] ?? ucfirst(str_replace(['_', '-'], ' ', $report->type)));
  $latestPerbaikan = $report->histories ? $report->histories->where('to_status', 'perbaikan')->first() : null;

  $typeIcon = match($report->type) {
    'pju' => '💡',
    'bpbl' => '🏠',
    'jaringan_listrik', 'jaringan-listrik' => '⚡',
    'kebutuhan_energi', 'kebutuhan-energi' => '🔋',
    default => '⚠️',
  };
@endphp

<div class="space-y-4">
  {{-- Header & Back Navigation --}}
  <div class="flex items-center gap-3">
    <a 
      href="{{ route('esdm.desa.report.show', $report) }}"
      class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-emerald-700 hover:border-emerald-300 transition active:scale-95 shadow-xs"
      title="Kembali ke Detail Laporan"
    >
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
    </a>
    <div>
      <h1 class="text-base font-bold text-slate-800 leading-tight">Perbaiki Laporan ESDM</h1>
      <p class="text-[11px] text-slate-500">ID Laporan: #{{ $report->id }} — {{ $typeLabel }}</p>
    </div>
  </div>

  {{-- Admin Correction Notes Box --}}
  <div class="p-4 rounded-3xl bg-amber-50 border border-amber-300 text-amber-900 shadow-xs">
    <div class="flex items-start gap-3">
      <div class="w-9 h-9 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-xs shadow-amber-500/30">
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      </div>
      <div class="flex-1">
        <h3 class="font-bold text-sm text-amber-900">Catatan Perbaikan dari Admin</h3>
        @if ($latestPerbaikan && !empty($latestPerbaikan->catatan))
          <div class="mt-2 p-3 rounded-2xl bg-white/90 border border-amber-200/80 text-xs text-amber-950 font-medium leading-relaxed">
            "{{ $latestPerbaikan->catatan }}"
          </div>
        @else
          <p class="text-xs text-amber-800 mt-1">
            Harap lengkapi atau sesuaikan kembali data laporan berikut agar dapat diproses ke tahap selanjutnya.
          </p>
        @endif
      </div>
    </div>
  </div>

  {{-- Card Edit Form --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100">
      <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shadow-xs">
        {{ $typeIcon }}
      </div>
      <div>
        <h2 class="font-bold text-slate-800 text-sm">Formulir Perbaikan Data</h2>
        <span class="text-xs text-slate-500">{{ $typeLabel }}</span>
      </div>
    </div>

    <form action="{{ route('esdm.desa.report.update', $report) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      @method('PUT')
      <input type="hidden" name="type" value="{{ $report->type }}">

      {{-- ================= TYPE-SPECIFIC FIELDS ================= --}}

      {{-- 1. PJU --}}
      @if ($report->type === 'pju')
        <div>
          <label for="jumlah_titik_pju" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jumlah Titik PJU Eksisting <span class="text-rose-500">*</span>
          </label>
          <div class="relative">
            <input 
              type="number" 
              name="data[jumlah_titik_pju]" 
              id="jumlah_titik_pju" 
              min="0"
              value="{{ old('data.jumlah_titik_pju', $report->data['jumlah_titik_pju'] ?? '') }}"
              required
              class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            >
            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
          </div>
          @error('data.jumlah_titik_pju')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="kondisi" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Kondisi PJU Saat Ini <span class="text-rose-500">*</span>
          </label>
          @php $currentKondisi = old('data.kondisi', $report->data['kondisi'] ?? ''); @endphp
          <select 
            name="data[kondisi]" 
            id="kondisi" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="Baik" {{ $currentKondisi == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak" {{ $currentKondisi == 'Rusak' ? 'selected' : '' }}>Rusak Sebagian</option>
            <option value="Tidak Berfungsi" {{ $currentKondisi == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi / Mati Total</option>
          </select>
          @error('data.kondisi')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="jumlah_rusak" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jumlah Titik Rusak / Mati <span class="text-rose-500">*</span>
          </label>
          <div class="relative">
            <input 
              type="number" 
              name="data[jumlah_rusak]" 
              id="jumlah_rusak" 
              min="0"
              value="{{ old('data.jumlah_rusak', $report->data['jumlah_rusak'] ?? 0) }}"
              required
              class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            >
            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
          </div>
          @error('data.jumlah_rusak')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="kebutuhan_penambahan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Kebutuhan Penambahan Titik Baru <span class="text-rose-500">*</span>
          </label>
          <div class="relative">
            <input 
              type="number" 
              name="data[kebutuhan_penambahan]" 
              id="kebutuhan_penambahan" 
              min="0"
              value="{{ old('data.kebutuhan_penambahan', $report->data['kebutuhan_penambahan'] ?? 0) }}"
              required
              class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            >
            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
          </div>
          @error('data.kebutuhan_penambahan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

      {{-- 2. BPBL --}}
      @elseif ($report->type === 'bpbl')
        <div>
          <label for="jumlah_rumah_tangga" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jumlah Rumah Tangga / Calon Penerima <span class="text-rose-500">*</span>
          </label>
          <div class="relative">
            <input 
              type="number" 
              name="data[jumlah_rumah_tangga]" 
              id="jumlah_rumah_tangga" 
              min="1"
              value="{{ old('data.jumlah_rumah_tangga', $report->data['jumlah_rumah_tangga'] ?? '') }}"
              required
              class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            >
            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">KK</span>
          </div>
          @error('data.jumlah_rumah_tangga')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="status_kebutuhan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Status Kebutuhan <span class="text-rose-500">*</span>
          </label>
          @php $currentStatusKeb = old('data.status_kebutuhan', $report->data['status_kebutuhan'] ?? ''); @endphp
          <select 
            name="data[status_kebutuhan]" 
            id="status_kebutuhan" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="Sangat Membutuhkan" {{ $currentStatusKeb == 'Sangat Membutuhkan' ? 'selected' : '' }}>Sangat Membutuhkan</option>
            <option value="Membutuhkan" {{ $currentStatusKeb == 'Membutuhkan' ? 'selected' : '' }}>Membutuhkan</option>
            <option value="Cukup Membutuhkan" {{ $currentStatusKeb == 'Cukup Membutuhkan' ? 'selected' : '' }}>Cukup Membutuhkan</option>
          </select>
          @error('data.status_kebutuhan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

      {{-- 3. JARINGAN LISTRIK --}}
      @elseif (in_array($report->type, ['jaringan_listrik', 'jaringan-listrik']))
        <div>
          <label for="kondisi_jaringan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Kondisi Jaringan Saat Ini <span class="text-rose-500">*</span>
          </label>
          @php $curKJ = old('data.kondisi_jaringan', $report->data['kondisi_jaringan'] ?? ''); @endphp
          <select 
            name="data[kondisi_jaringan]" 
            id="kondisi_jaringan" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="Baik" {{ $curKJ == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Kurang Baik" {{ $curKJ == 'Kurang Baik' ? 'selected' : '' }}>Kurang Baik</option>
            <option value="Buruk" {{ $curKJ == 'Buruk' ? 'selected' : '' }}>Buruk</option>
          </select>
          @error('data.kondisi_jaringan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="status_jangkauan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Status Jangkauan <span class="text-rose-500">*</span>
          </label>
          @php $curSJ = old('data.status_jangkauan', $report->data['status_jangkauan'] ?? ''); @endphp
          <select 
            name="data[status_jangkauan]" 
            id="status_jangkauan" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="Sudah Terjangkau" {{ $curSJ == 'Sudah Terjangkau' ? 'selected' : '' }}>Sudah Terjangkau</option>
            <option value="Belum Terjangkau" {{ $curSJ == 'Belum Terjangkau' ? 'selected' : '' }}>Belum Terjangkau</option>
          </select>
          @error('data.status_jangkauan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="permasalahan_jaringan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Permasalahan Jaringan <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[permasalahan_jaringan]" 
            id="permasalahan_jaringan" 
            rows="3"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.permasalahan_jaringan', $report->data['permasalahan_jaringan'] ?? '') }}</textarea>
          @error('data.permasalahan_jaringan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="kebutuhan_perluasan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Kebutuhan Perluasan / Penambahan Tiang & Kabel <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[kebutuhan_perluasan]" 
            id="kebutuhan_perluasan" 
            rows="2"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.kebutuhan_perluasan', $report->data['kebutuhan_perluasan'] ?? '') }}</textarea>
          @error('data.kebutuhan_perluasan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

      {{-- 4. KEBUTUHAN ENERGI --}}
      @elseif (in_array($report->type, ['kebutuhan_energi', 'kebutuhan-energi']))
        <div>
          <label for="jenis_kebutuhan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jenis Kebutuhan Energi <span class="text-rose-500">*</span>
          </label>
          @php $curJK = old('data.jenis_kebutuhan', $report->data['jenis_kebutuhan'] ?? ''); @endphp
          <select 
            name="data[jenis_kebutuhan]" 
            id="jenis_kebutuhan" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="Listrik" {{ $curJK == 'Listrik' ? 'selected' : '' }}>Listrik</option>
            <option value="Gas" {{ $curJK == 'Gas' ? 'selected' : '' }}>Gas</option>
            <option value="Energi Surya" {{ $curJK == 'Energi Surya' ? 'selected' : '' }}>Energi Surya</option>
            <option value="Biogas" {{ $curJK == 'Biogas' ? 'selected' : '' }}>Biogas</option>
            <option value="Lainnya" {{ $curJK == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
          </select>
          @error('data.jenis_kebutuhan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="jumlah_kk" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jumlah KK / Kelompok Sasaran <span class="text-rose-500">*</span>
          </label>
          <div class="relative">
            <input 
              type="number" 
              name="data[jumlah_kk]" 
              id="jumlah_kk" 
              min="1"
              value="{{ old('data.jumlah_kk', $report->data['jumlah_kk'] ?? '') }}"
              required
              class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
            >
            <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">KK / Kelompok</span>
          </div>
          @error('data.jumlah_kk')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="kondisi_lapangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Kondisi Lapangan <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[kondisi_lapangan]" 
            id="kondisi_lapangan" 
            rows="3"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.kondisi_lapangan', $report->data['kondisi_lapangan'] ?? '') }}</textarea>
          @error('data.kondisi_lapangan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="usulan_penanganan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Usulan / Kebutuhan Penanganan <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[usulan_penanganan]" 
            id="usulan_penanganan" 
            rows="3"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.usulan_penanganan', $report->data['usulan_penanganan'] ?? '') }}</textarea>
          @error('data.usulan_penanganan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

      {{-- 5. PERMASALAHAN LAINNYA --}}
      @else
        <div>
          <label for="jenis_permasalahan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Jenis Permasalahan <span class="text-rose-500">*</span>
          </label>
          <input 
            type="text" 
            name="data[jenis_permasalahan]" 
            id="jenis_permasalahan" 
            value="{{ old('data.jenis_permasalahan', $report->data['jenis_permasalahan'] ?? '') }}"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
          @error('data.jenis_permasalahan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="tingkat_urgensi" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Tingkat Urgensi <span class="text-rose-500">*</span>
          </label>
          @php $curUrg = old('tingkat_urgensi', $report->tingkat_urgensi ?? ''); @endphp
          <select 
            name="tingkat_urgensi" 
            id="tingkat_urgensi" 
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
            <option value="rendah" {{ $curUrg == 'rendah' ? 'selected' : '' }}>🟢 Rendah</option>
            <option value="sedang" {{ $curUrg == 'sedang' ? 'selected' : '' }}>🟡 Sedang</option>
            <option value="tinggi" {{ $curUrg == 'tinggi' ? 'selected' : '' }}>🔴 Tinggi / Mendesak</option>
          </select>
          @error('tingkat_urgensi')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="uraian_masalah" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Uraian Masalah <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[uraian_masalah]" 
            id="uraian_masalah" 
            rows="3"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.uraian_masalah', $report->data['uraian_masalah'] ?? '') }}</textarea>
          @error('data.uraian_masalah')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="fakta_lapangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Fakta Lapangan <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[fakta_lapangan]" 
            id="fakta_lapangan" 
            rows="2"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.fakta_lapangan', $report->data['fakta_lapangan'] ?? '') }}</textarea>
          @error('data.fakta_lapangan')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="dampak_masyarakat" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Dampak Terhadap Masyarakat <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[dampak_masyarakat]" 
            id="dampak_masyarakat" 
            rows="2"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.dampak_masyarakat', $report->data['dampak_masyarakat'] ?? '') }}</textarea>
          @error('data.dampak_masyarakat')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="usulan_penyelesaian" class="block text-xs font-semibold text-slate-700 mb-1.5">
            Usulan Penyelesaian dari Desa <span class="text-rose-500">*</span>
          </label>
          <textarea 
            name="data[usulan_penyelesaian]" 
            id="usulan_penyelesaian" 
            rows="2"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >{{ old('data.usulan_penyelesaian', $report->data['usulan_penyelesaian'] ?? '') }}</textarea>
          @error('data.usulan_penyelesaian')
            <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
          @enderror
        </div>
      @endif

      {{-- ================= COMMON FIELDS ================= --}}
      {{-- Lokasi --}}
      <div>
        <label for="lokasi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Lokasi <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="lokasi" 
          id="lokasi" 
          value="{{ old('lokasi', $report->lokasi) }}"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
        @error('lokasi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Keterangan --}}
      <div>
        <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Keterangan / Penjelasan Lengkap <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="keterangan" 
          id="keterangan" 
          rows="3"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('keterangan', $report->keterangan) }}</textarea>
        @error('keterangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- ================= EXISTING ATTACHMENTS ================= --}}
      @if ($report->attachments && $report->attachments->count() > 0)
        <div class="pt-2 border-t border-slate-100">
          <label class="block text-xs font-semibold text-slate-700 mb-2">
            Lampiran Saat Ini (Centang untuk menghapus)
          </label>
          <div class="space-y-2">
            @foreach ($report->attachments as $att)
              @php
                $ext = strtolower(pathinfo($att->file_path, PATHINFO_EXTENSION));
                $isImg = in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif']);
                $url = $att->file_url;
              @endphp
              <label class="flex items-center justify-between p-2.5 rounded-2xl border border-slate-200 bg-slate-50 hover:bg-slate-100 cursor-pointer transition">
                <div class="flex items-center gap-2.5 min-w-0">
                  @if ($isImg)
                    <img src="{{ $url }}" alt="Preview" class="w-10 h-10 rounded-lg object-cover shrink-0">
                  @else
                    <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    </div>
                  @endif
                  <div class="min-w-0">
                    <div class="text-xs font-semibold text-slate-800 truncate">{{ $att->original_name ?? 'Berkas' }}</div>
                    <div class="text-[10px] text-slate-400 uppercase font-mono">{{ $ext ?: 'FILE' }}</div>
                  </div>
                </div>

                <div class="flex items-center gap-2 shrink-0 pl-2">
                  <span class="text-[11px] text-rose-600 font-medium">Hapus</span>
                  <input 
                    type="checkbox" 
                    name="delete_attachments[]" 
                    value="{{ $att->id }}"
                    class="w-4 h-4 text-rose-600 rounded border-slate-300 focus:ring-rose-500"
                  >
                </div>
              </label>
            @endforeach
          </div>
        </div>
      @endif

      {{-- ================= UPLOAD NEW ATTACHMENTS ================= --}}
      <div 
        x-data="{
          files: [],
          handleFiles(event) {
            const selected = Array.from(event.target.files);
            this.files = selected.map(file => ({
              name: file.name,
              size: (file.size / 1024).toFixed(1) + ' KB',
              isImage: file.type.startsWith('image/'),
              url: file.type.startsWith('image/') ? URL.createObjectURL(file) : null
            }));
          }
        }" 
        class="space-y-2 pt-2 border-t border-slate-100"
      >
        <label class="block text-xs font-semibold text-slate-700">
          Tambah Lampiran / Foto Baru
        </label>
        <div class="relative border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-2xl p-4 text-center transition bg-slate-50/60 group">
          <input 
            type="file" 
            name="attachments[]" 
            id="attachments" 
            multiple 
            accept="image/*,.pdf,.doc,.docx"
            @change="handleFiles($event)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
          >
          <div class="flex flex-col items-center pointer-events-none">
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
              </svg>
            </div>
            <span class="text-xs font-semibold text-slate-700">Pilih foto atau dokumen tambahan</span>
            <span class="text-[11px] text-slate-400 mt-0.5">JPG, PNG, PDF maks 5MB per berkas</span>
          </div>
        </div>

        {{-- Preview List --}}
        <div x-show="files.length > 0" x-cloak class="mt-2.5">
          <div class="text-[11px] font-semibold text-slate-600 mb-1.5 flex items-center justify-between">
            <span>Berkas baru yang akan diunggah:</span>
            <span class="text-emerald-600" x-text="files.length + ' berkas'"></span>
          </div>
          <div class="grid grid-cols-3 gap-2">
            <template x-for="(file, index) in files" :key="index">
              <div class="relative rounded-xl border border-slate-200 bg-white p-1.5 text-center shadow-xs overflow-hidden">
                <template x-if="file.isImage">
                  <img :src="file.url" class="w-full h-16 object-cover rounded-lg mb-1">
                </template>
                <template x-if="!file.isImage">
                  <div class="w-full h-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 mb-1">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                  </div>
                </template>
                <div class="text-[10px] font-medium text-slate-700 truncate" x-text="file.name"></div>
                <div class="text-[9px] text-slate-400" x-text="file.size"></div>
              </div>
            </template>
          </div>
        </div>
      </div>

      {{-- Action Buttons --}}
      <div class="pt-4 border-t border-slate-100 space-y-2">
        <button 
          type="submit" 
          class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-md shadow-emerald-700/20 active:scale-[0.99] transition flex items-center justify-center gap-2"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"></polyline>
          </svg>
          Simpan & Kirim Perbaikan
        </button>
        <a 
          href="{{ route('esdm.desa.report.show', $report) }}"
          class="block w-full py-2.5 text-center text-xs font-semibold text-slate-500 hover:text-slate-700 transition"
        >
          Batalkan & Kembali
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
