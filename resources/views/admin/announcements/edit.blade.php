@extends('layouts.admin')
@section('title','Edit Pengumuman')

@section('content')
<div class="p-6 max-w-3xl">
  <h1 class="text-xl font-semibold mb-4">Edit Pengumuman</h1>

  @if(session('success'))
    <div class="mb-4 rounded bg-emerald-50 text-emerald-800 px-4 py-2">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="mb-4 rounded bg-rose-50 text-rose-700 px-4 py-2">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.announcements.update', $announcement) }}" method="POST" class="space-y-4">
    @csrf @method('PUT')
    @include('admin.announcements.partials._form', ['announcement' => $announcement, 'mode' => 'edit'])
  </form>
</div>
@endsection
