@extends('layouts.app')
@section('title', $announcement->title)

@section('content')
<section class="py-10">
  <div class="max-w-3xl mx-auto px-4">
    <nav class="text-sm text-slate-500 mb-6">
      <a href="{{ route('home') }}" class="hover:underline">Beranda</a>
      <span class="mx-2">/</span>
      <a href="{{ route('ann.index') }}" class="hover:underline">Pengumuman</a>
      <span class="mx-2">/</span>
      <span class="text-slate-700 font-medium">Detail</span>
    </nav>

    <h1 class="text-2xl font-bold text-slate-900">{{ $announcement->title }}</h1>
    <div class="text-slate-500 text-sm mt-1">
      {{ optional($announcement->published_at)->format('d M Y H:i') ?? '-' }}
    </div>

    <div class="prose max-w-none mt-6">
      {!! $announcement->body !!}
    </div>
  </div>
</section>
@endsection
