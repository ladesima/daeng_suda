@extends('layouts.desa')

@section('title', 'Dashboard ESDM Desa')

@section('content')
<div class="space-y-6">
  {{-- 1. WELCOME HERO CARD --}}
  <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-800 via-emerald-700 to-teal-800 text-white p-5 sm:p-7 shadow-lg shadow-emerald-900/15">
    {{-- Decorative Background Elements --}}
    <div class="absolute -right-8 -bottom-8 w-44 h-44 rounded-full bg-white/10 blur-2xl pointer-events-none"></div>
    <div class="absolute right-4 top-4 text-emerald-300/15 pointer-events-none hidden sm:block">
      <svg class="w-32 h-32" viewBox="0 0 24 24" fill="currentColor">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
      </svg>
    </div>

    <div class="relative z-10">
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/30 text-emerald-100 text-xs font-medium backdrop-blur-xs mb-2 border border-white/10">
            <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
            <span>Wilayah Desa Terdaftar</span>
          </div>

          <h1 class="text-xl sm:text-2xl font-extrabold tracking-tight">
            {{ $village->nama ?? (Auth::user()->village->nama ?? 'Desa Terdaftar') }}
          </h1>

          <p class="text-xs sm:text-sm text-emerald-100/90 mt-1 flex items-center gap-1.5">
            <svg class="w-4 h-4 shrink-0 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
            Kecamatan {{ $village->kecamatan ?? (Auth::user()->village->kecamatan ?? 'Kabupaten Jeneponto') }}
          </p>
        </div>

        <div class="sm:text-right flex flex-row sm:flex-col items-center sm:items-end justify-between sm:justify-center border-t border-white/15 sm:border-0 pt-3 sm:pt-0">
          <div class="text-[11px] sm:text-xs text-emerald-200">
            {{ now()->translatedFormat('l, d F Y') }}
          </div>
          <div class="inline-flex items-center gap-1.5 mt-1 px-3 py-1 rounded-xl bg-white/15 backdrop-blur-xs text-xs font-semibold text-white">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
            Pelaporan Aktif
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- 2. METRICS STATS --}}
  @php
    $totalVal = is_array($stats ?? null) ? ($stats['total'] ?? 0) : ($stats->total ?? (isset($reports) && method_exists($reports, 'total') ? $reports->total() : 0));
    $baruVal = is_array($stats ?? null) ? ($stats['baru'] ?? 0) : ($stats->baru ?? 0);
    $prosesVal = is_array($stats ?? null) ? (($stats['dalam_proses'] ?? 0) + ($stats['tindak_lanjut'] ?? 0)) : 0;
    $selesaiVal = is_array($stats ?? null) ? ($stats['selesai'] ?? 0) : ($stats->selesai ?? 0);
    $perbaikanVal = is_array($stats ?? null) ? ($stats['perbaikan'] ?? 0) : ($stats->perbaikan ?? 0);
  @endphp

  <div>
    <div class="flex items-center justify-between mb-3 px-1">
      <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500">Ringkasan Status Laporan</h2>
      <span class="text-xs text-slate-400">Desa {{ $village->nama ?? '' }}</span>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
      {{-- Card Total --}}
      <div class="bg-white rounded-2xl p-4 border border-slate-200/80 shadow-xs flex items-center justify-between">
        <div>
          <span class="text-xs font-semibold text-slate-500 block">Total Laporan</span>
          <span class="text-2xl font-extrabold text-slate-800 mt-0.5 block">{{ $totalVal }}</span>
          <span class="text-[11px] text-slate-400">Semua kategori</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-600 shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
        </div>
      </div>

      {{-- Card Baru --}}
      <div class="bg-white rounded-2xl p-4 border border-blue-200/80 shadow-xs flex items-center justify-between">
        <div>
          <span class="text-xs font-semibold text-blue-600 block">Menunggu</span>
          <span class="text-2xl font-extrabold text-blue-700 mt-0.5 block">{{ $baruVal }}</span>
          <span class="text-[11px] text-blue-500/80">Verifikasi SDA</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
        </div>
      </div>

      {{-- Card Proses --}}
      <div class="bg-white rounded-2xl p-4 border border-indigo-200/80 shadow-xs flex items-center justify-between">
        <div>
          <span class="text-xs font-semibold text-indigo-600 block">Diproses</span>
          <span class="text-2xl font-extrabold text-indigo-700 mt-0.5 block">{{ $prosesVal }}</span>
          <span class="text-[11px] text-indigo-500/80">Tindak lanjut</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-indigo-50 flex items-center justify-center text-indigo-600 shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
        </div>
      </div>

      {{-- Card Selesai --}}
      <div class="bg-white rounded-2xl p-4 border border-emerald-200/80 shadow-xs flex items-center justify-between">
        <div>
          <span class="text-xs font-semibold text-emerald-600 block">Selesai</span>
          <span class="text-2xl font-extrabold text-emerald-700 mt-0.5 block">{{ $selesaiVal }}</span>
          <span class="text-[11px] text-emerald-500/80">Tuntas tertangani</span>
        </div>
        <div class="w-10 h-10 rounded-xl bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
        </div>
      </div>
    </div>

    @if ($perbaikanVal > 0)
      <div class="mt-3 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs flex items-center justify-between shadow-xs">
        <div class="flex items-center gap-2">
          <span class="w-2.5 h-2.5 rounded-full bg-rose-500 animate-ping"></span>
          <span class="font-bold">Perhatian:</span>
          <span>Terdapat <strong>{{ $perbaikanVal }}</strong> laporan yang membutuhkan perbaikan data dari desa.</span>
        </div>
        <span class="font-bold text-rose-700 underline text-[11px]">Lihat di bawah ↓</span>
      </div>
    @endif
  </div>

  {{-- 3. QUICK ACTION GRID: 5 CATEGORIES --}}
  <div>
    <div class="flex items-center justify-between mb-3 px-1">
      <div>
        <h2 class="text-xs font-bold uppercase tracking-wider text-slate-500">Pilih Kategori Laporan ESDM</h2>
        <p class="text-xs text-slate-400">Klik salah satu kategori untuk mengisi formulir</p>
      </div>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
      {{-- 1. PJU --}}
      <a 
        href="{{ route('esdm.desa.report.create', 'pju') }}"
        class="bg-white rounded-2xl p-4 border border-amber-200/70 hover:border-amber-400 hover:shadow-md hover:-translate-y-0.5 transition-all group flex flex-col justify-between shadow-xs"
      >
        <div>
          <div class="w-12 h-12 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-2xl shadow-sm shadow-amber-500/30 group-hover:scale-105 transition-transform">
            💡
          </div>
          <h3 class="font-bold text-slate-800 text-sm mt-3 group-hover:text-amber-800 leading-snug">PJU (Lampu Jalan)</h3>
          <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Lampu padam, rusak, atau penambahan titik</p>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-amber-600">
          <span>Isi Form</span>
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      {{-- 2. BPBL --}}
      <a 
        href="{{ route('esdm.desa.report.create', 'bpbl') }}"
        class="bg-white rounded-2xl p-4 border border-blue-200/70 hover:border-blue-400 hover:shadow-md hover:-translate-y-0.5 transition-all group flex flex-col justify-between shadow-xs"
      >
        <div>
          <div class="w-12 h-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center text-2xl shadow-sm shadow-blue-500/30 group-hover:scale-105 transition-transform">
            🏠
          </div>
          <h3 class="font-bold text-slate-800 text-sm mt-3 group-hover:text-blue-800 leading-snug">BPBL (Pasang Baru)</h3>
          <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Bantuan meteran listrik warga prasejahtera</p>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-blue-600">
          <span>Isi Form</span>
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      {{-- 3. Jaringan Listrik --}}
      <a 
        href="{{ route('esdm.desa.report.create', 'jaringan-listrik') }}"
        class="bg-white rounded-2xl p-4 border border-indigo-200/70 hover:border-indigo-400 hover:shadow-md hover:-translate-y-0.5 transition-all group flex flex-col justify-between shadow-xs"
      >
        <div>
          <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-2xl shadow-sm shadow-indigo-600/30 group-hover:scale-105 transition-transform">
            ⚡
          </div>
          <h3 class="font-bold text-slate-800 text-sm mt-3 group-hover:text-indigo-800 leading-snug">Jaringan Listrik</h3>
          <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Tiang rusak/miring, kabel, perluasan PLN</p>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-indigo-600">
          <span>Isi Form</span>
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      {{-- 4. Kebutuhan Energi --}}
      <a 
        href="{{ route('esdm.desa.report.create', 'kebutuhan-energi') }}"
        class="bg-white rounded-2xl p-4 border border-emerald-200/70 hover:border-emerald-400 hover:shadow-md hover:-translate-y-0.5 transition-all group flex flex-col justify-between shadow-xs"
      >
        <div>
          <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center text-2xl shadow-sm shadow-emerald-600/30 group-hover:scale-105 transition-transform">
            🔋
          </div>
          <h3 class="font-bold text-slate-800 text-sm mt-3 group-hover:text-emerald-800 leading-snug">Kebutuhan Energi</h3>
          <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Panel surya, gas elpiji, biogas warga</p>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-emerald-600">
          <span>Isi Form</span>
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      {{-- 5. Masalah Lainnya --}}
      <a 
        href="{{ route('esdm.desa.report.create', 'permasalahan-lainnya') }}"
        class="col-span-2 sm:col-span-1 bg-white rounded-2xl p-4 border border-rose-200/70 hover:border-rose-400 hover:shadow-md hover:-translate-y-0.5 transition-all group flex flex-col justify-between shadow-xs"
      >
        <div>
          <div class="w-12 h-12 rounded-2xl bg-rose-600 text-white flex items-center justify-center text-2xl shadow-sm shadow-rose-600/30 group-hover:scale-105 transition-transform">
            ⚠️
          </div>
          <h3 class="font-bold text-slate-800 text-sm mt-3 group-hover:text-rose-800 leading-snug">Masalah Lainnya</h3>
          <p class="text-[11px] text-slate-500 mt-1 leading-relaxed">Tambang galian, BBM, kelangkaan gas</p>
        </div>
        <div class="mt-3 pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px] font-semibold text-rose-600">
          <span>Isi Form</span>
          <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>
    </div>
  </div>

  {{-- 4. RIWAYAT LAPORAN --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 sm:p-6 shadow-xs space-y-4">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-4 border-b border-slate-100">
      <div>
        <h2 class="font-bold text-slate-800 text-base">Riwayat Laporan Desa</h2>
        <p class="text-xs text-slate-500">Daftar laporan yang telah dikirimkan oleh desa ini ke Bagian SDA</p>
      </div>

      <button 
        type="button" 
        @click="showTypeModal = true"
        class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition active:scale-95 shadow-xs w-fit"
      >
        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
        + Buat Laporan Baru
      </button>
    </div>

    @if ($reports && $reports->count() > 0)
      <div class="space-y-3">
        @foreach ($reports as $r)
          @php
            $typeIcons = [
              'pju' => ['icon' => '💡', 'color' => 'amber'],
              'bpbl' => ['icon' => '🏠', 'color' => 'blue'],
              'jaringan_listrik' => ['icon' => '⚡', 'color' => 'indigo'],
              'kebutuhan_energi' => ['icon' => '🔋', 'color' => 'emerald'],
              'permasalahan_lainnya' => ['icon' => '⚠️', 'color' => 'rose'],
            ];
            $t = $typeIcons[$r->type] ?? ['icon' => '📋', 'color' => 'slate'];

            $statusConfig = [
              'baru' => ['label' => 'Baru', 'class' => 'bg-blue-50 text-blue-700 border-blue-200'],
              'verifikasi' => ['label' => 'Terverifikasi', 'class' => 'bg-amber-50 text-amber-700 border-amber-200'],
              'perbaikan' => ['label' => 'Perlu Perbaikan', 'class' => 'bg-rose-50 text-rose-700 border-rose-300 animate-pulse'],
              'tindak_lanjut' => ['label' => 'Tindak Lanjut', 'class' => 'bg-orange-50 text-orange-700 border-orange-200'],
              'dalam_proses' => ['label' => 'Dalam Proses', 'class' => 'bg-indigo-50 text-indigo-700 border-indigo-200'],
              'selesai' => ['label' => 'Selesai', 'class' => 'bg-emerald-50 text-emerald-700 border-emerald-200'],
            ];
            $sc = $statusConfig[$r->status] ?? ['label' => ucfirst($r->status), 'class' => 'bg-slate-50 text-slate-700 border-slate-200'];
          @endphp

          <div class="p-4 rounded-2xl border border-slate-200/80 hover:border-emerald-300 hover:shadow-sm transition-all group flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-white">
            <div class="flex items-start gap-3.5 flex-1 min-w-0">
              <div class="w-11 h-11 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-center text-xl shrink-0 group-hover:scale-105 transition-transform">
                {{ $t['icon'] }}
              </div>

              <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 flex-wrap mb-1">
                  <span class="font-bold text-slate-800 text-sm group-hover:text-emerald-800">
                    {{ $r->type_label }}
                  </span>

                  <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-semibold border {{ $sc['class'] }}">
                    {{ $sc['label'] }}
                  </span>

                  @if ($r->tingkat_urgensi === 'tinggi')
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800 border border-rose-200">
                      Mendesak
                    </span>
                  @endif
                </div>

                <div class="text-xs text-slate-500 flex items-center gap-3 flex-wrap">
                  <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                    <span class="truncate max-w-[200px]">{{ $r->lokasi ?? 'Lokasi desa' }}</span>
                  </span>

                  <span class="flex items-center gap-1 text-slate-400">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 14 14"/></svg>
                    {{ $r->created_at->format('d M Y, H:i') }}
                  </span>

                  @if ($r->attachments->count() > 0)
                    <span class="flex items-center gap-1 text-slate-400">
                      <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48"/></svg>
                      {{ $r->attachments->count() }} Lampiran
                    </span>
                  @endif
                </div>
              </div>
            </div>

            <div class="flex items-center gap-2 pt-2 sm:pt-0 border-t sm:border-t-0 border-slate-100 justify-end">
              @if ($r->status === 'perbaikan')
                <a 
                  href="{{ route('esdm.desa.report.edit', $r) }}"
                  class="px-3.5 py-1.5 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs transition active:scale-95 shadow-xs flex items-center gap-1.5"
                >
                  <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                  Perbaiki Data
                </a>
              @endif

              <a 
                href="{{ route('esdm.desa.report.show', $r) }}"
                class="px-3.5 py-1.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-700 hover:text-emerald-700 font-semibold text-xs transition flex items-center gap-1 border border-slate-200/80"
              >
                <span>Lihat Detail</span>
                <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
              </a>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      @if (method_exists($reports, 'hasPages') && $reports->hasPages())
        <div class="pt-4 border-t border-slate-100">
          {{ $reports->links() }}
        </div>
      @endif

    @else
      {{-- Empty State --}}
      <div class="py-12 px-4 text-center">
        <div class="w-16 h-16 rounded-3xl bg-emerald-50 text-emerald-600 flex items-center justify-center text-3xl mx-auto mb-3">
          🌱
        </div>
        <h3 class="font-bold text-slate-800 text-base">Belum Ada Laporan ESDM</h3>
        <p class="text-xs text-slate-500 max-w-sm mx-auto mt-1 leading-relaxed">
          Wilayah desa Anda belum pernah mengirimkan laporan ESDM ke Bagian SDA. Silakan buat laporan pertama Anda sekarang.
        </p>
        <button 
          type="button" 
          @click="showTypeModal = true"
          class="mt-4 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition active:scale-95 shadow-sm shadow-emerald-600/30"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Mulai Buat Laporan
        </button>
      </div>
    @endif
  </div>
</div>
@endsection
