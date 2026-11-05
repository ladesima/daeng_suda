@extends('layouts.admin')

@section('title', 'Dashboard Pimpinan ESDM')
@section('pageTitle', 'Dashboard Monitoring ESDM')
@section('pageSub', 'Ringkasan data untuk pimpinan')

@section('content')
@php
  $totalLaporan = $stats['total'] ?? $stats['total_laporan'] ?? 0;
  $menungguVerifikasi = $stats['menunggu_verifikasi'] ?? $stats['baru'] ?? 0;
  $dalamProses = $stats['dalam_proses'] ?? 0;
  $selesai = $stats['selesai'] ?? 0;

  $totalDesa = $stats['total_desa'] ?? 113;
  $desaSudahInput = $stats['desa_sudah_input'] ?? $stats['desa_input'] ?? 0;
  $desaBelumInput = $stats['desa_belum_input'] ?? max(0, $totalDesa - $desaSudahInput);
  $percentDesa = $totalDesa > 0 ? min(100, round(($desaSudahInput / $totalDesa) * 100, 1)) : 0;

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

  $typeLabelsMap = [
      'pju' => 'Penerangan Jalan Umum (PJU)',
      'bpbl' => 'Bantuan Pasang Baru Listrik (BPBL)',
      'jaringan_listrik' => 'Jaringan Listrik',
      'kebutuhan_energi' => 'Kebutuhan Energi Masyarakat',
      'permasalahan_lainnya' => 'Permasalahan ESDM Lainnya',
  ];

  $chartStatusLabels = $chartData['status']['labels'] ?? $chartData['status_labels'] ?? ['Baru', 'Verifikasi', 'Perbaikan', 'Tindak Lanjut', 'Dalam Proses', 'Selesai'];
  $chartStatusValues = $chartData['status']['data'] ?? $chartData['status_counts'] ?? $chartData['status_data'] ?? [0, 0, 0, 0, 0, 0];

  $chartTypeLabels = $chartData['types']['labels'] ?? $chartData['jenis']['labels'] ?? $chartData['type_labels'] ?? ['PJU', 'BPBL', 'Jaringan Listrik', 'Kebutuhan Energi', 'Lainnya'];
  $chartTypeValues = $chartData['types']['data'] ?? $chartData['jenis']['data'] ?? $chartData['type_counts'] ?? $chartData['type_data'] ?? [0, 0, 0, 0, 0];

  $pimpinanIndexUrl = Route::has('esdm.pimpinan.report.index') ? route('esdm.pimpinan.report.index') : (Route::has('esdm.admin.report.index') ? route('esdm.admin.report.index') : '#');
@endphp

<div class="space-y-6">

  {{-- Row 1: Top Stats Cards (4 cols desktop, 2 cols mobile) --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
    {{-- Total Laporan --}}
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-medium uppercase tracking-wider text-slate-500">Total Laporan</span>
          <div class="mt-2 text-2xl lg:text-3xl font-bold text-slate-800 tracking-tight">{{ number_format($totalLaporan) }}</div>
          <span class="text-xs text-slate-400 mt-1 inline-block">Seluruh berkas</span>
        </div>
        <div class="h-12 w-12 rounded-xl bg-slate-100 text-slate-700 grid place-content-center shrink-0">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
        </div>
      </div>
    </div>

    {{-- Menunggu Verifikasi --}}
    <div class="bg-white border border-amber-200/80 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-medium uppercase tracking-wider text-amber-700">Menunggu Verifikasi</span>
          <div class="mt-2 text-2xl lg:text-3xl font-bold text-amber-600 tracking-tight">{{ number_format($menungguVerifikasi) }}</div>
          <span class="text-xs text-amber-600/80 mt-1 inline-block">Antrean verifikasi</span>
        </div>
        <div class="h-12 w-12 rounded-xl bg-amber-50 text-amber-600 grid place-content-center shrink-0 ring-1 ring-amber-500/20">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
    </div>

    {{-- Dalam Proses --}}
    <div class="bg-white border border-blue-200/80 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-medium uppercase tracking-wider text-blue-700">Dalam Proses</span>
          <div class="mt-2 text-2xl lg:text-3xl font-bold text-blue-600 tracking-tight">{{ number_format($dalamProses) }}</div>
          <span class="text-xs text-blue-600/80 mt-1 inline-block">Koordinasi & teknis</span>
        </div>
        <div class="h-12 w-12 rounded-xl bg-blue-50 text-blue-600 grid place-content-center shrink-0 ring-1 ring-blue-500/20">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
      </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white border border-emerald-200/80 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between">
        <div>
          <span class="text-xs font-medium uppercase tracking-wider text-emerald-700">Selesai</span>
          <div class="mt-2 text-2xl lg:text-3xl font-bold text-emerald-600 tracking-tight">{{ number_format($selesai) }}</div>
          <span class="text-xs text-emerald-600/80 mt-1 inline-block">Telah ditangani</span>
        </div>
        <div class="h-12 w-12 rounded-xl bg-emerald-50 text-emerald-600 grid place-content-center shrink-0 ring-1 ring-emerald-500/20">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
        </div>
      </div>
    </div>
  </div>

  {{-- Row 2: Partisipasi Input Desa --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Desa Sudah Input --}}
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between mb-3">
        <div>
          <h3 class="text-sm font-semibold text-slate-800">Cakupan Desa Menginput</h3>
          <p class="text-xs text-slate-500">Progres desa/kelurahan yang telah mengirim laporan ESDM</p>
        </div>
        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
          {{ $percentDesa }}%
        </span>
      </div>

      <div class="flex items-baseline gap-2 mb-2">
        <span class="text-3xl font-extrabold text-slate-800">{{ $desaSudahInput }}</span>
        <span class="text-sm font-medium text-slate-500">dari {{ $totalDesa }} Desa / Kelurahan</span>
      </div>

      {{-- Progress Bar --}}
      <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden ring-1 ring-slate-200/60">
        <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-3 rounded-full transition-all duration-500"
             style="width: {{ $percentDesa }}%"></div>
      </div>
    </div>

    {{-- Desa Belum Input --}}
    <div class="bg-white border {{ $desaBelumInput > ($totalDesa * 0.5) ? 'border-rose-200 bg-rose-50/20' : 'border-slate-200/80' }} rounded-2xl p-5 shadow-sm">
      <div class="flex items-center justify-between mb-3">
        <div>
          <h3 class="text-sm font-semibold {{ $desaBelumInput > ($totalDesa * 0.5) ? 'text-rose-900' : 'text-slate-800' }}">Desa Belum Menginput</h3>
          <p class="text-xs {{ $desaBelumInput > ($totalDesa * 0.5) ? 'text-rose-600' : 'text-slate-500' }}">Desa yang belum memiliki catatan pelaporan aktif</p>
        </div>
        <div class="h-10 w-10 rounded-xl {{ $desaBelumInput > ($totalDesa * 0.5) ? 'bg-rose-100 text-rose-700 ring-1 ring-rose-500/20' : 'bg-slate-100 text-slate-600' }} grid place-content-center shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
          </svg>
        </div>
      </div>

      <div class="flex items-baseline gap-2">
        <span class="text-3xl font-extrabold {{ $desaBelumInput > ($totalDesa * 0.5) ? 'text-rose-600' : 'text-slate-800' }}">{{ $desaBelumInput }}</span>
        <span class="text-sm font-medium text-slate-500">Desa / Kelurahan tersisa</span>
      </div>
      <p class="mt-2 text-xs {{ $desaBelumInput > ($totalDesa * 0.5) ? 'text-rose-600 font-medium' : 'text-slate-400' }}">
        {{ $desaBelumInput > ($totalDesa * 0.5) ? 'Perlu atensi pimpinan untuk mendorong percepatan input dari kecamatan terkait.' : 'Partisipasi input desa terpantau stabil.' }}
      </p>
    </div>
  </div>

  {{-- Row 3: Charts Section (Pie/Doughnut & Bar) --}}
  <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Chart 1: Sebaran Status Laporan --}}
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex flex-col">
      <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
        <div>
          <h3 class="font-semibold text-slate-800">Sebaran Status Laporan</h3>
          <p class="text-xs text-slate-500">Rasio penanganan laporan di tingkat kabupaten</p>
        </div>
        <span class="text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full font-medium">Monitoring</span>
      </div>
      <div class="relative flex-1 min-h-[260px] flex items-center justify-center">
        <canvas id="pimpinanStatusChart" class="max-h-[260px]"></canvas>
      </div>
    </div>

    {{-- Chart 2: Laporan per Jenis ESDM --}}
    <div class="bg-white border border-slate-200/80 rounded-2xl p-5 shadow-sm flex flex-col">
      <div class="flex items-center justify-between mb-4 pb-2 border-b border-slate-100">
        <div>
          <h3 class="font-semibold text-slate-800">Laporan per Jenis ESDM</h3>
          <p class="text-xs text-slate-500">Komposisi isu kebutuhan energi dan kelistrikan</p>
        </div>
        <span class="text-xs bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full font-medium">Sektor</span>
      </div>
      <div class="relative flex-1 min-h-[260px] flex items-center justify-center">
        <canvas id="pimpinanTypeChart" class="max-h-[260px]"></canvas>
      </div>
    </div>
  </div>

  {{-- Row 4: Table Laporan Terbaru (Read-only View for Executive) --}}
  <div class="bg-white border border-slate-200/80 rounded-2xl shadow-sm overflow-hidden">
    <div class="p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 border-b border-slate-100">
      <div>
        <h3 class="font-semibold text-slate-800 text-base">Laporan Terbaru</h3>
        <p class="text-xs text-slate-500 mt-0.5">Pemantauan 10 berkas laporan mutakhir masuk dari desa</p>
      </div>
      <a href="{{ $pimpinanIndexUrl }}" 
         class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-700 bg-emerald-50 hover:bg-emerald-100 px-3.5 py-2 rounded-xl transition-colors">
        <span>Lihat Seluruh Laporan</span>
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
        </svg>
      </a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full text-left border-collapse">
        <thead>
          <tr class="bg-slate-50/80 text-slate-600 text-xs font-semibold uppercase tracking-wider border-b border-slate-200">
            <th class="py-3.5 px-4">Desa</th>
            <th class="py-3.5 px-4">Kecamatan</th>
            <th class="py-3.5 px-4">Jenis ESDM</th>
            <th class="py-3.5 px-4">Status</th>
            <th class="py-3.5 px-4">Tanggal Masuk</th>
            <th class="py-3.5 px-4 text-center">Detail</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-sm">
          @forelse($recentReports ?? [] as $report)
            @php
              $statusKey = $report->status ?? 'baru';
              $cfg = $statusConfig[$statusKey] ?? [
                  'label' => ucfirst(str_replace('_', ' ', $statusKey)),
                  'class' => 'bg-slate-100 text-slate-700 border-slate-200'
              ];
              $typeName = $typeLabelsMap[$report->type] ?? $report->type_label ?? ucfirst(str_replace('_', ' ', $report->type ?? '-'));
              
              $detailUrl = Route::has('esdm.pimpinan.report.show') 
                  ? route('esdm.pimpinan.report.show', $report) 
                  : (Route::has('esdm.admin.report.show') ? route('esdm.admin.report.show', $report) : '#');
            @endphp
            <tr class="hover:bg-slate-50/70 transition-colors">
              <td class="py-3.5 px-4 font-medium text-slate-900 whitespace-nowrap">
                {{ $report->village->nama ?? '-' }}
              </td>
              <td class="py-3.5 px-4 text-slate-600 whitespace-nowrap">
                {{ $report->village->kecamatan ?? '-' }}
              </td>
              <td class="py-3.5 px-4 text-slate-700 whitespace-nowrap">
                <span class="inline-block max-w-[200px] truncate" title="{{ $typeName }}">
                  {{ $typeName }}
                </span>
              </td>
              <td class="py-3.5 px-4 whitespace-nowrap">
                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border {{ $cfg['class'] }}">
                  <span class="w-1.5 h-1.5 rounded-full mr-1.5 bg-current opacity-80"></span>
                  {{ $cfg['label'] }}
                </span>
              </td>
              <td class="py-3.5 px-4 text-slate-500 text-xs whitespace-nowrap">
                {{ $report->created_at ? $report->created_at->format('d/m/Y H:i') : '-' }}
              </td>
              <td class="py-3.5 px-4 text-center whitespace-nowrap">
                <a href="{{ $detailUrl }}" 
                   class="inline-flex items-center gap-1 px-3 py-1.5 text-xs font-medium rounded-lg text-emerald-700 bg-emerald-50 hover:bg-emerald-100 border border-emerald-200/60 transition-colors">
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
              <td colspan="6" class="py-8 text-center text-slate-400 text-sm">
                <div class="flex flex-col items-center justify-center">
                  <svg class="w-10 h-10 text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                  </svg>
                  <span>Belum ada laporan ESDM yang masuk.</span>
                </div>
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

{{-- Charts Initialization Script --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    if (typeof Chart === 'undefined') return;

    // 1. Doughnut Chart: Sebaran Status Laporan
    const statusCtx = document.getElementById('pimpinanStatusChart');
    if (statusCtx) {
      new Chart(statusCtx.getContext('2d'), {
        type: 'doughnut',
        data: {
          labels: @json($chartStatusLabels),
          datasets: [{
            data: @json($chartStatusValues),
            backgroundColor: [
              '#3B82F6', // Baru: Blue
              '#F59E0B', // Verifikasi: Amber
              '#EF4444', // Perbaikan: Red
              '#F97316', // Tindak Lanjut: Orange
              '#6366F1', // Dalam Proses: Indigo
              '#10B981', // Selesai: Emerald
            ],
            borderWidth: 2,
            borderColor: '#FFFFFF',
            hoverOffset: 4
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                boxWidth: 12,
                padding: 12,
                font: { size: 11 }
              }
            }
          },
          cutout: '68%'
        }
      });
    }

    // 2. Bar Chart: Laporan per Jenis ESDM
    const typeCtx = document.getElementById('pimpinanTypeChart');
    if (typeCtx) {
      new Chart(typeCtx.getContext('2d'), {
        type: 'bar',
        data: {
          labels: @json($chartTypeLabels),
          datasets: [{
            label: 'Jumlah Laporan',
            data: @json($chartTypeValues),
            backgroundColor: '#059669',
            borderRadius: 8,
            maxBarThickness: 42
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: {
            legend: { display: false }
          },
          scales: {
            x: {
              grid: { display: false },
              ticks: { font: { size: 11 } }
            },
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0,
                font: { size: 11 }
              },
              grid: {
                color: '#F1F5F9'
              }
            }
          }
        }
      });
    }
  });
</script>
@endsection
