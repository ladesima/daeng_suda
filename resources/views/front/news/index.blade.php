@extends('layouts.app')
@section('title','Berita')
@section('content')
<h1 class="text-2xl font-bold mb-4">Berita</h1>
@foreach($items as $n)
  <a href="{{ route('news.show',$n) }}" class="block bg-white border rounded p-4 hover:shadow mb-3">
    <div class="text-xs text-slate-500">{{ $n->category }} • {{ optional($n->published_at)->format('d M Y') }}</div>
    <div class="font-semibold">{{ $n->title }}</div>
    <div class="text-sm text-slate-600">{{ $n->excerpt }}</div>
  </a>
@endforeach
<div class="mt-4">{{ $items->links() }}</div>
@endsection
