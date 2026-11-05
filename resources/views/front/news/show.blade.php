@extends('layouts.app')
@section('title',$news->title)
@section('content')
<div class="text-xs text-slate-500">{{ $news->category }} • {{ optional($news->published_at)->format('d M Y') }}</div>
<h1 class="text-2xl font-bold">{{ $news->title }}</h1>
<p class="mt-2 text-slate-700">{{ $news->excerpt }}</p>
<div class="prose max-w-none mt-4">{!! nl2br(e($news->body)) !!}</div>
@endsection
