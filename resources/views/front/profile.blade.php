@extends('layouts.app')
@section('title', 'Profil Pimpinan Daerah')

@section('content')
<div class="min-h-screen bg-slate-50/70 py-12">
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
      <span class="text-emerald-700 font-semibold">Profil Daerah</span>
    </nav>

    @if(!$leader && (!isset($leaders) || $leaders->isEmpty()))
      <div class="bg-white rounded-3xl p-12 text-center shadow-sm border border-slate-200/80 max-w-xl mx-auto">
        <div class="w-16 h-16 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4 text-slate-400">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
          </svg>
        </div>
        <h3 class="text-lg font-bold text-slate-800">Data Profil Belum Tersedia</h3>
        <p class="text-sm text-slate-500 mt-1">Data kepala daerah belum diinputkan pada panel admin.</p>
      </div>
    @else
      {{-- Hero Section Header --}}
      <div class="text-center max-w-3xl mx-auto mb-12">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-semibold tracking-wide uppercase mb-3 shadow-xs">
          <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
          Pemerintah Kabupaten Jeneponto
        </div>
        <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">
          Profil Kepala Daerah
        </h1>
        <p class="mt-2 text-slate-600 text-base sm:text-lg">
          Visi dan Misi Pembangunan Daerah Kabupaten Jeneponto
        </p>
      </div>

      {{-- Leaders Loop / Showcase --}}
      <div class="space-y-12">
        @foreach($leaders as $item)
        <div class="bg-white rounded-3xl shadow-sm border border-slate-200/80 overflow-hidden transition-all duration-300 hover:shadow-md">
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-0">

            {{-- FOTO & IDENTITAS --}}
            <div class="lg:col-span-5 bg-gradient-to-b from-slate-900 via-slate-800 to-emerald-950 p-8 sm:p-10 flex flex-col items-center justify-center text-center relative overflow-hidden">
              {{-- Ambient light pattern --}}
              <div class="absolute -top-24 -left-24 w-64 h-64 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>
              <div class="absolute -bottom-24 -right-24 w-64 h-64 bg-teal-500/20 rounded-full blur-3xl pointer-events-none"></div>

              {{-- Foto Frame --}}
              <div class="relative z-10 w-52 sm:w-60 aspect-[3/4] rounded-2xl p-1.5 bg-gradient-to-br from-emerald-400/40 via-white/20 to-teal-400/40 shadow-2xl overflow-hidden mb-6 group">
                <img
                  src="{{ $item->photo_url }}"
                  alt="Foto {{ $item->nama }}"
                  class="w-full h-full object-cover rounded-xl transition duration-500 group-hover:scale-105"
                  onerror="this.src='{{ asset('images/no-image.png') }}'"
                  loading="lazy"
                >
              </div>

              {{-- Nama & Jabatan --}}
              <div class="relative z-10">
                <span class="inline-block px-3 py-1 rounded-full bg-emerald-500/20 border border-emerald-400/30 text-emerald-300 text-xs font-semibold tracking-wider uppercase mb-2">
                  {{ $item->jabatan }}
                </span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-white tracking-tight">
                  {{ $item->nama }}
                </h2>
              </div>
            </div>

            {{-- VISI & MISI CONTENT --}}
            <div class="lg:col-span-7 p-8 sm:p-10 lg:p-12 flex flex-col justify-center space-y-8 bg-white">
              
              {{-- VISI --}}
              @if(!empty($item->visi))
              <div class="relative pl-6 border-l-4 border-emerald-500 bg-emerald-50/40 rounded-r-2xl p-6">
                <div class="flex items-center gap-2 mb-2 text-emerald-800 font-bold text-sm uppercase tracking-wider">
                  <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                  Visi Daerah
                </div>
                <blockquote class="text-slate-800 text-lg sm:text-xl font-semibold italic leading-relaxed">
                  "{{ $item->visi }}"
                </blockquote>
              </div>
              @endif

              {{-- MISI --}}
              @if(!empty($item->misi))
              <div>
                <div class="flex items-center gap-2 mb-4 text-slate-900 font-bold text-sm uppercase tracking-wider">
                  <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                  </svg>
                  Misi Pembangunan
                </div>

                {{-- Parsing lines --}}
                @php
                  $lines = array_filter(array_map('trim', explode("\n", $item->misi)));
                @endphp

                <div class="space-y-3">
                  @foreach($lines as $index => $line)
                    @php
                      // Strip leading numbers like "1. " if present to format cleanly
                      $cleanLine = preg_replace('/^\d+[\.\)]\s*/', '', $line);
                    @endphp
                    <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-slate-50/80 border border-slate-100 hover:border-emerald-200 hover:bg-emerald-50/30 transition duration-200">
                      <span class="flex-shrink-0 w-7 h-7 rounded-lg bg-emerald-600 text-white font-bold text-xs flex items-center justify-center shadow-xs">
                        {{ $index + 1 }}
                      </span>
                      <p class="text-slate-700 text-sm sm:text-base leading-relaxed pt-0.5">
                        {{ $cleanLine ?: $line }}
                      </p>
                    </div>
                  @endforeach
                </div>
              </div>
              @endif

            </div>

          </div>
        </div>
        @endforeach
      </div>
    @endif

  </div>
</div>
@endsection
