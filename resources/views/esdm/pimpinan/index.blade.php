@extends('layouts.admin')

@section('title', 'Daftar Laporan ESDM - Pimpinan')
@section('pageTitle', 'Pemantauan Laporan ESDM')
@section('pageSub', 'Monitoring dan pengawasan laporan sektor ESDM seluruh kecamatan')

@section('content')
@php
  $statusConfig = [
      'baru' => [
          'label' => 'Baru',
          'class' => 'bg-blue-50 text-blue-700 border-blue-200 ring-1 ring-blue-600/10'
      ],
      'verifikasi' => [
          'label' => 'Verifikasi',
          'class' => 'bg-amber-50 text-amber-700 border-amber-200 ring-1 ring-amber-600/10'
      ],
      'perbaikan' => [
          'label' => 'Perbaikan',
          'class' => 'bg-rose-50 text-rose-700 border-rose-200 ring-1 ring-rose-600/10'
      ],
      'tindak_lanjut' => [
          'label' => 'Tindak Lanjut',
          'class' => 'bg-orange-50 text-orange-700 border-orange-200 ring-1 ring-orange-600/10'
      ],
      'dalam_proses' => [
          'label' => 'Dalam Proses',
          'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200 ring-1 ring-indigo-600/10'
      ],
      'selesai' => [
          'label' => 'Selesai',
          'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200 ring-1 ring-emerald-600/10'
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
      'kebutuhan_energi' => 'Kebutuhan Energi',
      'permasalahan_lainnya' => 'Permasalahan Lainnya',
  ];

  $villagesData = collect($villages ?? [])->map(function($v) {
      return [
          'id' => is_array($v) ? $v['id'] : $v->id,
          'nama' => is_array($v) ? $v['nama'] : $v->nama,
          'kecamatan' => is_array($v) ? ($v['kecamatan'] ?? '') : ($v->kecamatan ?? ''),
      ];
  });

  $selectedKecamatan = request('kecamatan', '');
  $selectedDesaId = request('village_id', request('desa_id', ''));
  $selectedType = request('type', request('jenis', ''));
  $selectedStatus = request('status', '');
  $startDate = request('start_date', request('tanggal_mulai', ''));
  $endDate = request('end_date', request('tanggal_akhir', ''));
@endphp

<div class="space-y-6" 
     x-data="{
        filtersOpen: false,
        selectedKecamatan: '{{ $selectedKecamatan }}',
        selectedDesa: '{{ $selectedDesaId }}',
        allVillages: @js($villagesData),
        get filteredVillages() {
            if (!this.selectedKecamatan) {
                return this.allVillages;
            }
            return this.allVillages.filter(v => v.kecamatan && v.kecamatan.toLowerCase() === this.selectedKecamatan.toLowerCase());
        },
        onKecamatanChange() {
            if (this.selectedDesa && !this.filteredVillages.some(v => v.id == this.selectedDesa)) {
                this.selectedDesa = '';
            }
        }
     }">

  {{-- Top Action Bar: Search & Exports --}}
  <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
    <div class="flex items-center gap-3">
      <button type="button" 
              @click="filtersOpen = !filtersOpen"
              class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 shadow-sm transition-all">
        <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
        </svg>
        <span>Filter Pencarian</span>
        <span x-show="filtersOpen" class="text-xs bg-slate-100 text-slate-600 rounded-full px-2 py-0.5 ml-1">Tutup</span>
        <span x-show="!filtersOpen" class="text-xs bg-emerald-50 text-emerald-700 rounded-full px-2 py-0.5 ml-1">Buka</span>
      </button>

      @if(request()->hasAny(['kecamatan', 'village_id', 'desa_id', 'type', 'status', 'start_date', 'end_date']))
        <a href="{{ url()->current() }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-xs font-medium text-rose-700 bg-rose-50 hover:bg-rose-100 rounded-xl transition-colors border border-rose-200">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
          Reset Filter
        </a>
      @endif
    </div>

    {{-- Export Buttons --}}
    <div class="flex items-center gap-2">
      <a href="{{ Route::has('esdm.pimpinan.export.excel') ? route('esdm.pimpinan.export.excel', request()->query()) : (Route::has('esdm.admin.export.excel') ? route('esdm.admin.export.excel', request()->query()) : '#') }}"
         class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 text-xs font-semibold hover:bg-slate-50 shadow-sm transition-all"
         title="Export Data ke Excel">
        <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 24 24">
          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM6 20V4h7v5h5v11H6z"/>
          <path d="M8.5 12.5l1.8 2.5-1.8 2.5h1.4l1.1-1.6 1.1 1.6h1.4l-1.8-2.5 1.8-2.5h-1.4l-1.1 1.6-1.1-1.6H8.5z"/>
        </svg>
        <span>Export Excel</span>
      </a>

      <a href="{{ Route::has('esdm.pimpinan.export.pdf') ? route('esdm.pimpinan.export.pdf', request()->query()) : (Route::has('esdm.admin.export.pdf') ? route('esdm.admin.export.pdf', request()->query()) : '#') }}"
         target="_blank"
         class="inline-flex items-center gap-2 px-3.5 py-2.5 rounded-xl border border-rose-200 bg-rose-50 text-rose-700 text-xs font-semibold hover:bg-rose-100 shadow-sm transition-all"
         title="Export Ringkasan PDF">
        <svg class="w-4 h-4 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
        </svg>
        <span>Export PDF</span>
      </a>
    </div>
  </div>

  {{-- Filter Form Box --}}
  <div x-show="filtersOpen || window.innerWidth >= 1024" 
       x-transition:enter="transition ease-out duration-200"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm">
    <form method="GET" action="{{ url()->current() }}" class="space-y-4">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-3">
        
        {{-- Kecamatan Filter --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Kecamatan</label>
          <select name="kecamatan" 
                  x-model="selectedKecamatan" 
                  @change="onKecamatanChange()"
                  class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
            <option value="">-- Semua Kecamatan --</option>
            @foreach($kecamatans ?? [] as $kec)
              <option value="{{ $kec }}">{{ $kec }}</option>
            @endforeach
          </select>
        </div>

        {{-- Desa Filter --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Desa / Kelurahan</label>
          <select name="village_id" 
                  x-model="selectedDesa"
                  class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
            <option value="">-- Semua Desa --</option>
            <template x-for="v in filteredVillages" :key="v.id">
              <option :value="v.id" x-text="v.nama" :selected="v.id == selectedDesa"></option>
            </template>
          </select>
        </div>

        {{-- Jenis ESDM Filter --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Jenis ESDM</label>
          <select name="type" 
                  class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
            <option value="">-- Semua Jenis --</option>
            <option value="pju" {{ $selectedType === 'pju' ? 'selected' : '' }}>Penerangan Jalan (PJU)</option>
            <option value="bpbl" {{ $selectedType === 'bpbl' ? 'selected' : '' }}>Pasang Baru Listrik (BPBL)</option>
            <option value="jaringan_listrik" {{ $selectedType === 'jaringan_listrik' ? 'selected' : '' }}>Jaringan Listrik</option>
            <option value="kebutuhan_energi" {{ $selectedType === 'kebutuhan_energi' ? 'selected' : '' }}>Kebutuhan Energi</option>
            <option value="permasalahan_lainnya" {{ $selectedType === 'permasalahan_lainnya' ? 'selected' : '' }}>Permasalahan Lainnya</option>
          </select>
        </div>

        {{-- Status Filter --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Status Laporan</label>
          <select name="status" 
                  class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
            <option value="">-- Semua Status --</option>
            <option value="baru" {{ $selectedStatus === 'baru' ? 'selected' : '' }}>Baru</option>
            <option value="verifikasi" {{ $selectedStatus === 'verifikasi' ? 'selected' : '' }}>Verifikasi</option>
            <option value="perbaikan" {{ $selectedStatus === 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
            <option value="tindak_lanjut" {{ $selectedStatus === 'tindak_lanjut' ? 'selected' : '' }}>Tindak Lanjut</option>
            <option value="dalam_proses" {{ $selectedStatus === 'dalam_proses' ? 'selected' : '' }}>Dalam Proses</option>
            <option value="selesai" {{ $selectedStatus === 'selesai' ? 'selected' : '' }}>Selesai</option>
          </select>
        </div>

        {{-- Tanggal Mulai --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Mulai</label>
          <input type="date" 
                 name="start_date" 
                 value="{{ $startDate }}"
                 class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
        </div>

        {{-- Tanggal Akhir --}}
        <div>
          <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal Akhir</label>
          <input type="date" 
                 name="end_date" 
                 value="{{ $endDate }}"
                 class="w-full text-xs rounded-xl border-slate-300 focus:border-emerald-500 focus:ring-emerald-500 bg-slate-50/50 py-2">
        </div>

      </div>

      {{-- Action Buttons --}}
      <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
        <a href="{{ url()->current() }}" 
           class="px-4 py-2 text-xs font-medium text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
          Reset
        </a>
        <button type="submit" 
                class="px-5 py-2 text-xs font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl shadow-sm transition-colors flex items-center gap-1.5">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
          </svg>
          Terapkan Filter
        </button>
      </div>
    </form>
  </div>

  {{-- Results Table (Executive Read-only with View Links) --}}
  <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/90 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
            <th class="py-3.5 px-4 text-center w-12">No</th>
            <th class="py-3.5 px-4">Desa</th>
            <th class="py-3.5 px-4">Kecamatan</th>
            <th class="py-3.5 px-4">Jenis</th>
            <th class="py-3.5 px-4">Lokasi</th>
            <th class="py-3.5 px-4">Status</th>
            <th class="py-3.5 px-4">Urgensi</th>
            <th class="py-3.5 px-4">Tanggal</th>
            <th class="py-3.5 px-4 text-center w-24">Lihat</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
          @forelse($reports ?? [] as $report)
            @php
              $statusKey = $report->status ?? 'baru';
              $statusCfg = $statusConfig[$statusKey] ?? [
                  'label' => ucfirst(str_replace('_', ' ', $statusKey)),
                  'class' => 'bg-slate-100 text-slate-700 border-slate-200'
              ];

              $urgensiKey = strtolower($report->tingkat_urgensi ?? '');
              $urgensiCfg = $urgensiConfig[$urgensiKey] ?? [
                  'label' => $report->tingkat_urgensi ? ucfirst($report->tingkat_urgensi) : '-',
                  'class' => 'bg-slate-100 text-slate-600 border-slate-200'
              ];

              $typeName = $typeLabelsMap[$report->type] ?? $report->type_label ?? ucfirst(str_replace('_', ' ', $report->type ?? '-'));
              
              $rowNumber = method_exists($reports, 'firstItem') && $reports->firstItem() 
                  ? $reports->firstItem() + $loop->index 
                  : $loop->iteration;

              $detailUrl = Route::has('esdm.pimpinan.report.show') 
                  ? route('esdm.pimpinan.report.show', $report) 
                  : (Route::has('esdm.admin.report.show') ? route('esdm.admin.report.show', $report) : '#');
            @endphp
            <tr class="hover:bg-slate-50/80 transition-colors cursor-pointer group"
                onclick="window.location='{{ $detailUrl }}'">
              
              <td class="py-3.5 px-4 text-center text-xs text-slate-500 font-medium">
                {{ $rowNumber }}
              </td>

              <td class="py-3.5 px-4 font-semibold text-slate-900 whitespace-nowrap group-hover:text-emerald-700 transition-colors">
                {{ $report->village->nama ?? '-' }}
              </td>

              <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                {{ $report->village->kecamatan ?? '-' }}
              </td>

              <td class="py-3.5 px-4 text-slate-700 whitespace-nowrap">
                <span class="inline-block max-w-[180px] truncate" title="{{ $typeName }}">
                  {{ $typeName }}
                </span>
              </td>

              <td class="py-3.5 px-4 text-slate-600 max-w-[200px]">
                <span class="truncate block text-xs" title="{{ $report->lokasi ?? '-' }}">
                  {{ Str::limit($report->lokasi ?? '-', 35) }}
                </span>
              </td>

              <td class="py-3.5 px-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border {{ $statusCfg['class'] }}">
                  <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-current opacity-80"></span>
                  {{ $statusCfg['label'] }}
                </span>
              </td>

              <td class="py-3.5 px-4 whitespace-nowrap">
                @if(!empty($report->tingkat_urgensi))
                  <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium border {{ $urgensiCfg['class'] }}">
                    {{ $urgensiCfg['label'] }}
                  </span>
                @else
                  <span class="text-xs text-slate-400">-</span>
                @endif
              </td>

              <td class="py-3.5 px-4 text-slate-500 text-xs whitespace-nowrap">
                {{ $report->created_at ? $report->created_at->format('d/m/Y') : '-' }}
              </td>

              <td class="py-3.5 px-4 text-center whitespace-nowrap" onclick="event.stopPropagation()">
                <a href="{{ $detailUrl }}" 
                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-semibold rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/60 shadow-xs transition-colors"
                   title="Lihat Detail Laporan">
                  <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                  </svg>
                  Lihat
                </a>
              </td>

            </tr>
          @empty
            <tr>
              <td colspan="9" class="py-12 text-center text-slate-400 text-sm">
                <div class="flex flex-col items-center justify-center max-w-sm mx-auto">
                  <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                  </div>
                  <span class="font-semibold text-slate-700">Tidak ada data laporan ditemukan</span>
                  <p class="text-xs text-slate-500 mt-1">Sesuaikan opsi filter untuk menampilkan data laporan lainnya.</p>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination Bar --}}
    @if(isset($reports) && method_exists($reports, 'hasPages') && $reports->hasPages())
      <div class="p-4 bg-slate-50/70 border-t border-slate-200">
        {{ $reports->withQueryString()->links() }}
      </div>
    @endif
  </div>

</div>
@endsection
