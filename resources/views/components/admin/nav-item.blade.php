@props(['href' => '#', 'icon' => null, 'active' => false])

<a href="{{ $href }}"
   {{ $attributes->merge([
     'class' =>
       'flex items-center gap-3 rounded-xl px-3 py-2 mx-2 '.
       ($active ? 'bg-white/15 shadow-[inset_0_0_0_1px_rgba(255,255,255,.2)]' : 'hover:bg-white/10')
   ]) }}>

  {{-- Ikon --}}
  @if($icon === 'home')
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
      <path d="M3 9.5 12 3l9 6.5V21a1 1 0 0 1-1 1h-5v-7H9v7H4a1 1 0 0 1-1-1V9.5Z"
            stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
    </svg>

  @elseif($icon === 'building')
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
      <path d="M3 21h18M5 21V5a1 1 0 0 1 1-1h6v17M12 6h6v15M8 8h2M8 12h2M8 16h2M15 9h2M15 13h2M15 17h2"
            stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
    </svg>

  @elseif($icon === 'map')
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
      <path d="M9 3 3 6v15l6-3 6 3 6-3V3l-6 3-6-3Z"
            stroke="currentColor" stroke-width="2" stroke-linejoin="round"/>
    </svg>

  @elseif($icon === 'newspaper')
    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none">
      <path d="M4 6h12v12H4zM16 8h4v10a2 2 0 0 1-2 2H6"
            stroke="currentColor" stroke-width="2"/>
    </svg>

  {{-- ========================= --}}
  {{-- IKON TAMBAHAN DI SINI    --}}
  {{-- ========================= --}}

  @elseif($icon === 'user-circle') {{-- Untuk Kepala Daerah --}}
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>

  @elseif($icon === 'users') {{-- Untuk Pegawai --}}
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M17 20v-2a4 4 0 0 0-3-3.87M9 20v-2a4 4 0 0 1 3-3.87m0 0a4 4 0 1 0-3 0m3 0a4 4 0 1 1 3 0M7 8a4 4 0 1 1 10 0 4 4 0 0 1-10 0z"/>
    </svg>

  @elseif($icon === 'sitemap') {{-- Untuk Struktur Organisasi --}}
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
    </svg>

  @elseif($icon === 'photograph') {{-- Untuk Sliders --}}
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
    </svg>

  @elseif($icon === 'lightning-bolt')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M13 10V3L4 14h7v7l9-11h-7z"/>
    </svg>

  @elseif($icon === 'document-text')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
    </svg>

  @elseif($icon === 'speakerphone')
    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
    </svg>
  @endif

  <span class="text-sm">{{ $slot }}</span>
</a>
