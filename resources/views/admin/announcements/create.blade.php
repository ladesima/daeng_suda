@extends('layouts.admin')
@section('title','Tambah Pengumuman')

@section('content')
<div class="p-6 max-w-3xl">
  <h1 class="text-xl font-semibold mb-4">Tambah Pengumuman</h1>

  @if($errors->any())
    <div class="mb-4 rounded bg-rose-50 text-rose-700 px-4 py-2">
      <ul class="list-disc list-inside">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.announcements.store') }}" method="POST" class="space-y-4">
    @csrf
    @include('admin.announcements.partials._form', ['announcement' => $announcement, 'mode' => 'create'])
  </form>
</div>
@endsection
