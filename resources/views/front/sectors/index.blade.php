{{-- resources/views/front/sectors/index.blade.php --}}
@extends('layouts.app')

@section('title','Potensi & OPD')
@push('styles')
  @vite('resources/css/front-sectors.css')
@endpush

@section('content')
@php
    use Illuminate\Support\Str;

    /** Map icon "ph:*" → emoji fallback. */
    function sector_icon($raw, $fallback = '🧭') {
        if (!$raw) return $fallback;
        $map = [
            'ph:wheat'=>'🌾','ph:tree'=>'🌳','ph:fish'=>'🐟','ph:lightning'=>'⚡',
            'ph:leaf'=>'🍃','ph:pickaxe'=>'⛏️','ph:factory'=>'🏭','ph:bank'=>'🏛️','ph:drop'=>'💧',
        ];
        return $map[$raw] ?? (Str::startsWith($raw,'ph:') ? $fallback : $raw);
    }

    $desaPage = (int) request('desa_page', 1);
@endphp

{{-- Penting: class "front-sectors" untuk scope CSS --}}
<section class="front-sectors max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Header --}}
  <div class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900">Potensi &amp; OPD</h1>
    <p class="mt-2 text-slate-600">
      Halaman ini menampilkan daftar <b>Sektor Desa</b> dan <b>Sektor OPD</b>.
    </p>
  </div>

  {{-- ===== Sektor Desa ===== --}}
  <div id="sektor-desa" class="mb-10">
    <div class="fs-section-head">
      <h2>Sektor Desa</h2>
      <p class="fs-section-sub">Berisi sektor umum yang menaungi data desa/kelurahan.</p>
    </div>

    @if(empty($desaSectors) || $desaSectors->count() === 0)
      <div class="homecard">Belum ada sektor desa.</div>
    @else
      <div class="front-grid">
        @foreach($desaSectors as $s)
          <article class="homecard">
            <div class="homecard-head">
              <div class="homecard-icon">{{ sector_icon($s->icon ?? null,'🧭') }}</div>

              <div class="min-w-0">
                <h3 class="homecard-title">
                  <a href="{{ route('sectors.show',$s->slug) }}">{{ $s->name }}</a>
                </h3>
                <p class="homecard-sub line-clamp-2">{{ $s->summary }}</p>
              </div>

              <span class="homecard-badge">{{ (int)($s->villages_count ?? 0) }} desa</span>
            </div>

            <div class="mt-3">
              <a class="fs-btn fs-btn-primary" href="{{ route('sectors.show',$s->slug) }}">Lihat sektor</a>
            </div>
          </article>
        @endforeach
      </div>

      <div class="mt-6 fs-pagination">
        {!! $desaSectors->appends(['opd_page' => request('opd_page')])->onEachSide(1)->links() !!}
      </div>
    @endif
  </div>

  {{-- ===== Sektor OPD ===== --}}
<div id="sektor-opd">
  <div class="fs-section-head">
    <h2>Sektor OPD</h2>
    <p class="fs-section-sub">Sektor teknis per-OPD beserta ringkasan peran/datanya.</p>
  </div>

  {{-- SELALU TAMPILKAN GRID OPD --}}
  <div id="opd-grid" class="space-y-4" hx-push-url="true">
    <div class="front-grid">
      @forelse($opdSectors as $o)
        <article class="homecard relative hover:shadow-md transition-shadow">
          {{-- seluruh card dapat diklik --}}
          <a href="{{ route('opd.public.show', $o->slug) }}" class="absolute inset-0" aria-label="Lihat data {{ $o->nama }}"></a>

          <div class="homecard-head">
            <div class="homecard-icon sky">{{ sector_icon($o->icon ?? null,'🏛️') }}</div>
            <div class="min-w-0">
              <h3 class="homecard-title">{{ $o->nama }}</h3>
              <p class="homecard-sub line-clamp-2">{{ $o->summary }}</p>
            </div>
            <span class="homecard-badge sky">{{ (int)($o->records_count ?? 0) }} data</span>
          </div>
        </article>
      @empty
        {{-- Placeholder jika tabel dinas_sectors masih kosong --}}
        @php
          $placeholders = [
            ['nama'=>'Pertanian',   'icon'=>'🌾','summary'=>'Total luas & produksi.'],
            ['nama'=>'Perkebunan',  'icon'=>'🌴','summary'=>'Luas & produksi tahunan.'],
            ['nama'=>'Perikanan',   'icon'=>'🐟','summary'=>'Tambak/kolam & produksi.'],
            ['nama'=>'Kehutanan',   'icon'=>'🌳','summary'=>'Kawasan hutan & konservasi.'],
            ['nama'=>'Pertambangan','icon'=>'⛏️','summary'=>'Luas wilayah galian C.'],
            ['nama'=>'Energi & EBT','icon'=>'⚡','summary'=>'Potensi energi terpasang.'],
          ];
        @endphp
        @foreach($placeholders as $p)
          <article class="homecard opacity-80">
            <div class="homecard-head">
              <div class="homecard-icon sky">{{ $p['icon'] }}</div>
              <div class="min-w-0">
                <h3 class="homecard-title">{{ $p['nama'] }}</h3>
                <p class="homecard-sub line-clamp-2">{{ $p['summary'] }}</p>
              </div>
              <span class="homecard-badge sky">0 data</span>
            </div>
            <div class="mt-3">
              <span class="fs-btn fs-btn-ghost">Segera hadir</span>
            </div>
          </article>
        @endforeach
      @endforelse
    </div>

    {{-- Pagination OPD via HTMX (tanpa reload) --}}
    @php
      $desaPage = (int) request('desa_page', 1);
      $baseUrl  = route('sectors.all');                // halaman ini
      $qsCommon = http_build_query(['desa_page'=>$desaPage]);
      $curr     = $opdSectors->currentPage();
      $last     = $opdSectors->lastPage();
    @endphp

    @if($last > 1)
      <div class="mt-4 flex items-center justify-center gap-2 select-none">
        <a id="opd-prev"
           class="px-3 py-2 rounded border text-slate-700 hover:bg-slate-50 {{ $curr==1 ? 'pointer-events-none opacity-50' : '' }}"
           hx-get="{{ $baseUrl.'?'.$qsCommon.'&opd_page='.max(1,$curr-1).'&dir=left' }}"
           hx-target="#opd-grid" hx-select="#opd-grid" hx-swap="outerHTML transition:true">‹</a>

        @for($i=1; $i<=$last; $i++)
          <a class="px-3 py-2 rounded border {{ $i==$curr ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-50' }}"
             hx-get="{{ $baseUrl.'?'.$qsCommon.'&opd_page='.$i.'&dir='.($i>$curr?'right':'left') }}"
             hx-target="#opd-grid" hx-select="#opd-grid" hx-swap="outerHTML transition:true">{{ $i }}</a>
        @endfor

        <a id="opd-next"
           class="px-3 py-2 rounded border text-slate-700 hover:bg-slate-50 {{ $curr==$last ? 'pointer-events-none opacity-50' : '' }}"
           hx-get="{{ $baseUrl.'?'.$qsCommon.'&opd_page='.min($last,$curr+1).'&dir=right' }}"
           hx-target="#opd-grid" hx-select="#opd-grid" hx-swap="outerHTML transition:true">›</a>
      </div>
    @endif
  </div>
</div>
</section>

{{-- HTMX + animasi slide untuk OPD --}}
<script src="https://unpkg.com/htmx.org@1.9.12"></script>
<style>
  .front-sectors #opd-grid.htmx-swapping{opacity:0;transform:translateX(var(--opd-out,-12px));transition:transform .22s ease,opacity .22s ease}
  .front-sectors #opd-grid.htmx-added{opacity:0;transform:translateX(var(--opd-in,12px));animation:fs-opd-in .22s ease forwards}
  @keyframes fs-opd-in{to{opacity:1;transform:translateX(0)}}
</style>
<script>
  document.body.addEventListener('htmx:beforeRequest', (e) => {
    const url=(e.detail.pathInfo?.requestPath)||(e.detail.requestConfig?.path)||'';
    if(!url) return;
    const dir=new URL(url,location.origin).searchParams.get('dir');
    const grid=document.querySelector('#opd-grid'); if(!grid) return;
    if(dir==='right'){ grid.style.setProperty('--opd-in','12px'); grid.style.setProperty('--opd-out','-12px'); }
    else { grid.style.setProperty('--opd-in','-12px'); grid.style.setProperty('--opd-out','12px'); }
  });
</script>
@endsection
