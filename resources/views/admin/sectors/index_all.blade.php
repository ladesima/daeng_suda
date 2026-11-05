{{-- resources/views/front/sectors/index_all.blade.php --}}
@extends('layouts.app')

@section('title','Potensi & OPD')
@section('content')
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Header --}}
  <div class="mb-8">
    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Potensi & OPD</h1>
    <p class="mt-2 text-slate-600">
      Jelajahi sektor potensi desa dan sektor/OPD berikut beserta ringkasan dan jumlah datanya.
    </p>
  </div>

  {{-- SEKTOR DESA --}}
  <div class="mb-10">
    <div class="flex items-end justify-between mb-4">
      <h2 class="text-xl font-semibold text-slate-900">Sektor Desa</h2>
      <a href="{{ route('sectors.index') }}"
         class="text-sm text-emerald-700 hover:text-emerald-800 hover:underline">
        Lihat semua sektor desa »
      </a>
    </div>

    @if(($sectors ?? collect())->count() === 0)
      <div class="rounded-lg border border-slate-200 bg-white p-6 text-slate-500">
        Belum ada sektor desa.
      </div>
    @else
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($sectors as $s)
          <article class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <div class="h-10 w-10 grid place-items-center rounded-lg bg-emerald-50 text-xl">
                {{ $s->icon ?? '🧭' }}
              </div>
              <div class="min-w-0">
                <h3 class="text-base font-semibold text-slate-900 truncate" title="{{ $s->name }}">
                  {{ $s->name }}
                </h3>
                <p class="mt-1 text-sm text-slate-600 line-clamp-2">{{ $s->summary }}</p>
              </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
              <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-700">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path d="M3 21v-7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4v7" stroke-width="1.6"/>
                  <circle cx="12" cy="7" r="3" stroke-width="1.6"/>
                </svg>
                {{ $s->villages_count }} Desa
              </span>

              <a href="{{ route('sectors.show', $s->slug) }}"
                 class="inline-flex items-center gap-1.5 rounded-lg bg-emerald-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-emerald-700">
                Lihat sektor
                <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l4.999 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.415-1.414L13.584 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </a>
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>

  {{-- SEKTOR / OPD --}}
  <div class="mb-2">
    <h2 class="text-xl font-semibold text-slate-900 mb-4">Sektor / OPD</h2>

    @if(($opdSectors ?? collect())->count() === 0)
      <div class="rounded-lg border border-slate-200 bg-white p-6 text-slate-500">
        Belum ada sektor/OPD.
      </div>
    @else
      <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($opdSectors as $o)
          <article class="group rounded-xl border border-slate-200 bg-white p-5 shadow-sm hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <div class="h-10 w-10 grid place-items-center rounded-lg bg-sky-50 text-xl">
                {{ $o->icon ?? '🏛️' }}
              </div>
              <div class="min-w-0">
                <h3 class="text-base font-semibold text-slate-900 truncate" title="{{ $o->nama }}">
                  {{ $o->nama }}
                </h3>
                <p class="mt-1 text-sm text-slate-600 line-clamp-2">{{ $o->summary }}</p>
              </div>
            </div>

            <div class="mt-4 flex items-center justify-between">
              <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-700">
                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                  <path d="M4 4h16v12H4zM10 20h4" stroke-width="1.6"/>
                </svg>
              Data: {{ $o->records_count ?? 0 }}
              </span>

              {{-- Tautan opsional ke halaman detail OPD publik bila route tersedia --}}
              @if (Route::has('opd.show'))
                <a href="{{ route('opd.show', $o->slug) }}"
                   class="inline-flex items-center gap-1.5 rounded-lg bg-sky-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-sky-700">
                  Detail OPD
                  <svg class="h-3.5 w-3.5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l4.999 5a1 1 0 010 1.414l-5 5a1 1 0 01-1.415-1.414L13.584 11H4a1 1 0 110-2h9.586l-3.293-3.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                  </svg>
                </a>
              @endif
            </div>
          </article>
        @endforeach
      </div>
    @endif
  </div>

</section>
@endsection
