@extends('layouts.admin')
@section('title','Kelola Potensi')
@section('pageTitle','Potensi (SDA)')
@section('content')

<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Potensi</h1>
  <a href="{{ route('admin.potentials.create') }}" class="px-3 py-2 bg-emerald-600 text-white rounded">Tambah</a>
</div>

@if(session('success'))
  <div class="mb-4 rounded bg-emerald-50 text-emerald-800 px-4 py-2">{{ session('success') }}</div>
@endif

<div class="bg-white border rounded overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-slate-50 text-left">
      <tr>
        <th class="p-3">Judul</th>
        <th class="p-3">Sektor</th>
        <th class="p-3">Lokasi</th>
        <th class="p-3">Diubah</th>
        <th class="p-3 w-40 text-right">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @forelse($items as $it)
        <tr class="border-t">
          <td class="p-3">
            <div class="font-medium text-slate-900">{{ $it->title }}</div>
            @if($it->slug)
              <div class="text-xs text-slate-500">/potensi/{{ $it->slug }}</div>
            @endif
          </td>
          <td class="p-3">{{ optional($it->sector)->name ?? '-' }}</td>
          <td class="p-3">
            {{ $it->desa ?: '-' }}
            @if($it->kecamatan) <span class="text-slate-400">, Kec. {{ $it->kecamatan }}</span> @endif
          </td>
          <td class="p-3 text-slate-600">{{ $it->updated_at?->format('d M Y H:i') }}</td>
          <td class="p-3 text-right space-x-2">
            <a href="{{ route('admin.potentials.edit',$it) }}" class="px-3 py-1.5 rounded bg-slate-800 text-white hover:bg-slate-900">Edit</a>
            <form action="{{ route('admin.potentials.destroy',$it) }}" method="POST" class="inline"
                  onsubmit="return confirm('Hapus potensi ini?')">
              @csrf @method('DELETE')
              <button class="px-3 py-1.5 rounded bg-rose-600 text-white hover:bg-rose-700">Hapus</button>
            </form>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="5" class="p-6 text-center text-slate-500">Belum ada data potensi.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</div>

<div class="mt-3">{{ $items->links() }}</div>
@endsection
