@extends('layouts.admin')

@section('pageTitle', 'Kelola Slider')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Daftar Slider</h1>
        <a href="{{ route('admin.sliders.create') }}" class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">
            + Tambah Slider
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left">#</th>
                    <th class="px-4 py-2 text-left">Gambar</th>
                    <th class="px-4 py-2 text-left">Judul</th>
                    <th class="px-4 py-2 text-left">Urutan</th>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-4 py-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($sliders as $s)
                    <tr>
                        <td class="px-4 py-2">{{ $loop->iteration }}</td>
                        <td class="px-4 py-2">
                            <img src="{{ $s->image_url }}" alt="" class="h-14 w-24 object-cover rounded-lg border">
                        </td>
                        <td class="px-4 py-2">{{ $s->title ?? '-' }}</td>
                        <td class="px-4 py-2">{{ $s->order }}</td>
                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded-full {{ $s->is_active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $s->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </td>
                        <td class="px-4 py-2 text-right">
                            <a href="{{ route('admin.sliders.edit', $s) }}" class="text-blue-600 hover:underline">Edit</a>
                            <form action="{{ route('admin.sliders.destroy', $s) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus slider ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-600 hover:underline ml-2">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center py-6 text-gray-500">Belum ada slider.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
