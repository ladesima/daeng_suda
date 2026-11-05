@php
  $icon = $s->icon ?? '🌿';
  $title = $s->name ?? $s->nama ?? '-';
  $sum = $s->summary ?? '-';
  $count = $s->villages_count ?? 0;
@endphp

<article class="homecard">
  <div class="homecard-head">
    <div class="homecard-icon">{{ $icon }}</div>
    <div class="min-w-0">
      <h3 class="homecard-title">
        <a href="{{ route('sectors.show', $s->slug) }}">{{ $title }}</a>
      </h3>
      <p class="homecard-sub">{{ $sum }}</p>
    </div>
    <span class="homecard-badge">{{ $count }} desa</span>
  </div>

  {{-- slot ringkasan angka (kalau punya metrik default, taruh di sini) --}}
  <ul class="homecard-list">
    {{-- contoh placeholder --}}
    {{-- <li>Luas sawah: <b>0,00</b> Ha</li> --}}
  </ul>
</article>
