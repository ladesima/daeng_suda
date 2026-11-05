@extends('layouts.admin')

@section('title', 'Detail Laporan ESDM #' . $report->id)
@section('pageTitle', 'Detail Laporan ESDM')
@section('pageSub', 'Informasi lengkap dan pemantauan tindak lanjut laporan sektor ESDM')

@section('content')
@php
  $statusConfig = [
      'baru' => [
          'label' => 'Baru',
          'class' => 'bg-blue-50 text-blue-700 border-blue-200 ring-1 ring-blue-600/10',
          'dot' => 'bg-blue-500'
      ],
      'verifikasi' => [
          'label' => 'Verifikasi',
          'class' => 'bg-amber-50 text-amber-700 border-amber-200 ring-1 ring-amber-600/10',
          'dot' => 'bg-amber-500'
      ],
      'perbaikan' => [
          'label' => 'Perbaikan',
          'class' => 'bg-rose-50 text-rose-700 border-rose-200 ring-1 ring-rose-600/10',
          'dot' => 'bg-rose-500'
      ],
      'tindak_lanjut' => [
          'label' => 'Tindak Lanjut',
          'class' => 'bg-orange-50 text-orange-700 border-orange-200 ring-1 ring-orange-600/10',
          'dot' => 'bg-orange-500'
      ],
      'dalam_proses' => [
          'label' => 'Dalam Proses',
          'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200 ring-1 ring-indigo-600/10',
          'dot' => 'bg-indigo-500'
      ],
      'selesai' => [
          'label' => 'Selesai',
          'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200 ring-1 ring-emerald-600/10',
          'dot' => 'bg-emerald-500'
      ],
  ];

  $urgensiConfig = [
      'tinggi' => [
          'label' => 'Mendesak / Tinggi',
          'class' => 'bg-rose-50 text-rose-700 border-rose-200'
      ],
      'sedang' => [
          'label' => 'Sedang',
          'class' => 'bg-amber-50 text-amber-700 border-amber-200'
      ],
      'rendah' => [
          'label' => 'Rendah',
          'class' => 'bg-slate-100 text-slate-700 border-slate-200'
      ],
  ];

  $typeLabelsMap = [
      'pju' => 'Penerangan Jalan Umum (PJU)',
      'bpbl' => 'Bantuan Pasang Baru Listrik (BPBL)',
      'jaringan_listrik' => 'Jaringan Listrik',
      'kebutuhan_energi' => 'Kebutuhan Energi Masyarakat',
      'permasalahan_lainnya' => 'Permasalahan ESDM Lainnya',
  ];

  $fieldLabels = [
      'jumlah_titik' => 'Jumlah Titik Lampu',
      'kondisi_lampu' => 'Kondisi Fisik / Kerusakan',
      'jenis_lampu' => 'Jenis Lampu',
      'daya_lampu' => 'Daya Lampu (Watt)',
      'tinggi_tiang' => 'Tinggi Tiang',
      'titik_koordinat' => 'Titik Koordinat (GPS)',
      'koordinat' => 'Titik Koordinat',
      'latitude' => 'Garis Lintang (Latitude)',
      'longitude' => 'Garis Bujur (Longitude)',
      'nama_calon_pelanggan' => 'Nama Calon Penerima',
      'nama_penerima' => 'Nama Penerima Manfaat',
      'nik' => 'Nomor Induk Kependudukan (NIK)',
      'no_kk' => 'Nomor Kartu Keluarga (KK)',
      'alamat_lengkap' => 'Alamat Lengkap',
      'daya_yang_dibutuhkan' => 'Kapasitas Daya Dibutuhkan',
      'daya_listrik' => 'Daya Listrik (VA)',
      'status_dtks' => 'Terdaftar di DTKS Kemensos',
      'status_ekonomi' => 'Kondisi Ekonomi',
      'penyebab' => 'Penyebab Kendala / Kerusakan',
      'panjang_jaringan' => 'Estimasi Kebutuhan Jaringan Listrik',
      'jarak_tiang_terdekat' => 'Jarak ke Tiang Listrik Terdekat',
      'jumlah_kk_terdampak' => 'Jumlah KK Terdampak',
      'jumlah_rumah' => 'Jumlah Rumah Terkoneksi',
      'potensi_energi' => 'Potensi Energi Alternatif',
      'kebutuhan_spesifik' => 'Kebutuhan Energi Spesifik',
      'deskripsi_masalah' => 'Rincian Masalah Lapangan',
      'dampak' => 'Dampak terhadap Warga',
      'usulan_solusi' => 'Usulan Solusi Desa',
      'kontak_desa' => 'Kontak Perangkat Desa',
      'no_hp' => 'Nomor Telepon / WhatsApp',
  ];

  $currentStatus = $report->status ?? 'baru';
  $statusCfg = $statusConfig[$currentStatus] ?? [
      'label' => ucfirst(str_replace('_', ' ', $currentStatus)),
      'class' => 'bg-slate-100 text-slate-700 border-slate-200',
      'dot' => 'bg-slate-500'
  ];

  $urgensiKey = strtolower($report->tingkat_urgensi ?? '');
  $urgensiCfg = $urgensiConfig[$urgensiKey] ?? null;

  $typeName = $typeLabelsMap[$report->type] ?? $report->type_label ?? ucfirst(str_replace('_', ' ', $report->type ?? '-'));
@endphp

<div class="space-y-6">

  {{-- Back Button & Header Navigation --}}
  <div class="flex items-center justify-between">
    <a href="{{ route('esdm.admin.report.index') }}" 
       class="inline-flex items-center gap-2 text-xs font-semibold text-slate-600 hover:text-slate-900 bg-white border border-slate-200 px-3.5 py-2 rounded-xl shadow-xs hover:bg-slate-50 transition-colors">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
      </svg>
      <span>Kembali ke Daftar Laporan</span>
    </a>

    <div class="flex items-center gap-2">
      <span class="text-xs text-slate-500">ID Laporan:</span>
      <span class="font-mono text-xs font-bold text-slate-800 bg-slate-100 px-2 py-1 rounded-md">#{{ $report->id }}</span>
    </div>
  </div>

  {{-- Two Column Layout: Left (2/3) & Right (1/3) --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
    
    {{-- ======================================================== --}}
    {{-- LEFT COLUMN (2/3): Report Details, Data, Attachments    --}}
    {{-- ======================================================== --}}
    <div class="lg:col-span-2 space-y-6">
      
      {{-- Card 1: Report Info Card --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex flex-wrap items-center justify-between gap-3 pb-5 border-b border-slate-100">
          <div>
            <span class="text-xs font-semibold uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200/60 inline-block mb-1">
              {{ $typeName }}
            </span>
            <h2 class="text-lg font-bold text-slate-800 mt-1">Laporan Sektor ESDM Desa {{ $report->village->nama ?? '-' }}</h2>
          </div>

          <div class="flex items-center gap-2">
            {{-- Urgensi Badge --}}
            @if($urgensiCfg)
              <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $urgensiCfg['class'] }}">
                {{ $urgensiCfg['label'] }}
              </span>
            @endif

            {{-- Status Badge --}}
            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border {{ $statusCfg['class'] }}">
              <span class="w-2 h-2 rounded-full mr-1.5 {{ $statusCfg['dot'] }}"></span>
              {{ $statusCfg['label'] }}
            </span>
          </div>
        </div>

        {{-- Meta Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-5 text-sm">
          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 grid place-content-center shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
              </svg>
            </div>
            <div>
              <div class="text-xs text-slate-500 font-medium">Desa / Kelurahan</div>
              <div class="font-semibold text-slate-800">{{ $report->village->nama ?? '-' }}</div>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 grid place-content-center shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
              </svg>
            </div>
            <div>
              <div class="text-xs text-slate-500 font-medium">Kecamatan</div>
              <div class="font-semibold text-slate-800">{{ $report->village->kecamatan ?? '-' }}</div>
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 grid place-content-center shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
              </svg>
            </div>
            <div>
              <div class="text-xs text-slate-500 font-medium">Pelapor (Petugas Desa)</div>
              <div class="font-semibold text-slate-800">{{ $report->user->name ?? $report->pelapor->name ?? '-' }}</div>
              @if(!empty($report->user->email))
                <div class="text-xs text-slate-400">{{ $report->user->email }}</div>
              @endif
            </div>
          </div>

          <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-slate-100 text-slate-600 grid place-content-center shrink-0">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
              </svg>
            </div>
            <div>
              <div class="text-xs text-slate-500 font-medium">Waktu Pelaporan</div>
              <div class="font-semibold text-slate-800">{{ $report->created_at ? $report->created_at->format('d/m/Y H:i') : '-' }}</div>
              <div class="text-xs text-slate-400">{{ $report->created_at ? $report->created_at->diffForHumans() : '' }}</div>
            </div>
          </div>
        </div>

        {{-- Lokasi Details --}}
        <div class="mt-5 pt-4 border-t border-slate-100 flex items-start gap-3">
          <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-700 grid place-content-center shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
          </div>
          <div>
            <div class="text-xs text-slate-500 font-medium">Lokasi / Titik Lapangan</div>
            <div class="text-sm text-slate-800 font-medium mt-0.5">{{ $report->lokasi ?? 'Lokasi tidak dispesifikasikan.' }}</div>
          </div>
        </div>
      </div>

      {{-- Card 2: Detail Data Card --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-2 mb-4 pb-3 border-b border-slate-100">
          <div class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 grid place-content-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <h3 class="font-bold text-slate-800 text-base">Rincian Teknis Data Laporan</h3>
        </div>

        @if(!empty($report->data) && is_array($report->data) && count($report->data) > 0)
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach($report->data as $key => $value)
              @php
                $label = $fieldLabels[$key] ?? ucwords(str_replace(['_', '-'], ' ', $key));
              @endphp
              <div class="bg-slate-50/70 border border-slate-100 rounded-xl p-3.5">
                <span class="text-xs font-semibold uppercase tracking-wider text-slate-500 block mb-1">
                  {{ $label }}
                </span>
                <div class="text-sm font-medium text-slate-900 break-words">
                  @if(is_array($value))
                    <ul class="list-disc list-inside space-y-0.5 text-xs text-slate-700">
                      @foreach($value as $subKey => $subVal)
                        <li>
                          @if(!is_numeric($subKey))
                            <span class="font-semibold">{{ ucwords(str_replace('_', ' ', $subKey)) }}:</span>
                          @endif
                          {{ is_array($subVal) ? json_encode($subVal) : $subVal }}
                        </li>
                      @endforeach
                    </ul>
                  @elseif(is_bool($value))
                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-semibold {{ $value ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-200 text-slate-700' }}">
                      {{ $value ? 'Ya' : 'Tidak' }}
                    </span>
                  @elseif(is_null($value) || $value === '')
                    <span class="text-slate-400 italic text-xs">-</span>
                  @else
                    {{ $value }}
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-6 text-slate-400 text-sm bg-slate-50 rounded-xl">
            Tidak ada rincian data parameter tambahan yang tercatat.
          </div>
        @endif
      </div>

      {{-- Card 3: Keterangan Card --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center gap-2 mb-3 pb-3 border-b border-slate-100">
          <div class="w-7 h-7 rounded-lg bg-amber-50 text-amber-600 grid place-content-center">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
            </svg>
          </div>
          <h3 class="font-bold text-slate-800 text-base">Keterangan / Narasi Laporan</h3>
        </div>
        <div class="prose prose-sm max-w-none text-slate-700 leading-relaxed bg-slate-50/50 p-4 rounded-xl border border-slate-100">
          {!! nl2br(e($report->keterangan ?? 'Tidak ada keterangan tambahan.')) !!}
        </div>
      </div>

      {{-- Card 4: Lampiran Card --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4 pb-3 border-b border-slate-100">
          <div class="flex items-center gap-2">
            <div class="w-7 h-7 rounded-lg bg-teal-50 text-teal-600 grid place-content-center">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
              </svg>
            </div>
            <h3 class="font-bold text-slate-800 text-base">Berkas Lampiran & Foto Dokumentasi</h3>
          </div>
          <span class="text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full font-medium">
            {{ $report->attachments ? $report->attachments->count() : 0 }} Berkas
          </span>
        </div>

        @if($report->attachments && $report->attachments->count() > 0)
          <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
            @foreach($report->attachments as $attachment)
              @php
                $isImage = in_array(strtolower($attachment->file_type ?? ''), ['image', 'img', 'jpg', 'jpeg', 'png', 'webp', 'gif']) 
                           || preg_match('/\.(jpg|jpeg|png|webp|gif)$/i', $attachment->file_path ?? '');
                $fileUrl = $attachment->file_url;
              @endphp

              <div class="group border border-slate-200 rounded-xl overflow-hidden hover:shadow-md transition-all flex flex-col bg-slate-50/50">
                @if($isImage)
                  <a href="{{ $fileUrl }}" target="_blank" class="block aspect-video bg-slate-100 overflow-hidden relative">
                    <img src="{{ $fileUrl }}" 
                         alt="{{ $attachment->original_name ?? 'Foto Lampiran' }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200"
                         onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\'w-full h-full flex items-center justify-center text-xs text-slate-400 bg-slate-100\'>Foto Tidak Tersedia</div>'">
                    <div class="absolute inset-0 bg-slate-900/30 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                      <span class="text-xs font-semibold text-white bg-slate-900/70 px-2 py-1 rounded">Lihat Foto</span>
                    </div>
                  </a>
                @else
                  <div class="aspect-video bg-slate-100 flex items-center justify-center text-slate-400">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                  </div>
                @endif

                <div class="p-2.5 flex-1 flex flex-col justify-between">
                  <div class="text-xs font-medium text-slate-800 truncate" title="{{ $attachment->original_name }}">
                    {{ $attachment->original_name ?? 'Lampiran' }}
                  </div>
                  <a href="{{ $fileUrl }}" 
                     target="_blank" 
                     download
                     class="mt-2 text-center text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 py-1 px-2 rounded-lg transition-colors inline-block">
                    Unduh Berkas
                  </a>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-8 text-slate-400 text-sm bg-slate-50 rounded-xl">
            Tidak ada dokumen atau foto dokumentasi yang dilampirkan.
          </div>
        @endif
      </div>

    </div>

    {{-- ======================================================== --}}
    {{-- RIGHT COLUMN (1/3): Action Card & Riwayat / Timeline      --}}
    {{-- ======================================================== --}}
    <div class="space-y-6">

      {{-- ACTION CARD (Conditional on Status) --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <h3 class="font-bold text-slate-800 text-base mb-4 pb-2 border-b border-slate-100 flex items-center gap-2">
          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
          </svg>
          Aksi & Verifikasi
        </h3>

        {{-- Case 1: Status = BARU (Verification Form) --}}
        @if($report->status === 'baru')
          <form method="POST" action="{{ route('esdm.admin.report.verify', $report) }}" class="space-y-4">
            @csrf
            
            <div class="bg-blue-50/70 border border-blue-200 rounded-xl p-3.5 text-xs text-blue-900 leading-relaxed">
              Laporan baru memerlukan penelaahan verifikasi awal dari Tim Admin SDA Kabupaten.
            </div>

            <div>
              <label class="block text-xs font-semibold text-slate-700 mb-2">Keputusan Verifikasi <span class="text-rose-500">*</span></label>
              <div class="space-y-2">
                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 hover:border-emerald-500 cursor-pointer transition-colors bg-white hover:bg-emerald-50/20">
                  <input type="radio" name="status" value="verifikasi" required class="text-emerald-600 focus:ring-emerald-500">
                  <div>
                    <span class="text-xs font-bold text-emerald-800 block">Terima (Terverifikasi)</span>
                    <span class="text-xs text-slate-500">Laporan valid dan siap dilanjutkan ke tahapan koordinasi</span>
                  </div>
                </label>

                <label class="flex items-center gap-2.5 p-3 rounded-xl border border-slate-200 hover:border-rose-500 cursor-pointer transition-colors bg-white hover:bg-rose-50/20">
                  <input type="radio" name="status" value="perbaikan" required class="text-rose-600 focus:ring-rose-500">
                  <div>
                    <span class="text-xs font-bold text-rose-800 block">Perlu Perbaikan</span>
                    <span class="text-xs text-slate-500">Data belum lengkap, kembalikan ke desa untuk direvisi</span>
                  </div>
                </label>
              </div>
            </div>

            <div>
              <label for="catatan_verifikasi" class="block text-xs font-semibold text-slate-700 mb-1">
                Catatan Verifikasi <span class="text-rose-500">*</span>
              </label>
              <textarea id="catatan_verifikasi" 
                        name="catatan" 
                        rows="3" 
                        required
                        placeholder="Tuliskan catatan arahan atau poin koreksi data..."
                        class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 py-2.5"></textarea>
            </div>

            <button type="submit" 
                    class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm transition-colors flex items-center justify-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
              </svg>
              Kirim Verifikasi Laporan
            </button>
          </form>

        {{-- Case 2: Status = VERIFIKASI / TINDAK_LANJUT / DALAM_PROSES (Status Update Form) --}}
        @elseif(in_array($report->status, ['verifikasi', 'tindak_lanjut', 'dalam_proses']))
          <form method="POST" action="{{ route('esdm.admin.report.status', $report) }}" class="space-y-4">
            @csrf

            <div>
              <label for="next_status" class="block text-xs font-semibold text-slate-700 mb-1">
                Perbarui ke Status <span class="text-rose-500">*</span>
              </label>
              <select id="next_status" 
                      name="status" 
                      required
                      class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 py-2.5">
                <option value="">-- Pilih Status Lanjutan --</option>
                
                @if($report->status === 'verifikasi')
                  <option value="tindak_lanjut">Tindak Lanjut (Koordinasi Eksternal)</option>
                  <option value="dalam_proses">Dalam Proses (Pengerjaan Lapangan)</option>
                  <option value="selesai">Selesai (Penanganan Tuntas)</option>
                @elseif($report->status === 'tindak_lanjut')
                  <option value="dalam_proses">Dalam Proses (Pengerjaan Lapangan)</option>
                  <option value="selesai">Selesai (Penanganan Tuntas)</option>
                @elseif($report->status === 'dalam_proses')
                  <option value="selesai">Selesai (Penanganan Tuntas)</option>
                @endif
              </select>
            </div>

            <div>
              <label for="instansi_koordinasi" class="block text-xs font-semibold text-slate-700 mb-1">
                Instansi Koordinasi
              </label>
              <input type="text" 
                     id="instansi_koordinasi" 
                     name="instansi_koordinasi" 
                     placeholder="Contoh: PT PLN (Persero) UP3 / Dinas ESDM Sulsel"
                     class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 py-2">
            </div>

            <div>
              <label for="hasil_koordinasi" class="block text-xs font-semibold text-slate-700 mb-1">
                Hasil Koordinasi
              </label>
              <textarea id="hasil_koordinasi" 
                        name="hasil_koordinasi" 
                        rows="2" 
                        placeholder="Ringkasan hasil rapat/koordinasi instansi terkait..."
                        class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 py-2"></textarea>
            </div>

            <div>
              <label for="catatan_progres" class="block text-xs font-semibold text-slate-700 mb-1">
                Catatan Progres
              </label>
              <textarea id="catatan_progres" 
                        name="catatan" 
                        rows="2" 
                        placeholder="Catatan perkembangan tahapan pekerjaan..."
                        class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 py-2"></textarea>
            </div>

            <button type="submit" 
                    class="w-full py-2.5 px-4 rounded-xl text-xs font-bold text-white bg-emerald-600 hover:bg-emerald-700 shadow-sm transition-colors flex items-center justify-center gap-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.03 8.03 0 01-15.357-2m15.357 2H15"/>
              </svg>
              Perbarui Status Laporan
            </button>
          </form>

        {{-- Case 3: Status = SELESAI --}}
        @elseif($report->status === 'selesai')
          <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 text-center">
            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 grid place-content-center mx-auto mb-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
              </svg>
            </div>
            <div class="text-sm font-bold text-emerald-900">Laporan Telah Selesai Ditangani</div>
            <p class="text-xs text-emerald-700 mt-1">Seluruh tahapan penanganan ESDM telah dituntaskan dan terdokumentasi.</p>
          </div>

        {{-- Case 4: Status = PERBAIKAN --}}
        @elseif($report->status === 'perbaikan')
          <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 text-center">
            <div class="w-12 h-12 rounded-full bg-amber-100 text-amber-600 grid place-content-center mx-auto mb-2">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
              </svg>
            </div>
            <div class="text-sm font-bold text-amber-900">Menunggu Perbaikan dari Desa</div>
            <p class="text-xs text-amber-700 mt-1">Laporan telah dikembalikan. Menunggu pembaruan kelengkapan berkas oleh pihak desa.</p>
          </div>
        @endif

      </div>

      {{-- RIWAYAT / TIMELINE CARD --}}
      <div class="bg-white border border-slate-200 rounded-2xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
          <h3 class="font-bold text-slate-800 text-base flex items-center gap-2">
            <svg class="w-5 h-5 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Riwayat Perkembangan
          </h3>
          <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full font-medium">
            {{ $report->histories ? $report->histories->count() : 0 }} Catatan
          </span>
        </div>

        @if($report->histories && $report->histories->count() > 0)
          <div class="relative pl-6 space-y-6 before:absolute before:left-2 before:top-2 before:bottom-2 before:w-0.5 before:bg-slate-200">
            @foreach($report->histories as $history)
              @php
                $toCfg = $statusConfig[$history->to_status] ?? [
                    'label' => ucfirst(str_replace('_', ' ', $history->to_status)),
                    'class' => 'bg-slate-100 text-slate-700 border-slate-200',
                    'dot' => 'bg-slate-400'
                ];
              @endphp

              <div class="relative">
                {{-- Timeline Dot --}}
                <div class="absolute -left-6 top-1.5 w-3 h-3 rounded-full border-2 border-white {{ $toCfg['dot'] }} ring-2 ring-slate-100"></div>

                <div class="bg-slate-50/80 border border-slate-100 rounded-xl p-3.5 space-y-2">
                  <div class="flex items-center justify-between gap-2">
                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold border {{ $toCfg['class'] }}">
                      {{ $toCfg['label'] }}
                    </span>
                    <span class="text-xs text-slate-400">
                      {{ $history->created_at ? $history->created_at->format('d/m/Y H:i') : '-' }}
                    </span>
                  </div>

                  <div class="text-xs text-slate-500 font-medium flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Oleh: {{ $history->user->name ?? 'Admin SDA' }}
                  </div>

                  @if(!empty($history->catatan))
                    <div class="text-xs text-slate-700 bg-white p-2.5 rounded-lg border border-slate-200/60">
                      <span class="font-semibold text-slate-800 block mb-0.5">Catatan:</span>
                      {{ $history->catatan }}
                    </div>
                  @endif

                  @if(!empty($history->instansi_koordinasi))
                    <div class="text-xs text-slate-600 bg-white p-2.5 rounded-lg border border-slate-200/60 space-y-1">
                      <div class="font-semibold text-slate-800 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                        Instansi: {{ $history->instansi_koordinasi }}
                      </div>
                      @if(!empty($history->hasil_koordinasi))
                        <div class="text-slate-700 pl-4 border-l-2 border-blue-200">
                          {{ $history->hasil_koordinasi }}
                        </div>
                      @endif
                    </div>
                  @endif
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-6 text-slate-400 text-xs bg-slate-50 rounded-xl">
            Belum ada riwayat aktivitas yang tercatat pada laporan ini.
          </div>
        @endif
      </div>

    </div>

  </div>

</div>
@endsection
