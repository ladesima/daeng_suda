{{-- _opd_grid.blade.php --}}
<div id="opd-grid" class="space-y-4"
     hx-push-url="true">
  <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
    @foreach($opdSectors as $o)
      <article class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
        <div class="flex items-start gap-3">
          <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-sky-50 text-xl shrink-0">
            <span class="leading-none select-none" aria-hidden="true">{{ sector_icon($o->icon ?? null, '🏛️') }}</span>
          </div>
          <div class="min-w-0">
            <h3 class="text-base font-semibold text-slate-900 truncate" title="{{ $o->nama }}">{{ $o->nama }}</h3>
            <p class="mt-1 text-sm text-slate-600 line-clamp-2">{{ $o->summary }}</p>
          </div>
        </div>
        <div class="mt-4 flex items-center justify-between">
          <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-700">
            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path d="M4 6h16M4 12h16M4 18h7" stroke-width="1.6"/></svg>
            {{ $o->records_count ?? 0 }} Data
          </span>
        </div>
      </article>
    @endforeach
  </div>

  {{-- Pagination (AJAX via HTMX) --}}
  <div class="mt-4 flex items-center justify-center gap-2">
    @php
      // keep query params untuk sinkron dengan sektor desa
      $base = route('sectors.index', ['desa_page' => request('desa_page')]);
    @endphp

    <a id="opd-prev"
       class="px-3 py-2 rounded border text-slate-700 hover:bg-slate-50 {{ $opdSectors->onFirstPage() ? 'pointer-events-none opacity-50' : '' }}"
       hx-get="{{ $base.'&opd_page='.($opdSectors->currentPage()-1).'&fragment=opd&dir=left' }}"
       hx-target="#opd-grid"
       hx-swap="outerHTML transition:true">
      ‹
    </a>

    @for ($i = 1; $i <= $opdSectors->lastPage(); $i++)
      <a class="px-3 py-2 rounded border {{ $i==$opdSectors->currentPage() ? 'bg-slate-900 text-white' : 'text-slate-700 hover:bg-slate-50' }}"
         hx-get="{{ $base.'&opd_page='.$i.'&fragment=opd&dir='.( $i > $opdSectors->currentPage() ? 'right':'left' ) }}"
         hx-target="#opd-grid"
         hx-swap="outerHTML transition:true">
        {{ $i }}
      </a>
    @endfor

    <a id="opd-next"
       class="px-3 py-2 rounded border text-slate-700 hover:bg-slate-50 {{ $opdSectors->currentPage()==$opdSectors->lastPage() ? 'pointer-events-none opacity-50' : '' }}"
       hx-get="{{ $base.'&opd_page='.($opdSectors->currentPage()+1).'&fragment=opd&dir=right' }}"
       hx-target="#opd-grid"
       hx-swap="outerHTML transition:true">
      ›
    </a>
  </div>
</div>
