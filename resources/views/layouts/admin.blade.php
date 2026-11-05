<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link rel="icon" type="image/png"  href="{{ asset('images/jepot.png') }}">
  <title>@yield('title','Admin Panel')</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" defer></script>
</head>
<body class="bg-slate-50 text-slate-800">
  <div class="min-h-screen grid grid-cols-1 lg:grid-cols-[280px_1fr]">

    {{-- Sidebar --}}
    <aside class="lg:h-screen lg:sticky lg:top-0 bg-gradient-to-b from-emerald-700 to-emerald-900 text-emerald-50">
      <div class="px-5 py-4 flex items-center gap-3 border-b border-white/10">
        <div class="h-10 w-10 rounded-xl overflow-hidden">
            <img src="{{ asset('images/jepot.png') }}" alt="Logo" class="h-full w-full object-cover">
        </div>
        <div>
          <div class="font-semibold">Admin Panel</div>
          <div class="text-xs text-emerald-100/80">DAENG SUDA</div>
        </div>
      </div>

      <nav class="px-3 py-4 space-y-1 text-emerald-50">
        <x-admin.nav-item :active="request()->routeIs('admin.dashboard')" href="{{ route('admin.dashboard') }}" icon="home">Dashboard</x-admin.nav-item>
        
       {{-- Profil Section --}}
<div class="px-3 pt-4 pb-2 text-xs uppercase tracking-wider text-emerald-100/70">Profil</div>
<x-admin.nav-item :active="request()->routeIs('admin.leaders.index')" href="{{ route('admin.leaders.index') }}" icon="user-circle">
  Kepala Daerah
</x-admin.nav-item>
<x-admin.nav-item :active="request()->routeIs('admin.employees.index')" href="{{ route('admin.employees.index') }}" icon="users">
  Struktur Organisasi
</x-admin.nav-item>

        {{-- Konten Section --}}
<div class="px-3 pt-4 pb-2 text-xs uppercase tracking-wider text-emerald-100/70">Konten</div>

<x-admin.nav-item :active="request()->routeIs('admin.sliders.*')" href="{{ route('admin.sliders.index') }}" icon="photograph">
  Sliders
</x-admin.nav-item>

<x-admin.nav-item :active="request()->routeIs('admin.sectors.*')" href="{{ route('admin.sectors.index') }}" icon="building">
  Sektor
</x-admin.nav-item>

<x-admin.nav-item :active="request()->routeIs('admin.dinas-sectors.*')" href="{{ route('admin.dinas-sectors.index') }}" icon="building">
  Sektor Dinas
</x-admin.nav-item>

<x-admin.nav-item :active="request()->routeIs('admin.news.*')" href="{{ route('admin.news.index') }}" icon="newspaper">
  Berita
</x-admin.nav-item>

{{-- 🔔 Pengumuman (baru) --}}
<x-admin.nav-item :active="request()->routeIs('admin.announcements.*')" href="{{ route('admin.announcements.index') }}" icon="speakerphone">
  Pengumuman
</x-admin.nav-item>

{{-- ESDM Module --}}
<div class="px-3 pt-4 pb-2 text-xs uppercase tracking-wider text-emerald-100/70">ESDM</div>
<x-admin.nav-item :active="request()->routeIs('esdm.admin.dashboard')" href="{{ route('esdm.admin.dashboard') }}" icon="lightning-bolt">
  Dashboard ESDM
</x-admin.nav-item>
<x-admin.nav-item :active="request()->routeIs('esdm.admin.report.*')" href="{{ route('esdm.admin.report.index') }}" icon="document-text">
  Laporan ESDM
</x-admin.nav-item>
<x-admin.nav-item :active="request()->routeIs('esdm.admin.desa-accounts.*')" href="{{ route('esdm.admin.desa-accounts.index') }}" icon="users">
  Akun Admin Desa
</x-admin.nav-item>

@if (Route::has('admin.potentials.index'))
  <x-admin.nav-item :active="request()->routeIs('admin.potentials.*')" href="{{ route('admin.potentials.index') }}" icon="map">
    Potensi
  </x-admin.nav-item>
@endif


        <div class="mt-6 border-t border-white/10 pt-4 px-3">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-white/10 hover:bg-white/15 px-3 py-2">
              {{-- icon logout --}}
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"><path d="M15 12H3m12 0-3-3m3 3-3 3M21 3v18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              Keluar
            </button>
          </form>
        </div>
      </nav>
    </aside>

    {{-- Main --}}
    <div class="min-h-screen flex flex-col">
      {{-- Topbar --}}
      <header class="bg-white/80 backdrop-blur border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
          <div>
            <h1 class="text-xl font-semibold">@yield('pageTitle','Dashboard')</h1>
            @hasSection('pageSub')
              <p class="text-sm text-slate-500">@yield('pageSub')</p>
            @endif
          </div>
          <div class="flex items-center gap-3">
            <div class="text-right">
              <div class="text-sm font-medium">{{ auth()->user()->name }}</div>
              <div class="text-xs text-slate-500">Administrator</div>
            </div>
            <div class="h-10 w-10 rounded-full bg-emerald-600 text-white grid place-content-center font-semibold">
              {{ strtoupper(mb_substr(auth()->user()->name,0,1)) }}
            </div>
          </div>
        </div>
      </header>

      {{-- Content --}}
      <main class="max-w-7xl mx-auto w-full px-4 py-6">
        
        {{-- ========================================================== --}}
        {{-- ============ BLOK NOTIFIKASI DITAMBAHKAN DI SINI ========== --}}
        {{-- ========================================================== --}}
        @if (session('ok'))
            <div id="alert-message" class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-800 p-4 mb-6 rounded-r-lg shadow-md relative" role="alert">
                <div class="flex items-center">
                    <div class="py-1">
                        <svg class="w-6 h-6 text-emerald-500 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-bold">Berhasil</p>
                        <p class="text-sm">{{ session('ok') }}</p>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
      </main>

      <footer class="text-center text-xs text-slate-500 py-6">
        © {{ date('Y') }} DAENG SUDA Jeneponto.
      </footer>
    </div>
  </div>
</body>
</html>
