@extends('layouts.desa')

@section('title', 'Detail Laporan ESDM')

@section('content')
@php
  // Labels map
  $typeLabel = $report->type_label ?? (\App\Models\EsdmReport::typeLabels()[$report->type] ?? ucfirst(str_replace(['_', '-'], ' ', $report->type)));
  
  $statusKey = $report->status ?? 'baru';
  $statusClasses = match($statusKey) {
    'baru' => 'bg-blue-50 text-blue-700 border-blue-200',
    'verifikasi' => 'bg-amber-50 text-amber-700 border-amber-200',
    'perbaikan' => 'bg-rose-50 text-rose-700 border-rose-300 font-semibold',
    'tindak_lanjut' => 'bg-orange-50 text-orange-700 border-orange-200',
    'dalam_proses' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
    'selesai' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
    default => 'bg-slate-100 text-slate-700 border-slate-200',
  };

  $statusText = match($statusKey) {
    'baru' => 'Baru Diajukan',
    'verifikasi' => 'Sedang Diverifikasi',
    'perbaikan' => 'Perlu Perbaikan',
    'tindak_lanjut' => 'Tindak Lanjut Dinas',
    'dalam_proses' => 'Sedang Dikerjakan',
    'selesai' => 'Selesai / Tuntas',
    default => ucfirst($statusKey),
  };

  $typeIcon = match($report->type) {
    'pju' => '💡',
    'bpbl' => '🏠',
    'jaringan_listrik', 'jaringan-listrik' => '⚡',
    'kebutuhan_energi', 'kebutuhan-energi' => '🔋',
    default => '⚠️',
  };

  // Human readable labels for data fields
  $fieldLabels = [
    'jumlah_titik_pju' => 'Jumlah Titik PJU Eksisting',
    'kondisi' => 'Kondisi PJU Saat Ini',
    'jumlah_rusak' => 'Jumlah Titik Rusak / Mati',
    'kebutuhan_penambahan' => 'Kebutuhan Titik Baru',
    'jumlah_rumah_tangga' => 'Jumlah Rumah Tangga (KK)',
    'status_kebutuhan' => 'Status Kebutuhan',
    'kondisi_jaringan' => 'Kondisi Jaringan Saat Ini',
    'status_jangkauan' => 'Status Jangkauan Jaringan',
    'permasalahan_jaringan' => 'Permasalahan Jaringan',
    'kebutuhan_perluasan' => 'Kebutuhan Perluasan / Tiang & Kabel',
    'jenis_kebutuhan' => 'Jenis Kebutuhan Energi',
    'jumlah_kk' => 'Jumlah KK Sasaran',
    'kondisi_lapangan' => 'Kondisi Lapangan',
    'usulan_penanganan' => 'Usulan / Solusi Penanganan',
    'jenis_permasalahan' => 'Jenis Permasalahan',
    'uraian_masalah' => 'Uraian Masalah',
    'fakta_lapangan' => 'Fakta Lapangan',
    'dampak_masyarakat' => 'Dampak Terhadap Masyarakat',
    'usulan_penyelesaian' => 'Usulan Penyelesaian Desa',
  ];

  // Latest perbaikan history note if any
  $latestPerbaikan = $report->histories ? $report->histories->where('to_status', 'perbaikan')->first() : null;
@endphp

<div class="space-y-4">
  {{-- Header & Back Navigation --}}
  <div class="flex items-center justify-between">
    <div class="flex items-center gap-3">
      <a 
        href="{{ route('esdm.desa.dashboard') }}"
        class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-emerald-700 hover:border-emerald-300 transition active:scale-95 shadow-xs"
        title="Kembali ke Dashboard"
      >
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="19" y1="12" x2="5" y2="12"></line>
          <polyline points="12 19 5 12 12 5"></polyline>
        </svg>
      </a>
      <div>
        <h1 class="text-base font-bold text-slate-800 leading-tight">Detail Laporan ESDM</h1>
        <p class="text-[11px] text-slate-500">ID Laporan: #{{ $report->id }}</p>
      </div>
    </div>

    @if ($report->status === 'perbaikan')
      <a 
        href="{{ route('esdm.desa.report.edit', $report) }}"
        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition active:scale-95"
      >
        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
        Perbaiki
      </a>
    @endif
  </div>

  {{-- PERINGATAN STATUS PERBAIKAN --}}
  @if ($report->status === 'perbaikan')
    <div class="p-4 rounded-2xl bg-rose-50 border-2 border-rose-300 text-rose-900 shadow-sm animate-pulse">
      <div class="flex items-start gap-3">
        <div class="w-9 h-9 rounded-xl bg-rose-600 text-white flex items-center justify-center shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        </div>
        <div class="flex-1">
          <h3 class="font-bold text-sm text-rose-800">Laporan Memerlukan Perbaikan Data</h3>
          <p class="text-xs text-rose-700 mt-0.5">
            Admin ESDM telah memeriksa laporan ini dan meminta kelengkapan data atau perbaikan informasi.
          </p>

          @if ($latestPerbaikan && !empty($latestPerbaikan->catatan))
            <div class="mt-2.5 p-2.5 rounded-xl bg-white/80 border border-rose-200 text-xs text-rose-900 font-medium">
              <span class="font-bold text-rose-700 block mb-0.5">Catatan Verifikator:</span>
              "{{ $latestPerbaikan->catatan }}"
            </div>
          @endif

          <div class="mt-3">
            <a 
              href="{{ route('esdm.desa.report.edit', $report) }}"
              class="w-full inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold shadow-xs transition"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
              Perbaiki Laporan Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  @endif

  {{-- CARD RINGKASAN UTAMA --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs space-y-4">
    {{-- Header Info --}}
    <div class="flex items-start justify-between gap-3 pb-3 border-b border-slate-100">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl shadow-xs">
          {{ $typeIcon }}
        </div>
        <div>
          <span class="text-[11px] font-semibold uppercase tracking-wider text-slate-400">Kategori Laporan</span>
          <h2 class="font-bold text-slate-800 text-base leading-tight">{{ $typeLabel }}</h2>
        </div>
      </div>

      <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClasses }} shrink-0">
        {{ $statusText }}
      </span>
    </div>

    {{-- Meta Grid --}}
    <div class="grid grid-cols-2 gap-3 text-xs">
      <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100">
        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Tanggal Diajukan</span>
        <span class="font-semibold text-slate-700 mt-0.5 block">
          {{ $report->created_at ? $report->created_at->translatedFormat('d F Y, H:i') : '-' }}
        </span>
      </div>

      <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100">
        <span class="text-slate-400 block text-[10px] uppercase font-bold tracking-wider">Desa Pelapor</span>
        <span class="font-semibold text-slate-700 mt-0.5 block truncate">
          {{ $report->village->nama ?? (Auth::user()->village->nama ?? 'Desa') }}
        </span>
      </div>

      @if (!empty($report->tingkat_urgensi))
        <div class="col-span-2 p-3 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
          <span class="text-slate-400 text-[10px] uppercase font-bold tracking-wider">Tingkat Urgensi</span>
          <span class="font-bold text-xs capitalize {{ $report->tingkat_urgensi === 'tinggi' ? 'text-rose-600' : ($report->tingkat_urgensi === 'sedang' ? 'text-amber-600' : 'text-emerald-600') }}">
            {{ $report->urgensi_label ?? ucfirst($report->tingkat_urgensi) }}
          </span>
        </div>
      @endif
    </div>

    {{-- Lokasi & Keterangan --}}
    <div class="space-y-3 pt-1">
      <div>
        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
          Titik Lokasi
        </label>
        <div class="p-3 rounded-2xl bg-slate-50 border border-slate-100 text-xs font-semibold text-slate-800 flex items-start gap-2">
          <svg class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
            <circle cx="12" cy="10" r="3"></circle>
          </svg>
          <span>{{ $report->lokasi ?? '-' }}</span>
        </div>
      </div>

      <div>
        <label class="block text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-1">
          Keterangan / Uraian Masalah
        </label>
        <div class="p-3.5 rounded-2xl bg-slate-50 border border-slate-100 text-xs text-slate-700 leading-relaxed whitespace-pre-line">
          {{ $report->keterangan ?? '-' }}
        </div>
      </div>
    </div>
  </div>

  {{-- DETAIL DATA KHUSUS FORMULIR (DATA[]) --}}
  @if (!empty($report->data) && is_array($report->data))
    <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs space-y-3">
      <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
        <div class="w-7 h-7 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-sm">
          📋
        </div>
        <h3 class="font-bold text-slate-800 text-sm">Data Spesifik Laporan</h3>
      </div>

      <div class="space-y-2.5">
        @foreach ($report->data as $key => $val)
          @php
            $displayLabel = $fieldLabels[$key] ?? ucwords(str_replace('_', ' ', $key));
          @endphp
          <div class="p-3 rounded-2xl bg-slate-50/80 border border-slate-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1 text-xs">
            <span class="text-slate-500 font-medium">{{ $displayLabel }}:</span>
            <span class="font-bold text-slate-800 break-words sm:text-right">
              @if (is_array($val))
                {{ implode(', ', $val) }}
              @elseif (is_bool($val))
                {{ $val ? 'Ya' : 'Tidak' }}
              @else
                {{ $val ?: '-' }}
              @endif
            </span>
          </div>
        @endforeach
      </div>
    </div>
  @endif

  {{-- ATTACHMENTS GALLERY --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs space-y-3">
    <div class="flex items-center justify-between pb-2 border-b border-slate-100">
      <div class="flex items-center gap-2">
        <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-sm">
          📎
        </div>
        <h3 class="font-bold text-slate-800 text-sm">Lampiran & Dokumentasi</h3>
      </div>
      <span class="text-xs text-slate-400 font-medium">
        {{ $report->attachments ? $report->attachments->count() : 0 }} Berkas
      </span>
    </div>

    @if ($report->attachments && $report->attachments->count() > 0)
      <div class="grid grid-cols-2 gap-2.5">
        @foreach ($report->attachments as $attachment)
          @php
            $filePath = $attachment->file_path;
            $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'webp', 'gif']) || Str::startsWith($attachment->file_type ?? '', 'image');
            $fileUrl = $attachment->file_url;
          @endphp

          @if ($isImage)
            <div class="group relative rounded-2xl border border-slate-200 overflow-hidden bg-slate-100 shadow-xs">
              <a href="{{ $fileUrl }}" target="_blank" class="block aspect-square overflow-hidden">
                <img 
                  src="{{ $fileUrl }}" 
                  alt="{{ $attachment->original_name ?? 'Dokumentasi' }}" 
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                  onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'><rect fill=\'%23e2e8f0\' width=\'100\' height=\'100\'/><text fill=\'%2364748b\' font-size=\'12\' x=\'50%\' y=\'50%\' dominant-baseline=\'middle\' text-anchor=\'middle\'>Foto Rusak</text></svg>'"
                >
              </a>
              <div class="p-2 bg-white/95 border-t border-slate-100 flex items-center justify-between">
                <span class="text-[10px] text-slate-600 truncate max-w-[100px]">{{ $attachment->original_name ?? 'Foto Lampiran' }}</span>
                <a href="{{ $fileUrl }}" target="_blank" class="text-emerald-600 hover:text-emerald-800" title="Buka gambar">
                  <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                </a>
              </div>
            </div>
          @else
            <div class="col-span-2 p-3 rounded-2xl border border-slate-200 bg-slate-50 flex items-center justify-between gap-3">
              <div class="flex items-center gap-2.5 min-w-0">
                <div class="w-9 h-9 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                  <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <div class="min-w-0">
                  <div class="text-xs font-semibold text-slate-800 truncate">{{ $attachment->original_name ?? 'Dokumen Pendukung' }}</div>
                  <div class="text-[10px] text-slate-400 uppercase font-mono">{{ $extension ?: 'FILE' }}</div>
                </div>
              </div>
              <a 
                href="{{ $fileUrl }}" 
                target="_blank" 
                download
                class="px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:border-emerald-300 text-emerald-700 text-xs font-medium shrink-0 flex items-center gap-1 transition"
              >
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Unduh
              </a>
            </div>
          @endif
        @endforeach
      </div>
    @else
      <p class="text-xs text-slate-400 py-2 text-center">Tidak ada lampiran berkas atau foto pada laporan ini.</p>
    @endif
  </div>

  {{-- TIMELINE RIWAYAT STATUS --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs space-y-4">
    <div class="flex items-center gap-2 pb-2 border-b border-slate-100">
      <div class="w-7 h-7 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center text-sm">
        🕒
      </div>
      <h3 class="font-bold text-slate-800 text-sm">Riwayat & Progres Penanganan</h3>
    </div>

    @if ($report->histories && $report->histories->count() > 0)
      <div class="relative pl-6 space-y-5 before:absolute before:left-2.5 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
        @foreach ($report->histories as $history)
          @php
            $histStatus = $history->to_status;
            $dotColor = match($histStatus) {
              'baru' => 'bg-blue-500 ring-blue-100',
              'verifikasi' => 'bg-amber-500 ring-amber-100',
              'perbaikan' => 'bg-rose-500 ring-rose-100',
              'tindak_lanjut' => 'bg-orange-500 ring-orange-100',
              'dalam_proses' => 'bg-indigo-500 ring-indigo-100',
              'selesai' => 'bg-emerald-500 ring-emerald-100',
              default => 'bg-slate-400 ring-slate-100',
            };
            $histLabel = match($histStatus) {
              'baru' => 'Laporan Diajukan',
              'verifikasi' => 'Sedang Diverifikasi',
              'perbaikan' => 'Diminta Perbaikan',
              'tindak_lanjut' => 'Tindak Lanjut Dinas / Instansi',
              'dalam_proses' => 'Sedang Dikerjakan',
              'selesai' => 'Laporan Selesai',
              default => ucfirst($histStatus),
            };
          @endphp

          <div class="relative">
            {{-- Dot icon --}}
            <div class="absolute -left-6 top-1 w-3.5 h-3.5 rounded-full {{ $dotColor }} ring-4"></div>

            <div class="bg-slate-50 rounded-2xl p-3 border border-slate-100 text-xs space-y-1">
              <div class="flex items-center justify-between">
                <span class="font-bold text-slate-800">{{ $histLabel }}</span>
                <span class="text-[10px] text-slate-400">
                  {{ $history->created_at ? $history->created_at->translatedFormat('d M Y, H:i') : '-' }}
                </span>
              </div>

              @if ($history->user)
                <div class="text-[11px] text-slate-500">
                  Oleh: <span class="font-semibold text-slate-700">{{ $history->user->name }}</span>
                </div>
              @endif

              @if (!empty($history->catatan))
                <div class="mt-1.5 p-2 rounded-xl bg-white border border-slate-200/80 text-slate-700">
                  <span class="font-semibold text-slate-600 block text-[10px] uppercase">Catatan:</span>
                  {{ $history->catatan }}
                </div>
              @endif

              @if (!empty($history->instansi_koordinasi))
                <div class="text-[11px] text-slate-600 pt-1">
                  <span class="text-slate-400">Koordinasi:</span> {{ $history->instansi_koordinasi }}
                </div>
              @endif

              @if (!empty($history->hasil_koordinasi))
                <div class="text-[11px] text-slate-600">
                  <span class="text-slate-400">Hasil:</span> {{ $history->hasil_koordinasi }}
                </div>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-4 text-xs text-slate-400">
        Belum ada riwayat perubahan status pada laporan ini.
      </div>
    @endif
  </div>

  {{-- Tombol Tindakan Bawah --}}
  <div class="pt-2">
    <a 
      href="{{ route('esdm.desa.dashboard') }}"
      class="w-full py-3 px-4 rounded-2xl bg-white border border-slate-200 text-slate-700 font-semibold text-xs text-center block hover:bg-slate-50 transition shadow-xs"
    >
      ← Kembali ke Beranda Dashboard
    </a>
  </div>
</div>
@endsection
