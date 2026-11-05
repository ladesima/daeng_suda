@extends('layouts.app')
@section('title', 'Struktur Organisasi')

@section('content')
<div class="min-h-screen bg-slate-50/70 py-12" x-data="{ viewMode: 'tree', search: '' }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Breadcrumb --}}
    <nav class="flex items-center gap-2 text-sm text-slate-500 mb-8" aria-label="Breadcrumb">
      <a href="{{ route('home') }}" class="hover:text-emerald-600 transition inline-flex items-center gap-1.5 font-medium">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
        </svg>
        Beranda
      </a>
      <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
      </svg>
      <span class="text-emerald-700 font-semibold">Struktur Organisasi</span>
    </nav>

    {{-- Page Header --}}
    <div class="text-center max-w-3xl mx-auto mb-10">
      <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold tracking-wide uppercase mb-3 shadow-xs">
        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
        Sekretariat Daerah Kabupaten Jeneponto
      </div>
      <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
        Struktur Organisasi Bagian SDA
      </h1>
      <p class="mt-2 text-slate-600 text-base sm:text-lg">
        Susunan kepemimpinan dan personil pada Bagian Sumber Daya Alam
      </p>
    </div>

    @if($employees->isEmpty())
      <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-slate-200/80 max-w-xl mx-auto">
        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
          </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Data Pegawai Belum Tersedia</h3>
        <p class="text-sm text-slate-500 mt-1">Data susunan pegawai belum diinputkan pada panel admin.</p>
      </div>
    @else
      {{-- View Switcher and Search --}}
      <div class="flex flex-col sm:flex-row items-center justify-between gap-4 mb-8 bg-white p-4 rounded-2xl shadow-xs border border-slate-200/80">
        {{-- Tabs --}}
        <div class="flex items-center gap-1 bg-slate-100 p-1 rounded-xl w-full sm:w-auto">
          <button 
            type="button"
            @click="viewMode = 'tree'"
            :class="viewMode === 'tree' ? 'bg-white text-emerald-700 shadow-xs font-semibold' : 'text-slate-600 hover:text-slate-900 font-medium'"
            class="flex-1 sm:flex-initial px-4 py-2 rounded-lg text-xs sm:text-sm transition flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            Bagan Hirarki
          </button>
          <button 
            type="button"
            @click="viewMode = 'grid'"
            :class="viewMode === 'grid' ? 'bg-white text-emerald-700 shadow-xs font-semibold' : 'text-slate-600 hover:text-slate-900 font-medium'"
            class="flex-1 sm:flex-initial px-4 py-2 rounded-lg text-xs sm:text-sm transition flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Daftar Personil
          </button>
        </div>

        {{-- Search input --}}
        <div class="relative w-full sm:w-72">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </span>
          <input 
            type="text" 
            x-model="search" 
            placeholder="Cari nama, jabatan, NIP..."
            class="w-full pl-9 pr-4 py-2 text-sm border border-slate-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition">
        </div>
      </div>

      {{-- VIEW 1: HIRARKI (TREE) --}}
      <div x-show="viewMode === 'tree' && search === ''" x-transition:enter="transition ease-out duration-200" class="bg-white rounded-3xl p-6 sm:p-10 shadow-sm border border-slate-200/80">
        <div class="max-w-3xl mx-auto">
          @include('front.partials.structure-tree', ['nodes' => $tree])
        </div>
      </div>

      {{-- VIEW 2: GRID CARDS (AND SEARCH RESULTS) --}}
      <div x-show="viewMode === 'grid' || search !== ''" x-transition:enter="transition ease-out duration-200">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          @foreach($employees as $emp)
            <div 
              x-show="'{{ strtolower(addslashes($emp->nama . ' ' . $emp->jabatan . ' ' . $emp->nip)) }}'.includes(search.toLowerCase())"
              class="bg-white rounded-2xl p-5 shadow-xs border border-slate-200/80 hover:shadow-md hover:border-emerald-300 transition-all duration-200 flex flex-col justify-between group">
              <div>
                <div class="flex items-start gap-4">
                  <div class="w-16 h-16 rounded-2xl overflow-hidden bg-slate-100 border border-slate-200 flex-shrink-0">
                    <img 
                      src="{{ $emp->photo_url }}" 
                      alt="Foto {{ $emp->nama }}" 
                      class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                      onerror="this.src='{{ asset('images/no-image.png') }}'"
                      loading="lazy"
                    >
                  </div>
                  <div class="min-w-0 flex-1">
                    <span class="inline-block px-2.5 py-0.5 rounded-md bg-emerald-50 text-emerald-700 text-xs font-semibold tracking-wide border border-emerald-200/60 mb-1">
                      {{ $emp->jabatan }}
                    </span>
                    <h3 class="text-base font-bold text-slate-900 group-hover:text-emerald-700 transition">
                      {{ $emp->nama }}
                    </h3>
                    @if($emp->nip)
                      <p class="text-xs text-slate-500 font-mono mt-0.5">
                        NIP: {{ $emp->nip }}
                      </p>
                    @endif
                  </div>
                </div>
              </div>

              @if($emp->atasan)
                <div class="mt-4 pt-3 border-t border-slate-100 text-xs text-slate-500 flex items-center gap-1.5">
                  <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                  </svg>
                  <span>Atasan: <strong class="text-slate-700">{{ $emp->atasan->nama }}</strong></span>
                </div>
              @endif
            </div>
          @endforeach
        </div>
      </div>
    @endif

  </div>
</div>
@endsection
