@extends('layouts.app')
@section('title','Pengumuman')

@section('content')
<section class="py-10">
  <div class="max-w-4xl mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Pengumuman</h1>

    <div class="bg-white rounded-xl shadow border border-slate-200 divide-y">
      @forelse($items as $a)
        <article class="p-4">
          <a href="{{ route('ann.show', $a) }}" class="text-lg font-semibold text-slate-900 hover:underline">
            {{ $a->title }}
          </a>
          <div class="text-slate-500 text-sm mt-1">
            {{ optional($a->published_at)->format('d M Y H:i') ?? '-' }}
          </div>
          <p class="text-slate-700 mt-2 line-clamp-3">{{ \Illuminate\Support\Str::limit(strip_tags($a->body), 180) }}</p>
        </article>
      @empty
        <div class="p-8 text-center text-slate-500">Belum ada pengumuman.</div>
      @endforelse
    </div>

    <div class="mt-6">{{ $items->links() }}</div>
  </div>
</section>
@endsection
