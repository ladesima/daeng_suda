<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-100">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Admin Desa ESDM') — DAENG SUDA</title>
  <link rel="icon" type="image/png" href="{{ asset('images/jepot.png') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
  @stack('styles')

  <style>
    [x-cloak] { display: none !important; }
    body { -webkit-tap-highlight-color: transparent; }
    .safe-bottom { padding-bottom: env(safe-area-inset-bottom, 1rem); }
  </style>
</head>
<body 
  class="min-h-full bg-slate-100 text-slate-800 antialiased font-sans flex flex-col"
  x-data="{ showTypeModal: false, showProfileModal: false }"
>
  {{-- TOP HEADER BAR --}}
  <header class="sticky top-0 z-30 bg-gradient-to-r from-emerald-800 via-emerald-700 to-teal-800 text-white shadow-sm">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      {{-- Brand / Logo --}}
      <a href="{{ route('esdm.desa.dashboard') }}" class="flex items-center gap-3 group">
        <div class="h-10 w-10 rounded-xl bg-white/10 p-1 flex items-center justify-center ring-1 ring-white/20 shadow-xs group-hover:bg-white/20 transition">
          <img src="{{ asset('images/jepot.png') }}" alt="Logo DAENG SUDA" class="h-full w-full object-contain">
        </div>
        <div class="leading-tight">
          <div class="font-bold text-sm sm:text-base tracking-wide flex items-center gap-2">
            <span>DAENG SUDA</span>
            <span class="text-[10px] bg-emerald-500/50 text-white px-2 py-0.5 rounded-full font-semibold uppercase tracking-wider border border-white/20">ESDM DESA</span>
          </div>
          <div class="text-[11px] text-emerald-100/80 flex items-center gap-1">
            <span class="w-1.5 h-1.5 rounded-full bg-emerald-300"></span>
            {{ Auth::user()->village->nama ?? 'Wilayah Desa' }} (Kec. {{ Auth::user()->village->kecamatan ?? 'Jeneponto' }})
          </div>
        </div>
      </a>

      {{-- Desktop Navigation (md:flex) --}}
      <nav class="hidden md:flex items-center gap-2">
        <a 
          href="{{ route('esdm.desa.dashboard') }}" 
          class="px-3.5 py-2 rounded-xl text-xs font-semibold transition flex items-center gap-1.5 {{ request()->routeIs('esdm.desa.dashboard*') ? 'bg-white/20 text-white shadow-xs' : 'text-emerald-100 hover:bg-white/10' }}"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Dashboard
        </a>

        <button 
          type="button" 
          @click="showTypeModal = true"
          class="px-4 py-2 rounded-xl text-xs font-semibold bg-emerald-500 hover:bg-emerald-400 text-white shadow-sm transition active:scale-95 flex items-center gap-1.5"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Buat Laporan Baru
        </button>

        <button 
          type="button" 
          @click="showProfileModal = true"
          class="px-3.5 py-2 rounded-xl text-xs font-semibold text-emerald-100 hover:bg-white/10 transition flex items-center gap-2"
        >
          <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-[11px] ring-1 ring-white/30">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'D', 0, 1)) }}
          </div>
          <span>{{ Auth::user()->name ?? 'Akun Desa' }}</span>
        </button>

        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button 
            type="submit" 
            title="Keluar" 
            onclick="return confirm('Apakah Anda yakin ingin keluar?')"
            class="p-2 rounded-xl text-emerald-200 hover:text-white hover:bg-rose-500/80 transition"
          >
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
          </button>
        </form>
      </nav>

      {{-- Mobile Right actions: User & Logout (md:hidden) --}}
      <div class="flex md:hidden items-center gap-2">
        <button 
          type="button" 
          @click="showProfileModal = true"
          class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-medium text-emerald-50 transition active:scale-95"
          title="Lihat Profil"
        >
          <div class="w-6 h-6 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold text-xs ring-1 ring-white/30">
            {{ strtoupper(mb_substr(Auth::user()->name ?? 'D', 0, 1)) }}
          </div>
          <span class="max-w-[70px] truncate text-left">{{ Str::words(Auth::user()->name ?? 'Desa', 1, '') }}</span>
        </button>

        <form method="POST" action="{{ route('logout') }}" class="inline">
          @csrf
          <button 
            type="submit" 
            title="Keluar" 
            onclick="return confirm('Apakah Anda yakin ingin keluar?')"
            class="p-2 rounded-xl bg-white/10 hover:bg-rose-500/80 text-emerald-100 hover:text-white transition active:scale-95"
          >
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
          </button>
        </form>
      </div>
    </div>
  </header>

  {{-- MAIN CONTENT AREA --}}
  <main class="flex-1 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-4 pb-24 md:pb-12">
    {{-- Flash Notifications --}}
    @if (session('success'))
      <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="mb-4 p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm flex items-start gap-3 shadow-xs"
        role="alert"
      >
        <svg class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
          <polyline points="22 4 12 14.01 9 11.01"></polyline>
        </svg>
        <div class="flex-1 font-medium leading-relaxed">{{ session('success') }}</div>
        <button type="button" @click="show = false" class="text-emerald-500 hover:text-emerald-700">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
    @endif

    @if (session('error'))
      <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="mb-4 p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-xs sm:text-sm flex items-start gap-3 shadow-xs"
        role="alert"
      >
        <svg class="w-5 h-5 text-rose-600 shrink-0 mt-0.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
        <div class="flex-1 font-medium leading-relaxed">{{ session('error') }}</div>
        <button type="button" @click="show = false" class="text-rose-500 hover:text-rose-700">
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>
    @endif

    @if ($errors->any())
      <div 
        x-data="{ show: true }" 
        x-show="show" 
        class="mb-4 p-4 rounded-2xl bg-amber-50 border border-amber-200 text-amber-900 text-xs sm:text-sm shadow-xs"
        role="alert"
      >
        <div class="flex items-center justify-between mb-1.5 font-semibold text-amber-800">
          <span class="flex items-center gap-2">
            <svg class="w-4 h-4 text-amber-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            Periksa isian formulir:
          </span>
          <button type="button" @click="show = false" class="text-amber-500 hover:text-amber-700">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
          </button>
        </div>
        <ul class="list-disc list-inside space-y-0.5 text-xs text-amber-700 pl-1">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @yield('content')
  </main>

  {{-- BOTTOM NAVIGATION BAR (FIXED ON MOBILE ONLY - md:hidden) --}}
  <nav class="md:hidden fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-md border-t border-slate-200/90 shadow-[0_-4px_20px_rgba(0,0,0,0.06)] safe-bottom">
    <div class="max-w-md mx-auto px-6 h-16 flex items-center justify-between">
      {{-- Tab 1: Dashboard --}}
      <a 
        href="{{ route('esdm.desa.dashboard') }}"
        class="flex flex-col items-center justify-center py-1 transition group {{ request()->routeIs('esdm.desa.dashboard*') ? 'text-emerald-700 font-bold' : 'text-slate-400 hover:text-slate-600' }}"
      >
        <div class="relative">
          <svg class="w-6 h-6 transition-transform group-active:scale-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ request()->routeIs('esdm.desa.dashboard*') ? '2.4' : '1.8' }}" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
            <polyline points="9 22 9 12 15 12 15 22"></polyline>
          </svg>
          @if (request()->routeIs('esdm.desa.dashboard*'))
            <span class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-1.5 h-1.5 bg-emerald-600 rounded-full"></span>
          @endif
        </div>
        <span class="text-[11px] mt-0.5">Beranda</span>
      </a>

      {{-- Tab 2: Buat Laporan (Center Floating Accent) --}}
      <button 
        type="button" 
        @click="showTypeModal = true"
        class="flex flex-col items-center justify-center -mt-6 group"
      >
        <div class="h-14 w-14 rounded-full bg-gradient-to-tr from-emerald-600 via-emerald-500 to-teal-500 text-white flex items-center justify-center shadow-lg shadow-emerald-600/30 ring-4 ring-white group-active:scale-95 transition-all">
          <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
          </svg>
        </div>
        <span class="text-[11px] font-semibold text-emerald-800 mt-0.5">Lapor</span>
      </button>

      {{-- Tab 3: Profil --}}
      <button 
        type="button" 
        @click="showProfileModal = true"
        class="flex flex-col items-center justify-center py-1 transition group text-slate-400 hover:text-slate-600"
      >
        <svg class="w-6 h-6 transition-transform group-active:scale-90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
          <circle cx="12" cy="7" r="4"></circle>
        </svg>
        <span class="text-[11px] mt-0.5">Profil</span>
      </button>
    </div>
  </nav>

  {{-- MODAL / BOTTOM SHEET: PILIH JENIS LAPORAN --}}
  <div 
    x-show="showTypeModal" 
    x-cloak 
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
    role="dialog"
    aria-modal="true"
  >
    {{-- Backdrop --}}
    <div 
      x-show="showTypeModal"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @click="showTypeModal = false"
      class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"
    ></div>

    {{-- Sheet / Dialog Content --}}
    <div 
      x-show="showTypeModal"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0"
      x-transition:enter-end="translate-y-0 sm:scale-100 sm:opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="translate-y-0 sm:scale-100 sm:opacity-100"
      x-transition:leave-end="translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0"
      class="relative w-full max-w-xl bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl p-5 sm:p-6 z-10 max-h-[90vh] overflow-y-auto"
    >
      {{-- Drag handle for mobile --}}
      <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-3 sm:hidden"></div>

      <div class="flex items-center justify-between pb-3 border-b border-slate-100">
        <div>
          <h3 class="font-bold text-base sm:text-lg text-slate-800">Pilih Kategori Laporan ESDM</h3>
          <p class="text-xs text-slate-500">Pilih salah satu formulir sesuai kebutuhan wilayah desa Anda</p>
        </div>
        <button 
          type="button" 
          @click="showTypeModal = false"
          class="p-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-100"
        >
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>

      {{-- List of 5 Report Types --}}
      <div class="mt-4 space-y-2.5">
        {{-- 1. PJU --}}
        <a 
          href="{{ route('esdm.desa.report.create', 'pju') }}"
          class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-amber-200/80 bg-amber-50/40 hover:bg-amber-50/90 hover:border-amber-300 active:scale-[0.98] transition group shadow-xs"
        >
          <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm shadow-amber-500/30">
            💡
          </div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-slate-800 text-sm group-hover:text-amber-800">Penerangan Jalan Umum (PJU)</div>
            <div class="text-xs text-slate-500 truncate">Lampu jalan rusak, padam, atau kebutuhan penambahan titik baru</div>
          </div>
          <svg class="w-5 h-5 text-amber-500 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        {{-- 2. BPBL --}}
        <a 
          href="{{ route('esdm.desa.report.create', 'bpbl') }}"
          class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-blue-200/80 bg-blue-50/40 hover:bg-blue-50/90 hover:border-blue-300 active:scale-[0.98] transition group shadow-xs"
        >
          <div class="w-12 h-12 rounded-xl bg-blue-500 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm shadow-blue-500/30">
            🏠
          </div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-slate-800 text-sm group-hover:text-blue-800">Bantuan Pasang Baru Listrik (BPBL)</div>
            <div class="text-xs text-slate-500 truncate">Usulan sambungan meteran listrik gratis bagi rumah tangga sasaran</div>
          </div>
          <svg class="w-5 h-5 text-blue-500 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        {{-- 3. Jaringan Listrik --}}
        <a 
          href="{{ route('esdm.desa.report.create', 'jaringan-listrik') }}"
          class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-indigo-200/80 bg-indigo-50/40 hover:bg-indigo-50/90 hover:border-indigo-300 active:scale-[0.98] transition group shadow-xs"
        >
          <div class="w-12 h-12 rounded-xl bg-indigo-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm shadow-indigo-600/30">
            ⚡
          </div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-slate-800 text-sm group-hover:text-indigo-800">Jaringan & Tiang Listrik</div>
            <div class="text-xs text-slate-500 truncate">Tiang miring, kabel menjuntai, atau wilayah belum terjangkau jaringan PLN</div>
          </div>
          <svg class="w-5 h-5 text-indigo-500 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        {{-- 4. Kebutuhan Energi Masyarakat --}}
        <a 
          href="{{ route('esdm.desa.report.create', 'kebutuhan-energi') }}"
          class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-emerald-200/80 bg-emerald-50/40 hover:bg-emerald-50/90 hover:border-emerald-300 active:scale-[0.98] transition group shadow-xs"
        >
          <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm shadow-emerald-600/30">
            🔋
          </div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-slate-800 text-sm group-hover:text-emerald-800">Kebutuhan Energi Masyarakat</div>
            <div class="text-xs text-slate-500 truncate">Usulan panel surya/solar cell, biogas, pasokan gas elpiji, dll.</div>
          </div>
          <svg class="w-5 h-5 text-emerald-500 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        {{-- 5. Permasalahan ESDM Lainnya --}}
        <a 
          href="{{ route('esdm.desa.report.create', 'permasalahan-lainnya') }}"
          class="flex items-center gap-3.5 p-3.5 rounded-2xl border border-rose-200/80 bg-rose-50/40 hover:bg-rose-50/90 hover:border-rose-300 active:scale-[0.98] transition group shadow-xs"
        >
          <div class="w-12 h-12 rounded-xl bg-rose-600 text-white flex items-center justify-center text-2xl shrink-0 shadow-sm shadow-rose-600/30">
            ⚠️
          </div>
          <div class="flex-1 min-w-0">
            <div class="font-bold text-slate-800 text-sm group-hover:text-rose-800">Permasalahan ESDM Lainnya</div>
            <div class="text-xs text-slate-500 truncate">Kendala bahan bakar, pertambangan galian, atau kondisi darurat</div>
          </div>
          <svg class="w-5 h-5 text-rose-500 group-hover:translate-x-1 transition-transform shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
      </div>
    </div>
  </div>

  {{-- MODAL: PROFIL --}}
  <div 
    x-show="showProfileModal" 
    x-cloak 
    class="fixed inset-0 z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
    role="dialog"
    aria-modal="true"
  >
    {{-- Backdrop --}}
    <div 
      x-show="showProfileModal"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="opacity-0"
      x-transition:enter-end="opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="opacity-100"
      x-transition:leave-end="opacity-0"
      @click="showProfileModal = false"
      class="fixed inset-0 bg-slate-900/60 backdrop-blur-xs"
    ></div>

    <div 
      x-show="showProfileModal"
      x-transition:enter="ease-out duration-300"
      x-transition:enter-start="translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0"
      x-transition:enter-end="translate-y-0 sm:scale-100 sm:opacity-100"
      x-transition:leave="ease-in duration-200"
      x-transition:leave-start="translate-y-0 sm:scale-100 sm:opacity-100"
      x-transition:leave-end="translate-y-full sm:translate-y-0 sm:scale-95 sm:opacity-0"
      class="relative w-full max-w-md bg-white rounded-t-3xl sm:rounded-3xl shadow-2xl p-6 z-10"
    >
      <div class="w-12 h-1.5 bg-slate-200 rounded-full mx-auto mb-4 sm:hidden"></div>

      <div class="flex items-center justify-between pb-3 border-b border-slate-100">
        <h3 class="font-bold text-base sm:text-lg text-slate-800">Profil Petugas Desa</h3>
        <button 
          type="button" 
          @click="showProfileModal = false"
          class="p-2 rounded-full text-slate-400 hover:text-slate-600 hover:bg-slate-100"
        >
          <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
      </div>

      <div class="py-4 text-center">
        <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 text-white text-2xl font-bold flex items-center justify-center mx-auto shadow-md ring-4 ring-emerald-50">
          {{ strtoupper(mb_substr(Auth::user()->name ?? 'D', 0, 1)) }}
        </div>
        <h4 class="font-bold text-slate-800 text-base mt-3">{{ Auth::user()->name ?? 'Administrator Desa' }}</h4>
        <p class="text-xs text-slate-500">{{ Auth::user()->email ?? '-' }}</p>
        <div class="inline-flex items-center gap-1.5 mt-2 px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200/80">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          {{ Auth::user()->village->nama ?? 'Wilayah Desa' }}
        </div>
      </div>

      <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200/80 space-y-2.5 text-xs">
        <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
          <span class="text-slate-500">Kecamatan:</span>
          <span class="font-semibold text-slate-700">{{ Auth::user()->village->kecamatan ?? '-' }}</span>
        </div>
        <div class="flex justify-between items-center py-1 border-b border-slate-200/60">
          <span class="text-slate-500">Status Akses:</span>
          <span class="font-semibold text-emerald-700">Admin Desa (Aktif)</span>
        </div>
        <div class="flex justify-between items-center py-1">
          <span class="text-slate-500">Sistem:</span>
          <span class="font-semibold text-slate-700">DAENG SUDA — Modul ESDM</span>
        </div>
      </div>

      <div class="mt-5 space-y-2">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button 
            type="submit" 
            onclick="return confirm('Apakah Anda yakin ingin keluar?')"
            class="w-full py-3 px-4 rounded-xl bg-rose-50 text-rose-600 font-semibold text-xs sm:text-sm hover:bg-rose-100 flex items-center justify-center gap-2 transition active:scale-95 border border-rose-200/60"
          >
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
              <polyline points="16 17 21 12 16 7"></polyline>
              <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Keluar dari Sistem
          </button>
        </form>
        <button 
          type="button" 
          @click="showProfileModal = false"
          class="w-full py-2.5 px-4 rounded-xl text-slate-500 text-xs font-medium hover:bg-slate-100"
        >
          Tutup
        </button>
      </div>
    </div>
  </div>

  @stack('scripts')
</body>
</html>
