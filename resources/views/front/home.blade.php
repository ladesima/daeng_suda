@extends('layouts.app')
@section('title','Beranda')

@push('styles')
  {{-- Leaflet CSS --}}
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

  <style>
    /* Leaflet popup customization */
    .leaflet-popup-content-wrapper {
      border-radius: 1.25rem !important;
      padding: 0 !important;
      overflow: hidden !important;
      box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.15), 0 8px 10px -6px rgba(15, 23, 42, 0.1) !important;
      border: 1px solid rgba(226, 232, 240, 0.9) !important;
    }
    .leaflet-popup-content {
      margin: 0 !important;
      line-height: 1.4 !important;
    }
    .leaflet-popup-tip {
      background: #ffffff !important;
    }
    .leaflet-container {
      font-family: inherit !important;
    }

    /* Custom Leaflet Map Pin */
    .custom-leaflet-pin {
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: transform 0.2s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .custom-leaflet-pin:hover {
      transform: scale(1.15) translateY(-3px);
      z-index: 9999 !important;
    }
    .custom-leaflet-pin .pin-halo {
      position: absolute;
      width: 44px;
      height: 44px;
      border-radius: 9999px;
      opacity: 0.35;
      animation: pinPulseEffect 2.2s infinite ease-out;
      pointer-events: none;
    }
    @keyframes pinPulseEffect {
      0% { transform: scale(0.6); opacity: 0.7; }
      100% { transform: scale(1.8); opacity: 0; }
    }

    /* Float animation for hero elements */
    @keyframes heroFloat {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-8px); }
    }
    .animate-hero-float {
      animation: heroFloat 6s ease-in-out infinite;
    }

    /* Gradient shift */
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    .animated-gradient {
      background: linear-gradient(135deg, #064e3b 0%, #065f46 25%, #047857 50%, #0d9488 75%, #047857 100%);
      background-size: 300% 300%;
      animation: gradientShift 15s ease infinite;
    }

    /* Card glow hover */
    .card-interactive {
      transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .card-interactive:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 30px -10px rgba(5, 150, 105, 0.15), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Scroll reveal class handled by JS */
    .reveal-on-scroll {
      opacity: 0;
      transform: translateY(28px);
      transition: opacity 0.7s cubic-bezier(0.16, 1, 0.3, 1), transform 0.7s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .reveal-on-scroll.is-revealed {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
@endpush

@section('content')

<!-- ============== HERO SECTION WITH SLIDESHOW ============== -->
<section id="beranda" class="section relative overflow-hidden" x-data="heroSlider()" x-init="init()">
  <!-- Background Slideshow -->
  <div class="absolute inset-0 -z-10">
    <template x-for="(slide, i) in slides" :key="i">
      <div class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000 scale-105 transition-transform"
           :style="`background-image:url(${slide.image})`"
           :class="active===i ? 'opacity-100' : 'opacity-0'">
      </div>
    </template>
    {{-- Dynamic layered overlay --}}
    <div class="absolute inset-0 animated-gradient opacity-90 mix-blend-multiply"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/90 via-emerald-950/60 to-transparent"></div>
    
    {{-- Grid pattern decoration --}}
    <div class="absolute inset-0 bg-[radial-gradient(#ffffff0a_1px,transparent_1px)] [background-size:24px_24px] opacity-70"></div>
  </div>

  <!-- Hero Content -->
  <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 text-white min-h-[560px] flex flex-col justify-between"
       @mouseenter="pause()" @mouseleave="play()">
    <div class="max-w-3xl">
      {{-- Animated Pill Badge --}}
      <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/10 border border-white/20 text-xs sm:text-sm font-medium text-emerald-200 backdrop-blur-md mb-4 shadow-sm animate-hero-float">
        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
        <span>Portal Digital SDA Terpadu</span>
        <span class="text-white/40">•</span>
        <span class="text-white/90">Kab. Jeneponto</span>
      </div>

      <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black leading-tight tracking-tight drop-shadow-sm">
        Data Elektronik Digital
        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-emerald-200 to-teal-300">
          Sumber Daya Alam
        </span>
      </h1>

      <p class="mt-4 text-base sm:text-lg text-emerald-50/90 leading-relaxed font-light max-w-2xl">
        Sekretariat Daerah Bagian Sumber Daya Alam Kabupaten Jeneponto. Pusat kompilasi potensi daerah, pelaporan kelistrikan desa (ESDM), dan pemantauan berbasis geospasial real-time.
      </p>

      {{-- Action Buttons CTA --}}
      <div class="mt-8 flex flex-wrap items-center gap-3.5">
        <a href="#potensi" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold text-sm shadow-lg shadow-emerald-500/30 hover:scale-105 active:scale-95 transition-all">
          <span>Jelajahi Potensi</span>
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>

        <a href="#modul-esdm" class="inline-flex items-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/20 text-white font-semibold text-sm border border-white/20 backdrop-blur-md hover:scale-105 active:scale-95 transition-all">
          <svg class="h-4 w-4 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
          <span>Modul ESDM Desa</span>
        </a>

        <a href="#peta" class="inline-flex items-center gap-2 px-5 py-3.5 rounded-2xl bg-slate-900/60 hover:bg-slate-900/80 text-emerald-100 font-semibold text-sm border border-emerald-500/30 backdrop-blur-md hover:scale-105 active:scale-95 transition-all">
          <svg class="h-4 w-4 text-emerald-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/></svg>
          <span>Peta Wilayah</span>
        </a>
      </div>
    </div>

    <!-- METRICS CARDS WITH GLASSMORPHISM -->
    <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-4 max-w-3xl">
      {{-- Card 1: Kecamatan --}}
      <div class="p-4 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md flex items-center gap-4 hover:bg-white/15 transition group">
        <div class="w-12 h-12 rounded-xl bg-amber-400/20 text-amber-300 flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition-transform">
          🏛️
        </div>
        <div>
          <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            {{ number_format(optional($metric)->districts ?? 11, 0, ',', '.') }}
          </div>
          <div class="text-xs font-medium text-emerald-200">Kecamatan Wilayah</div>
        </div>
      </div>

      {{-- Card 2: Desa/Kelurahan --}}
      <div class="p-4 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md flex items-center gap-4 hover:bg-white/15 transition group">
        <div class="w-12 h-12 rounded-xl bg-blue-400/20 text-blue-300 flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition-transform">
          🏡
        </div>
        <div>
          <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            {{ number_format(optional($metric)->villages ?? 113, 0, ',', '.') }}
          </div>
          <div class="text-xs font-medium text-emerald-200">Desa & Kelurahan</div>
        </div>
      </div>

      {{-- Card 3: Sektor SDA --}}
      <div class="p-4 rounded-2xl bg-white/10 border border-white/15 backdrop-blur-md flex items-center gap-4 hover:bg-white/15 transition group">
        <div class="w-12 h-12 rounded-xl bg-emerald-400/20 text-emerald-300 flex items-center justify-center text-2xl shrink-0 group-hover:scale-110 transition-transform">
          🌱
        </div>
        <div>
          <div class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
            {{ number_format(optional($metric)->sectors ?? 8, 0, ',', '.') }}
          </div>
          <div class="text-xs font-medium text-emerald-200">Sektor SDA Utama</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Slider Navigation Controls -->
  <button @click="prev()" class="hidden sm:flex absolute left-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center backdrop-blur-md transition z-20 active:scale-90" aria-label="Sebelumnya">
    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
  </button>
  <button @click="next()" class="hidden sm:flex absolute right-4 top-1/2 -translate-y-1/2 w-11 h-11 rounded-full bg-black/30 hover:bg-black/60 border border-white/20 text-white items-center justify-center backdrop-blur-md transition z-20 active:scale-90" aria-label="Berikutnya">
    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
  </button>

  <!-- Bullets Navigation -->
  <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
    <template x-for="(slide, i) in slides" :key="'b'+i">
      <button @click="go(i)" class="h-2 rounded-full transition-all duration-300"
              :class="active===i ? 'w-8 bg-emerald-400 shadow-md shadow-emerald-400/50' : 'w-2 bg-white/40 hover:bg-white/70'"></button>
    </template>
  </div>
</section>


<!-- ============== FEATURE SPOTLIGHT: MODUL ESDM (NEW) ============== -->
<section id="modul-esdm" class="section py-16 bg-gradient-to-b from-slate-900 to-emerald-950 text-white relative overflow-hidden">
  {{-- Background ambient glow --}}
  <div class="absolute top-1/2 -right-20 w-96 h-96 rounded-full bg-emerald-500/10 blur-3xl pointer-events-none"></div>
  <div class="absolute top-1/4 -left-20 w-80 h-80 rounded-full bg-amber-500/10 blur-3xl pointer-events-none"></div>

  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
    <div class="bg-gradient-to-r from-emerald-900/60 to-teal-900/60 rounded-3xl border border-emerald-500/30 p-6 sm:p-10 shadow-2xl backdrop-blur-md">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
        <div class="lg:col-span-7 space-y-4">
          <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-amber-400/20 border border-amber-400/30 text-amber-300 text-xs font-bold uppercase tracking-wider">
            <span>⚡ Pengembangan Baru</span>
            <span>•</span>
            <span>Modul ESDM Desa</span>
          </div>

          <h2 class="text-3xl sm:text-4xl font-black text-white leading-tight">
            Penghimpunan & Monitoring Masalah ESDM dari 113 Desa
          </h2>

          <p class="text-emerald-100/80 text-sm sm:text-base leading-relaxed font-light">
            Sesuai permohonan resmi Sekretariat Daerah Bagian Sumber Daya Alam Jeneponto, kini admin desa/kelurahan dapat melaporkan kondisi kelistrikan dan energi secara langsung melalui smartphone secara cepat, terstruktur, dan transparan.
          </p>

          {{-- 5 Core Highlights --}}
          <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 pt-2">
            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
              <span class="text-xl">💡</span>
              <div class="text-xs font-bold text-white mt-1">Lampu Jalan (PJU)</div>
              <div class="text-[10px] text-emerald-200/70">Padam, rusak & titik baru</div>
            </div>

            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
              <span class="text-xl">🏠</span>
              <div class="text-xs font-bold text-white mt-1">Listrik Baru (BPBL)</div>
              <div class="text-[10px] text-emerald-200/70">Warga prasejahtera</div>
            </div>

            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
              <span class="text-xl">⚡</span>
              <div class="text-xs font-bold text-white mt-1">Jaringan Listrik</div>
              <div class="text-[10px] text-emerald-200/70">Tiang & jangkauan PLN</div>
            </div>

            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs">
              <span class="text-xl">🔋</span>
              <div class="text-xs font-bold text-white mt-1">Kebutuhan Energi</div>
              <div class="text-[10px] text-emerald-200/70">Solar cell, gas & biogas</div>
            </div>

            <div class="p-3 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-xs col-span-2 sm:col-span-2">
              <span class="text-xl">⚠️</span>
              <div class="text-xs font-bold text-white mt-1">Masalah ESDM Lainnya</div>
              <div class="text-[10px] text-emerald-200/70">BBM, pertambangan galian, dan koordinasi instansi</div>
            </div>
          </div>
        </div>

        <div class="lg:col-span-5 flex flex-col items-center justify-center p-6 rounded-2xl bg-emerald-950/70 border border-emerald-400/30 text-center shadow-inner">
          <div class="w-16 h-16 rounded-3xl bg-gradient-to-tr from-amber-400 to-emerald-400 text-slate-900 flex items-center justify-center text-3xl font-black mb-3 shadow-lg shadow-emerald-500/20">
            📱
          </div>
          <h3 class="text-lg font-bold text-white">Akses Petugas Desa</h3>
          <p class="text-xs text-emerald-200/80 mt-1 max-w-xs leading-relaxed">
            Petugas admin desa dapat masuk dengan akun resmi desa untuk mulai mengisi formulir pelaporan ESDM.
          </p>

          <a 
            href="{{ route('login') }}" 
            class="mt-5 w-full py-3.5 px-6 rounded-2xl bg-gradient-to-r from-emerald-500 to-teal-400 hover:from-emerald-400 hover:to-teal-300 text-slate-950 font-bold text-sm shadow-md transition active:scale-95 flex items-center justify-center gap-2"
          >
            <span>Masuk ke Portal Desa</span>
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- ============== POTENSI (6 KATEGORI AGREGAT) ============== -->
<section id="potensi" class="section py-16 bg-slate-50">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto reveal-on-scroll">
      <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2">
        <span>Katalog Sumber Daya Alam</span>
      </div>
      <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
        Potensi Wilayah Kabupaten Jeneponto
      </h2>
      <p class="mt-2 text-sm sm:text-base text-slate-600 leading-relaxed">
        Rekapitulasi data agregat potensi sumber daya alam dari 113 desa dan kelurahan yang dihimpun secara berkala oleh Bagian SDA Setda Jeneponto.
      </p>
    </div>

    @php
      $nf = fn($v) => number_format((float)($v ?? 0), 2, ',', '.');
      $villCount = function($slug) use ($sectors) {
        $count = optional(($sectors ?? collect())->firstWhere('slug', $slug))->villages_count ?? 0;
        return number_format($count, 0, ',', '.');
      };
    @endphp

    <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
      <!-- 1. Pertanian -->
      <a href="{{ route('sectors.show','pertanian') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-xs">
                🌾
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-emerald-700 transition">Pertanian</h3>
                <span class="text-xs text-slate-400">Padi & Jagung</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
              {{ $villCount('pertanian') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Luas Sawah:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['pertanian']->luas_sawah_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Luas Jagung:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['pertanian']->luas_jagung_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Tadah Hujan:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['pertanian']->lahan_tadah_hujan_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Produksi/Tahun:</span>
              <span class="font-bold text-emerald-700">{{ $nf($totalsSda['pertanian']->produksi_ton ?? 0) }} Ton</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-emerald-700 group-hover:text-emerald-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      <!-- 2. Perkebunan -->
      <a href="{{ route('sectors.show','perkebunan') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-xs">
                🍃
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-amber-700 transition">Perkebunan</h3>
                <span class="text-xs text-slate-400">Kelapa & Kakao</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
              {{ $villCount('perkebunan') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Luas Areal:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['perkebunan']->luas_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Produksi Tahunan:</span>
              <span class="font-bold text-amber-700">{{ $nf($totalsSda['perkebunan']->produksi_tahunan ?? 0) }} Ton</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-amber-700 group-hover:text-amber-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      <!-- 3. Perikanan -->
      <a href="{{ route('sectors.show','perikanan') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-sky-50 text-sky-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-sky-600 group-hover:text-white transition-all shadow-xs">
                🐟
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-sky-700 transition">Perikanan</h3>
                <span class="text-xs text-slate-400">Tambak & Tangkap</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-sky-50 text-sky-700 border border-sky-200">
              {{ $villCount('perikanan') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Luas Tambak/Kolam:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['perikanan']->luas_tambak_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Produksi Tahunan:</span>
              <span class="font-bold text-sky-700">{{ $nf($totalsSda['perikanan']->produksi_ton ?? 0) }} Ton</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-sky-700 group-hover:text-sky-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      <!-- 4. Energi & EBT -->
      <a href="{{ route('sectors.show','energi') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-orange-50 text-orange-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-orange-600 group-hover:text-white transition-all shadow-xs">
                ⚡
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-orange-700 transition">Energi & EBT</h3>
                <span class="text-xs text-slate-400">Surya, Bayu & Air</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-orange-50 text-orange-700 border border-orange-200">
              {{ $villCount('energi') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Pembangkit Surya:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['energi']->surya_kwp ?? 0) }} kWp</span>
            </div>
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Energi Bayu/Angin:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['energi']->angin_kwp ?? 0) }} kWp</span>
            </div>
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Mikrohidro:</span>
              <span class="font-bold text-orange-700">{{ $nf($totalsSda['energi']->mikrohidro_kwp ?? 0) }} kWp</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-orange-700 group-hover:text-orange-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      <!-- 5. Pertambangan -->
      <a href="{{ route('sectors.show','pertambangan') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-cyan-50 text-cyan-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-cyan-600 group-hover:text-white transition-all shadow-xs">
                ⛏️
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-cyan-700 transition">Pertambangan</h3>
                <span class="text-xs text-slate-400">Galian Mineral C</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-cyan-50 text-cyan-700 border border-cyan-200">
              {{ $villCount('pertambangan') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Luas Wilayah Izin:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['pertambangan']->luas_ha ?? 0) }} Ha</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-cyan-700 group-hover:text-cyan-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>

      <!-- 6. Kehutanan -->
      <a href="{{ route('sectors.show','kehutanan') }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
        <div>
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <div class="flex items-center gap-3">
              <span class="w-12 h-12 rounded-2xl bg-lime-50 text-lime-700 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-lime-600 group-hover:text-white transition-all shadow-xs">
                🌳
              </span>
              <div>
                <h3 class="font-bold text-slate-800 text-base group-hover:text-lime-700 transition">Kehutanan</h3>
                <span class="text-xs text-slate-400">Konservasi & Mangrove</span>
              </div>
            </div>
            <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-lime-50 text-lime-700 border border-lime-200">
              {{ $villCount('kehutanan') }} desa
            </span>
          </div>

          <div class="mt-4 space-y-2 text-xs text-slate-600">
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Luas Hutan:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['kehutanan']->luas_hutan_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1 border-b border-slate-50">
              <span class="text-slate-500">Mangrove:</span>
              <span class="font-bold text-slate-800">{{ $nf($totalsSda['kehutanan']->luas_mangrove_ha ?? 0) }} Ha</span>
            </div>
            <div class="flex justify-between py-1">
              <span class="text-slate-500">Kawasan Konservasi:</span>
              <span class="font-bold text-lime-700">{{ $nf($totalsSda['kehutanan']->konservasi_ha ?? 0) }} Ha</span>
            </div>
          </div>
        </div>

        <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-lime-700 group-hover:text-lime-800">
          <span>Lihat Rincian Sektor</span>
          <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </div>
      </a>
    </div>
  </div>
</section>


<!-- ============== PENGUMUMAN & AGENDA ============== -->
<section id="pengumuman" class="section py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-100">
      <div>
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-800 text-xs font-bold uppercase tracking-wider mb-1.5 border border-amber-200/80">
          <span>Pemberitahuan Resmi</span>
        </div>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Pengumuman & Agenda Terkini</h3>
      </div>
      @if (Route::has('ann.index'))
        <a href="{{ route('ann.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
          <span>Lihat Semua Pengumuman</span>
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
        </a>
      @endif
    </div>

    <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @forelse(($announcements ?? []) as $a)
        <a href="{{ Route::has('ann.show') ? route('ann.show',$a) : '#' }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
          <div>
            <div class="flex items-center justify-between">
              <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                Pengumuman
              </span>
              <span class="text-xs text-slate-400 flex items-center gap-1 font-mono">
                <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                {{ optional($a->published_at)->format('d M Y') }}
              </span>
            </div>
            <h4 class="mt-3.5 font-bold text-slate-800 text-base group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
              {{ $a->title }}
            </h4>
            <p class="mt-2 text-xs text-slate-500 line-clamp-3 leading-relaxed">
              {{ $a->excerpt }}
            </p>
          </div>

          <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-emerald-700">
            <span>Baca Selengkapnya</span>
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </div>
        </a>
      @empty
        <div class="col-span-3 py-12 rounded-3xl border-2 border-dashed border-slate-200 text-center text-slate-400">
          <p class="text-sm">Belum ada pengumuman terbaru saat ini.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>


<!-- ============== BERITA & INFORMASI ============== -->
<section id="berita" class="section py-16 bg-gradient-to-b from-slate-50 to-slate-100">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-slate-200/80">
      <div>
        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-1.5">
          <span>Kabar Daerah</span>
        </div>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Berita & Informasi SDA</h3>
      </div>
      <a href="{{ route('news.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-700 hover:text-emerald-800 transition">
        <span>Lihat Semua Berita</span>
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
      </a>
    </div>

    <div class="mt-8 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($news->take(3) as $n)
        <a href="{{ route('news.show',$n) }}" class="card-interactive bg-white rounded-3xl p-6 border border-slate-200/80 shadow-xs flex flex-col justify-between group">
          <div>
            <div class="flex items-center justify-between">
              <span class="px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                {{ $n->category ?? 'Informasi' }}
              </span>
              <span class="text-xs text-slate-400 flex items-center gap-1 font-mono">
                <svg class="h-3.5 w-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                {{ optional($n->published_at)->format('d M Y') }}
              </span>
            </div>
            <h4 class="mt-3.5 font-bold text-slate-800 text-base group-hover:text-emerald-700 transition line-clamp-2 leading-snug">
              {{ $n->title }}
            </h4>
            <p class="mt-2 text-xs text-slate-500 line-clamp-3 leading-relaxed">
              {{ $n->excerpt }}
            </p>
          </div>

          <div class="mt-5 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-emerald-700">
            <span>Baca Artikel</span>
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>


<!-- ============== PETA KANTOR BUPATI JENEPONTO ============== -->
<section id="peta" class="section py-16 bg-white" x-data="bupatiMapHandler()">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Header Section --}}
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-6 mb-6">
      <div>
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 text-emerald-800 text-xs font-bold uppercase tracking-wider mb-2 border border-emerald-200">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
          <span>Titik Lokasi Kantor</span>
        </div>
        <h3 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
          Lokasi Kantor Bupati Jeneponto
        </h3>
        <p class="mt-1.5 text-xs sm:text-sm text-slate-500 max-w-2xl">
          Pusat Pemerintahan Kabupaten Jeneponto & Layanan Bagian Sumber Daya Alam (SDA) Sekretariat Daerah.
        </p>
      </div>

      {{-- Control Bar (Layer & Fullscreen) --}}
      <div class="flex items-center gap-2 flex-wrap">
        {{-- Google Maps Layer Switcher Pills --}}
        <div class="inline-flex items-center p-1 bg-slate-100 rounded-2xl border border-slate-200/80 shadow-2xs">
          <button 
            type="button" 
            @click="setBasemap('googleRoad')" 
            :class="currentBasemap === 'googleRoad' ? 'bg-white text-emerald-700 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 font-medium'"
            class="px-3 py-1.5 rounded-xl text-xs transition flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/></svg>
            Google Maps
          </button>
          <button 
            type="button" 
            @click="setBasemap('googleSatellite')" 
            :class="currentBasemap === 'googleSatellite' ? 'bg-white text-emerald-700 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 font-medium'"
            class="px-3 py-1.5 rounded-xl text-xs transition flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            Satelit Hybrid
          </button>
          <button 
            type="button" 
            @click="setBasemap('googleTerrain')" 
            :class="currentBasemap === 'googleTerrain' ? 'bg-white text-emerald-700 shadow-xs font-bold' : 'text-slate-600 hover:text-slate-900 font-medium'"
            class="px-3 py-1.5 rounded-xl text-xs transition flex items-center gap-1.5">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
            Medan / Topografi
          </button>
        </div>

        {{-- Focus Kantor Bupati --}}
        <button 
          type="button" 
          @click="focusKantor()" 
          title="Pusatkan ke Kantor Bupati"
          class="px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 text-xs font-semibold transition border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h1M4 12h1m11 6v1m-4-14a8 8 0 100 16 8 8 0 000-16zm0 4a4 4 0 100 8 4 4 0 000-8z"/></svg>
          Pusatkan
        </button>

        {{-- Geolocation --}}
        <button 
          type="button" 
          @click="locateMe()" 
          title="Lokasi Saya"
          class="p-2.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 transition border border-slate-200">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </button>

        {{-- Fullscreen --}}
        <button 
          type="button" 
          @click="toggleFullscreen()" 
          title="Layar Penuh"
          class="p-2.5 rounded-xl bg-slate-100 hover:bg-emerald-50 text-slate-600 hover:text-emerald-700 transition border border-slate-200">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"/></svg>
        </button>
      </div>
    </div>

    {{-- Map Wrapper with rounded corners and shadow --}}
    <div id="map-wrap" class="relative w-full overflow-hidden rounded-3xl border border-slate-200/90 shadow-lg bg-slate-100" style="height: 520px;">
      <div id="map" class="absolute inset-0 z-0"></div>
    </div>

    {{-- Info Card Under Map --}}
    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
        <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-800 flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
        </div>
        <div>
          <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Alamat Kantor</h4>
          <p class="text-sm font-semibold text-slate-800 mt-0.5">
            Jl. Lanto Daeng Pasewang No. 34, Kel. Empoang, Kec. Binamu, Kabupaten Jeneponto
          </p>
        </div>
      </div>

      <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-start gap-3.5">
        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-800 flex items-center justify-center flex-shrink-0">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
          <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Jam Pelayanan</h4>
          <p class="text-sm font-semibold text-slate-800 mt-0.5">
            Senin – Jumat : 08.00 – 16.00 WITA<br>
            <span class="text-xs text-slate-500 font-normal">Bagian Sumber Daya Alam Setda</span>
          </p>
        </div>
      </div>

      <div class="p-5 rounded-2xl bg-slate-50 border border-slate-200/80 flex items-center justify-between gap-3.5">
        <div class="flex items-center gap-3.5">
          <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
          </div>
          <div>
            <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider">Navigasi Langsung</h4>
            <span class="text-xs text-slate-500 font-mono">
    -5.6771, 119.7494
</span>
          </div>
        </div>
        <a
    href="https://www.google.com/maps/dir/?api=1&destination=-5.6771234,119.7493776"
    target="_blank"
    rel="noopener noreferrer"
    class="px-3.5 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-bold transition flex items-center gap-1.5 shadow-xs whitespace-nowrap"
>
    Buka Rute
</a>
      </div>
    </div>

  </div>
</section>

@endsection

{{-- ==== Build slides di PHP ==== --}}
@php
  $__slides = collect($sliders ?? [])->map(function ($s) {
      return [
          'image'    => $s->image_url,
          'title'    => $s->title,
          'subtitle' => $s->subtitle,
      ];
  })->values();
@endphp

@push('scripts')
  {{-- Leaflet JS --}}
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

  <script>
    // --- HERO SLIDER ---
    function heroSlider() {
      return {
        slides: @json($__slides),
        active: 0,
        timer: null,
        interval: 6000,
        init() {
          if (this.slides.length > 0) this.play();
        },
        play() {
          this.stop();
          this.timer = setInterval(() => this.next(), this.interval);
        },
        pause() {
          this.stop();
        },
        stop() {
          if (this.timer) clearInterval(this.timer);
        },
        next() {
          this.active = (this.active + 1) % this.slides.length;
        },
        prev() {
          this.active = (this.active - 1 + this.slides.length) % this.slides.length;
        },
        go(i) {
          this.active = i;
        }
      }
    }

    // --- GEOSPATIAL GOOGLE MAPS HANDLER (SINGLE POINT: KANTOR BUPATI JENEPONTO) ---
    function bupatiMapHandler() {
      return {
        currentBasemap: 'googleRoad',
        map: null,
        tileLayers: {},
        marker: null,

        // Koordinat Kantor Bupati Jeneponto
        // Koordinat Kantor Bupati Jeneponto — lokasi baru
bupatiLocation: {
    name: 'Kantor Bupati Jeneponto',
    institution: 'Bagian Sumber Daya Alam (SDA) Sekretariat Daerah',
    address: 'Kantor Bupati Jeneponto, Kabupaten Jeneponto, Sulawesi Selatan',
    lat: -5.6771234,
    lng: 119.7493776
},

        init() {
          setTimeout(() => {
            this.initLeaflet();
          }, 150);
        },

        initLeaflet() {
          const container = document.getElementById('map');
          if (!container || typeof L === 'undefined') return;

          if (this.map) {
            try { this.map.remove(); } catch (e) {}
            this.map = null;
          }

          // Inisialisasi Peta Google Maps terpusat di Kantor Bupati Jeneponto (Zoom 16)
          this.map = L.map('map', {
            center: [this.bupatiLocation.lat, this.bupatiLocation.lng],
            zoom: 16,
            zoomControl: true,
            scrollWheelZoom: true
          });

          // Layer Google Maps Resmi
          this.tileLayers.googleRoad = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0','mt1','mt2','mt3'],
            attribution: '&copy; Google Maps'
          });

          this.tileLayers.googleSatellite = L.tileLayer('https://{s}.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0','mt1','mt2','mt3'],
            attribution: '&copy; Google Maps'
          });

          this.tileLayers.googleTerrain = L.tileLayer('https://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0','mt1','mt2','mt3'],
            attribution: '&copy; Google Maps'
          });

          // Default mode: Google Maps Jalan
          this.tileLayers.googleRoad.addTo(this.map);

          // Buat Marker Khusus Landmark Kantor Bupati Jeneponto
          const customIcon = L.divIcon({
            className: 'custom-leaflet-marker-wrap',
            html: `
              <div class="custom-leaflet-pin" style="position:relative; width:44px; height:44px;">
                <div class="pin-halo" style="background-color: #059669; width:52px; height:52px;"></div>
                <div style="background: linear-gradient(135deg, #065f46 0%, #047857 100%); width:40px; height:40px; border-radius:12px; display:flex; align-items:center; justify-content:center; box-shadow:0 6px 15px rgba(0,0,0,0.3); border: 2.5px solid #ffffff; transform: rotate(-45deg);">
                  <span style="transform: rotate(45deg); font-size: 18px; line-height: 1;">🏛️</span>
                </div>
              </div>
            `,
            iconSize: [44, 44],
            iconAnchor: [22, 22],
            popupAnchor: [0, -22]
          });

          const popupHtml = `
            <div class="p-4 font-sans max-w-xs">
              <div class="flex items-center gap-1.5 mb-2">
                <span class="inline-block px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 text-emerald-800 border border-emerald-200">
                  Pusat Pemerintahan
                </span>
                <span class="text-[11px] text-slate-500 font-semibold bg-slate-100 px-2 py-0.5 rounded-md">
                  Kec. Binamu
                </span>
              </div>
              <h4 class="font-extrabold text-slate-900 text-sm mb-1 leading-snug">
                Kantor Bupati Jeneponto
              </h4>
              <p class="text-xs font-semibold text-emerald-700 mb-1.5">
                Bagian Sumber Daya Alam (SDA) Setda
              </p>
              <p class="text-xs text-slate-600 leading-relaxed mb-3">
                Jl. Lanto Daeng Pasewang No. 34, Empoang, Kec. Binamu, Jeneponto.
              </p>
              <div class="pt-2.5 border-t border-slate-100 flex items-center justify-between text-[11px]">
                <span class="text-slate-400 font-mono text-[10px]">
    -5.6771, 119.7494
</span>
                <a
    href="https://www.google.com/maps/dir/?api=1&destination=-5.6771234,119.7493776"
    target="_blank"
    rel="noopener noreferrer"
    class="text-emerald-700 hover:text-emerald-800 font-bold inline-flex items-center gap-1 bg-emerald-50 px-2.5 py-1 rounded-lg border border-emerald-200"
>
    Petunjuk Arah
</a>
              </div>
            </div>
          `;

          this.marker = L.marker([this.bupatiLocation.lat, this.bupatiLocation.lng], { icon: customIcon })
            .bindPopup(popupHtml)
            .addTo(this.map);

          // Buka popup otomatis
          setTimeout(() => {
            if (this.marker) this.marker.openPopup();
          }, 400);

          // Responsif resize
          setTimeout(() => {
            if (this.map) this.map.invalidateSize();
          }, 300);

          window.addEventListener('resize', () => {
            if (this.map) this.map.invalidateSize();
          });
        },

        setBasemap(type) {
          if (!this.map || !this.tileLayers[type]) return;
          this.currentBasemap = type;
          Object.values(this.tileLayers).forEach(layer => {
            if (this.map.hasLayer(layer)) {
              this.map.removeLayer(layer);
            }
          });
          this.tileLayers[type].addTo(this.map);
        },

        focusKantor() {
          if (!this.map) return;
          this.map.flyTo([this.bupatiLocation.lat, this.bupatiLocation.lng], 16, {
            animate: true,
            duration: 1.0
          });
          if (this.marker) {
            setTimeout(() => this.marker.openPopup(), 1000);
          }
        },

        locateMe() {
          if (!navigator.geolocation || !this.map) {
            alert('Geolocator tidak didukung oleh browser Anda.');
            return;
          }
          navigator.geolocation.getCurrentPosition(
            pos => {
              const lat = pos.coords.latitude;
              const lng = pos.coords.longitude;
              this.map.flyTo([lat, lng], 15, { animate: true, duration: 1.2 });
              L.popup()
                .setLatLng([lat, lng])
                .setContent('<div class="p-2 text-xs font-bold text-slate-800">📍 Lokasi Anda Saat Ini</div>')
                .openOn(this.map);
            },
            err => {
              alert('Gagal mengambil lokasi: ' + err.message);
            }
          );
        },

        toggleFullscreen() {
          const wrap = document.getElementById('map-wrap');
          if (!wrap) return;
          if (!document.fullscreenElement) {
            wrap.requestFullscreen().catch(() => {});
          } else {
            document.exitFullscreen().catch(() => {});
          }
          setTimeout(() => {
            if (this.map) this.map.invalidateSize();
          }, 200);
        }
      }
    }

    // --- SCROLL REVEAL OBSERVER ---
    document.addEventListener('DOMContentLoaded', () => {
      const reveals = document.querySelectorAll('.reveal-on-scroll');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-revealed');
          }
        });
      }, { threshold: 0.15 });

      reveals.forEach(el => observer.observe(el));
    });
  </script>
@endpush
