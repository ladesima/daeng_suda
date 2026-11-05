{{-- resources/views/front/intro.blade.php --}}
<!doctype html>
<html lang="id" class="h-full">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <title>DAENG SUDA — Sistem Informasi Digital SDA Kabupaten Jeneponto</title>
  <link rel="icon" type="image/png" href="{{ asset('images/jepot.png') }}">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    /* Smooth Aurora Background */
    @keyframes aurora {
      0% { transform: translate(0, 0) scale(1) rotate(0deg); }
      33% { transform: translate(30px, -50px) scale(1.1) rotate(120deg); }
      66% { transform: translate(-20px, 20px) scale(0.95) rotate(240deg); }
      100% { transform: translate(0, 0) scale(1) rotate(360deg); }
    }
    .animate-aurora-1 {
      animation: aurora 22s infinite ease-in-out alternate;
    }
    .animate-aurora-2 {
      animation: aurora 28s infinite ease-in-out alternate-reverse;
    }
    .animate-aurora-3 {
      animation: aurora 35s infinite ease-in-out alternate;
    }

    /* Floating particles */
    @keyframes floatParticle {
      0%, 100% { transform: translateY(0px) translateX(0px); opacity: 0.3; }
      50% { transform: translateY(-30px) translateX(15px); opacity: 0.8; }
    }
    .particle {
      position: absolute;
      border-radius: 50%;
      pointer-events: none;
      animation: floatParticle 8s infinite ease-in-out;
    }

    /* Shimmer gradient on button */
    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }
    .shimmer-btn {
      background: linear-gradient(90deg, #059669 0%, #10b981 25%, #34d399 50%, #10b981 75%, #059669 100%);
      background-size: 200% auto;
      animation: shimmer 4s linear infinite;
    }

    /* Stagger fade in */
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(24px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-1 { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    .animate-fade-2 { animation: fadeInUp 0.8s 0.2s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .animate-fade-3 { animation: fadeInUp 0.8s 0.35s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .animate-fade-4 { animation: fadeInUp 0.8s 0.5s cubic-bezier(0.16, 1, 0.3, 1) both; }
    .animate-fade-5 { animation: fadeInUp 0.8s 0.65s cubic-bezier(0.16, 1, 0.3, 1) both; }

    /* Pulse Glow */
    @keyframes pulseGlow {
      0%, 100% { transform: scale(1); opacity: 0.4; }
      50% { transform: scale(1.15); opacity: 0.7; }
    }
    .pulse-glow {
      animation: pulseGlow 4s infinite ease-in-out;
    }
  </style>
</head>
<body 
  class="h-full bg-slate-950 text-white flex flex-col justify-between overflow-x-hidden relative selection:bg-emerald-500 selection:text-white"
  x-data="{
    timer: 8,
    paused: false,
    interval: null,
    mouseX: 0,
    mouseY: 0,
    handleMouseMove(e) {
      const rect = e.currentTarget.getBoundingClientRect();
      this.mouseX = (e.clientX - rect.left - rect.width / 2) / 35;
      this.mouseY = (e.clientY - rect.top - rect.height / 2) / 35;
    },
    resetTilt() {
      this.mouseX = 0;
      this.mouseY = 0;
    },
    init() {
      this.interval = setInterval(() => {
        if (!this.paused && this.timer > 0) {
          this.timer -= 1;
          if (this.timer <= 0) {
            window.location.href = '{{ route('home') }}';
          }
        }
      }, 1000);
    }
  }"
  @mousemove="handleMouseMove($event)"
  @mouseleave="resetTilt()"
>
  {{-- AURORA BACKGROUND GLOWS --}}
  <div class="fixed inset-0 pointer-events-none overflow-hidden z-0">
    {{-- Orb 1 - Emerald --}}
    <div class="absolute -top-[10%] -left-[10%] w-[55vw] h-[55vw] rounded-full bg-emerald-600/25 blur-[120px] animate-aurora-1"></div>
    {{-- Orb 2 - Teal --}}
    <div class="absolute top-[30%] -right-[15%] w-[50vw] h-[50vw] rounded-full bg-teal-500/20 blur-[130px] animate-aurora-2"></div>
    {{-- Orb 3 - Amber / Gold --}}
    <div class="absolute -bottom-[20%] left-[20%] w-[45vw] h-[45vw] rounded-full bg-amber-500/15 blur-[140px] animate-aurora-3"></div>
    {{-- Grid overlay --}}
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_50%,#000_70%,transparent_100%)]"></div>
  </div>

  {{-- FLOATING PARTICLES --}}
  <div class="fixed inset-0 pointer-events-none z-0">
    <div class="particle bg-emerald-400 w-2 h-2 top-[20%] left-[15%] blur-[1px]" style="animation-delay: 0s;"></div>
    <div class="particle bg-teal-300 w-3 h-3 top-[35%] right-[20%] blur-[1px]" style="animation-delay: 2s;"></div>
    <div class="particle bg-amber-300 w-2.5 h-2.5 bottom-[30%] left-[25%] blur-[1px]" style="animation-delay: 4s;"></div>
    <div class="particle bg-emerald-200 w-2 h-2 top-[70%] right-[30%] blur-[1px]" style="animation-delay: 1s;"></div>
    <div class="particle bg-cyan-300 w-1.5 h-1.5 top-[15%] right-[40%] blur-[1px]" style="animation-delay: 3s;"></div>
  </div>

  {{-- TOP BAR --}}
  <header class="relative z-10 w-full max-w-6xl mx-auto px-6 pt-6 flex items-center justify-between animate-fade-1">
    <div class="flex items-center gap-2.5">
      <div class="w-8 h-8 rounded-xl bg-white/10 p-1 flex items-center justify-center ring-1 ring-white/20 backdrop-blur-md">
        <img src="{{ asset('images/jepot.png') }}" alt="Logo Jeneponto" class="h-full w-full object-contain">
      </div>
      <span class="font-bold text-xs sm:text-sm tracking-wider uppercase text-emerald-300/90">Pemerintah Kab. Jeneponto</span>
    </div>

    <div class="flex items-center gap-3">
      <a 
        href="{{ route('login') }}" 
        class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-xs font-medium text-emerald-200 bg-white/5 hover:bg-white/10 ring-1 ring-white/10 transition active:scale-95 backdrop-blur-md"
      >
        <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
        <span>Portal Login</span>
      </a>

      <button 
        type="button"
        @click="paused = !paused" 
        class="px-2.5 py-1 rounded-full text-[11px] font-mono text-slate-400 hover:text-white bg-black/30 ring-1 ring-white/10 transition"
        :title="paused ? 'Klik untuk aktifkan auto-redirect' : 'Klik untuk jeda auto-redirect'"
      >
        <span x-show="!paused">Auto: <span x-text="timer" class="text-emerald-400 font-bold"></span>s</span>
        <span x-show="paused" class="text-amber-400 font-bold">Dijeda ⏸</span>
      </button>
    </div>
  </header>

  {{-- MAIN HERO INTERACTION --}}
  <main class="relative z-10 flex-1 flex flex-col items-center justify-center px-4 sm:px-6 py-8">
    <div 
      class="max-w-2xl w-full text-center transition-transform duration-200 ease-out"
      :style="`transform: perspective(1000px) rotateY(${mouseX}deg) rotateX(${-mouseY}deg);`"
    >
      {{-- Glowing Emblem Container --}}
      <div class="relative inline-block mb-6 animate-fade-1">
        {{-- Multi-layered Ambient Rings --}}
        <div class="absolute -inset-4 rounded-3xl bg-emerald-500/20 blur-xl pulse-glow"></div>
        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-emerald-500 to-teal-400 opacity-60 blur-sm"></div>

        <div class="relative w-28 h-28 sm:w-32 sm:h-32 rounded-3xl bg-slate-900/90 border border-white/20 p-4 shadow-2xl flex items-center justify-center backdrop-blur-md">
          <img 
            src="{{ asset('images/jepot.png') }}" 
            alt="Logo DAENG SUDA" 
            class="w-full h-full object-contain filter drop-shadow-[0_10px_20px_rgba(16,185,129,0.3)] hover:scale-105 transition-transform duration-300"
          >
        </div>
      </div>

      {{-- Badges --}}
      <div class="animate-fade-2 flex items-center justify-center gap-2 mb-3">
        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-500/15 border border-emerald-400/30 text-emerald-300 text-xs font-semibold backdrop-blur-md">
          <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
          Sistem Informasi SDA Terpadu
        </span>
      </div>

      {{-- Main Title --}}
      <h1 class="animate-fade-3 text-4xl sm:text-6xl font-black tracking-tight text-white leading-none">
        DAENG <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 via-teal-300 to-amber-300">SUDA</span>
      </h1>

      {{-- Tagline --}}
      <p class="animate-fade-3 text-base sm:text-xl font-medium text-emerald-100/90 mt-2">
        Data Elektronik Digital Sumber Daya Alam
      </p>

      <p class="animate-fade-4 text-xs sm:text-sm text-slate-400 max-w-lg mx-auto mt-3 leading-relaxed">
        Sekretariat Daerah Bagian Sumber Daya Alam Kabupaten Jeneponto. Pusat penghimpunan potensi, monitoring ESDM desa, dan tata kelola berbasis digital.
      </p>

      {{-- 4 Interactive Pillars --}}
      <div class="animate-fade-4 mt-6 grid grid-cols-2 sm:grid-cols-4 gap-2.5 max-w-xl mx-auto text-left">
        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 backdrop-blur-md hover:bg-white/[0.08] hover:border-emerald-400/40 transition group">
          <div class="text-xl">🌾</div>
          <div class="text-xs font-bold text-white mt-1 group-hover:text-emerald-300 transition">8 Sektor SDA</div>
          <div class="text-[10px] text-slate-400">Pertanian & Potensi</div>
        </div>

        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 backdrop-blur-md hover:bg-white/[0.08] hover:border-amber-400/40 transition group">
          <div class="text-xl">⚡</div>
          <div class="text-xs font-bold text-white mt-1 group-hover:text-amber-300 transition">Modul ESDM</div>
          <div class="text-[10px] text-slate-400">PJU, BPBL & Jaringan</div>
        </div>

        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 backdrop-blur-md hover:bg-white/[0.08] hover:border-teal-400/40 transition group">
          <div class="text-xl">🗺️</div>
          <div class="text-xs font-bold text-white mt-1 group-hover:text-teal-300 transition">113 Desa/Kel</div>
          <div class="text-[10px] text-slate-400">11 Kecamatan</div>
        </div>

        <div class="p-3 rounded-2xl bg-white/[0.04] border border-white/10 backdrop-blur-md hover:bg-white/[0.08] hover:border-indigo-400/40 transition group">
          <div class="text-xl">📊</div>
          <div class="text-xs font-bold text-white mt-1 group-hover:text-indigo-300 transition">Monitoring</div>
          <div class="text-[10px] text-slate-400">Dashboard Realtime</div>
        </div>
      </div>

      {{-- Action Buttons CTA --}}
      <div class="animate-fade-5 mt-8 flex flex-col sm:flex-row items-center justify-center gap-3.5">
        <a 
          href="{{ route('home') }}" 
          class="w-full sm:w-auto inline-flex items-center justify-center gap-2.5 px-8 py-3.5 rounded-2xl text-white font-bold text-sm shimmer-btn shadow-lg shadow-emerald-600/30 hover:shadow-emerald-500/50 hover:scale-[1.02] active:scale-95 transition-all"
        >
          <span>Masuk ke Beranda Publik</span>
          <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <line x1="5" y1="12" x2="19" y2="12"></line>
            <polyline points="12 5 19 12 12 19"></polyline>
          </svg>
        </a>

        <a 
          href="{{ route('login') }}" 
          class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-white/10 hover:bg-white/15 text-slate-200 hover:text-white font-semibold text-sm border border-white/15 backdrop-blur-md hover:scale-[1.02] active:scale-95 transition-all"
        >
          <svg class="w-4 h-4 text-emerald-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
          </svg>
          <span>Login Petugas Desa / SDA</span>
        </a>
      </div>
    </div>
  </main>

  {{-- BOTTOM FOOTER & PROGRESS BAR --}}
  <footer class="relative z-10 w-full max-w-6xl mx-auto px-6 pb-6 text-center">
    {{-- Progress bar indicating auto-redirect --}}
    <div class="w-48 h-1 bg-white/10 rounded-full mx-auto overflow-hidden mb-3">
      <div 
        class="h-full bg-emerald-400 transition-all duration-1000 ease-linear rounded-full"
        :style="`width: ${((8 - timer) / 8) * 100}%`"
      ></div>
    </div>

    <div class="text-[11px] text-slate-500 flex items-center justify-center gap-4 flex-wrap">
      <span>© {{ date('Y') }} Bagian SDA Setda Kabupaten Jeneponto</span>
      <span>•</span>
      <a href="{{ route('home') }}" class="text-emerald-400/80 hover:text-emerald-300 transition">Lewati Intro →</a>
    </div>
  </footer>
</body>
</html>
