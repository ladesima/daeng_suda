<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>{{ config('app.name') }} — @yield('title','') </title>
  <link rel="icon" type="image/png"  href="{{ asset('images/jepot.png') }}">

  @vite(['resources/css/app.css','resources/js/app.js'])
  @stack('styles')
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>

  <style>
    html { scroll-behavior: smooth; }
    .section { scroll-margin-top: 80px; } /* header sticky offset */
    [x-cloak] { display: none !important; } /* sembunyikan dropdown sebelum Alpine siap */
  </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased">
  @php $onHome = request()->routeIs('home'); @endphp
<script src="https://unpkg.com/htmx.org@1.9.12"></script>

  <!-- NAVBAR -->
  <header class="sticky top-0 z-40 border-b border-emerald-900/10 bg-white/80 backdrop-blur">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
      {{-- BRAND --}}
      <a href="{{ $onHome ? '#beranda' : route('home').'#beranda' }}" class="flex items-center gap-3">
        <img src="{{ asset('images/jepot.png') }}" alt="Logo DAENG SUDA" class="h-9 w-9 rounded-lg object-cover">
        <span class="leading-tight">
          <span class="block font-semibold text-slate-900">DAENG SUDA</span>
          <span class="block text-xs text-slate-500">Data Elektronik Digital SDA</span>
        </span>
      </a>

      {{-- MENU --}}
      <nav class="hidden md:flex items-center gap-2" x-data>
        <a href="{{ $onHome ? '#beranda' : route('home').'#beranda' }}" class="nav-pill {{ $onHome ? 'nav-pill-active' : '' }}">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M3 10.5l9-7 9 7M9 21V12h6v9" stroke-linecap="round" stroke-linejoin="round"/></svg>
          <span>Beranda</span>
        </a>
        <a href="{{ route('sectors.all') }}" class="nav-pill">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 16c6 0 10-4 10-10 3 0 6 3 6 6a10 10 0 11-16 4z"/></svg>
          <span>Sektor</span>
        </a>
        <a href="{{ $onHome ? '#berita' : route('home').'#berita' }}" class="nav-pill">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 6h16M4 10h16M4 14h10M4 18h8"/></svg>
          <span>Berita</span>
        </a>
        <a href="{{ $onHome ? '#peta' : route('home').'#peta' }}" class="nav-pill">
          <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M9 18l-6 3V6l6-3 6 3 6-3v15l-6 3-6-3z"/><path d="M9 3v15M15 6v15"/></svg>
          <span>Peta</span>
        </a>

        {{-- PROFIL (Dropdown) --}}
        <div x-data="{ open:false }" class="relative" @keydown.escape.window="open=false">
          <button type="button"
                  @click="open = !open"
                  class="nav-pill {{ request()->routeIs('profile.show') || request()->routeIs('structure.show') ? 'nav-pill-active' : '' }}"
                  aria-haspopup="true" :aria-expanded="open">
            <svg class="nav-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path d="M21 15v4a2 2 0 0 1-2 2h-3l-4-3H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v6" stroke-linecap="round" stroke-linejoin="round"/>
              <circle cx="12" cy="10" r="3"/>
            </svg>
            <span>Profil</span>
            <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M5.23 7.21a.75.75 0 011.06.02L10 11.17l3.71-3.94a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"/></svg>
          </button>

          <div x-cloak x-show="open" x-transition.origin.top.right
               @click.outside="open=false"
               class="absolute right-0 mt-2 w-56 rounded-xl border border-slate-200 bg-white shadow-lg z-50"
               role="menu">
            <a href="{{ route('profile.show') }}"
               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
               role="menuitem">
              <span class="inline-flex h-6 w-6 items-center justify-center rounded-md bg-emerald-100 text-emerald-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><circle cx="12" cy="8" r="4"/><path d="M6 20a6 6 0 0 1 12 0"/></svg>
              </span>
              <span>Profil</span>
            </a>
            <a href="{{ route('structure.show') }}"
               class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50"
               role="menuitem">
              <span class="inline-flex h-6 w-6 items-center justify-center rounded-md bg-sky-100 text-sky-700">
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M6 20V8h12v12M10 8V4h4v4M12 12v4"/></svg>
              </span>
              <span>Struktur Organisasi</span>
            </a>
          </div>
        </div>
      </nav>

      {{-- RIGHT --}}
      <div class="hidden md:block">
        <a href="{{ route('login') }}" class="btn-outline">
          <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
            <path d="M10 17l5-5-5-5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M15 12H3" stroke-linecap="round"/>
          </svg>
          <span>Masuk</span>
        </a>
      </div>
    </div>
  </header>

  <main>
    @yield('content')
  </main>

  <!-- FOOTER -->
  <footer class="mt-16 bg-emerald-800 text-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
      <div class="grid md:grid-cols-3 gap-8">
        <div>
          <div class="flex items-center gap-2 font-semibold">
            <img src="{{ asset('images/jepot.png') }}" alt="Logo DS" class="h-8 w-8 rounded object-cover bg-white">
            <span>DAENG SUDA Jeneponto</span>
          </div>
          <p class="mt-3 text-sm text-slate-200">
            Platform pengelolaan & monitoring data SDA Kab. Jeneponto untuk mendukung pembangunan berkelanjutan.
          </p>
        </div>
        <div>
          <div class="font-semibold text-white">Navigasi</div>
          <ul class="mt-3 space-y-1 text-sm">
            <li><a class="footer-link" href="{{ $onHome ? '#beranda' : route('home').'#beranda' }}">Beranda</a></li>
            <li><a class="footer-link" href="{{ $onHome ? '#potensi' : route('home').'#potensi' }}">Potensi</a></li>
            <li><a class="footer-link" href="{{ $onHome ? '#berita' : route('home').'#berita' }}">Berita</a></li>
            <li><a class="footer-link" href="{{ $onHome ? '#peta' : route('home').'#peta' }}">Peta</a></li>
            <li><a class="footer-link" href="{{ route('profile.show') }}">Profil</a></li>
            <li><a class="footer-link" href="{{ route('structure.show') }}">Struktur Organisasi</a></li>
          </ul>
        </div>
        <div>
          <div class="font-semibold text-white">Kontak</div>
          <ul class="mt-3 space-y-1 text-sm text-slate-200">
            <li>Kabupaten Jeneponto</li>
            <li>Sulawesi Selatan, Indonesia</li>
            <li>Email: info@jeneponto.go.id</li>
          </ul>
        </div>
      </div>
      <div class="mt-8 border-t border-emerald-700 pt-6 text-xs text-slate-300">
        © {{ date('Y') }} DAENG SUDA Jeneponto. Semua hak dilindungi.
      </div>
    </div>
  </footer>

  <script src="//unpkg.com/alpinejs" defer></script>

  {{-- Intersep anchor di homepage supaya tidak reload (tetap scroll halus) --}}
  <script>
    (function () {
      const homePath = "{{ parse_url(route('home'), PHP_URL_PATH) }}";
      document.addEventListener('click', (e) => {
        const a = e.target.closest('a[href^="#"], a[href^="{{ route('home') }}#"]');
        if (!a) return;

        const href = a.getAttribute('href');
        const isHomeNow = window.location.pathname === homePath;

        let hash = null;
        if (href.startsWith('#')) hash = href; else {
          const idx = href.indexOf('#'); if (idx !== -1) hash = href.substring(idx);
        }
        if (!hash) return;

        const target = document.querySelector(hash);
        if (!target) return;

        if (isHomeNow && href.startsWith('#')) {
          e.preventDefault();
          target.scrollIntoView({ behavior: 'smooth', block: 'start' });
          history.replaceState(null, '', hash);
        }
      });

      window.addEventListener('load', () => {
        if (location.hash && document.querySelector(location.hash)) {
          document.querySelector(location.hash).scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
      });
    })();
  </script>

  @stack('scripts')
</body>
</html>
