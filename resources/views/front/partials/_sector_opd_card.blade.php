@php
  $icon  = $o->icon ?? '🏛️';
  $title = $o->nama ?? $o->name ?? '-';
  $sum   = $o->summary ?? '-';
  $count = $o->records_count ?? 0; // jika withCount('records')
@endphp

<article class="homecard">
  <div class="homecard-head">
    <div class="homecard-icon sky">{{ $icon }}</div>
    <div class="min-w-0">
      <h3 class="homecard-title">
        <a href="{{ route('opd.public.show', $o->slug) }}">{{ $title }}</a>
      </h3>
      <p class="homecard-sub">{{ $sum }}</p>
    </div>
    <span class="homecard-badge sky">{{ $count }} data</span>
  </div>

  {{-- slot ringkasan angka; bisa diisi metrik aggregate jika ada --}}
  <ul class="homecard-list">
    {{-- contoh placeholder --}}
    {{-- <li>Total item: <b>{{ number_format($count) }}</b></li> --}}
  </ul>
</article>
