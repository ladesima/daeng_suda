@extends('layouts.admin')

@section('pageTitle', 'Edit Kepala Daerah')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Kepala Daerah</h1>
        <p class="text-sm text-gray-500 mt-1">Perbarui data kepala daerah di bawah ini.</p>
    </div>

    {{-- Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <form action="{{ route('admin.leaders.update', $leader) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $leader->nama) }}" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $leader->jabatan) }}" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Visi</label>
                <textarea name="visi" rows="3" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('visi', $leader->visi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Misi</label>
                <textarea name="misi" rows="4" class="w-full border-gray-300 rounded-lg px-4 py-2 focus:ring-emerald-500 focus:border-emerald-500">{{ old('misi', $leader->misi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini</label>
                @if($leader->foto)
                    <img src="{{ $leader->photo_url }}" alt="{{ $leader->nama }}" class="w-24 h-32 object-cover rounded-lg border mb-3 shadow-xs" onerror="this.src='{{ asset('images/no-image.png') }}'">
                @else
                    <p class="text-gray-400 italic mb-3">Belum ada foto</p>
                @endif
                <input type="file" name="foto" accept="image/*" class="w-full border-gray-300 rounded-lg px-4 py-2">
            </div>

            <div class="flex justify-end gap-3 pt-6 border-t border-gray-200">
                <a href="{{ route('admin.leaders.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700">Batal</a>
                <button type="submit" class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection
