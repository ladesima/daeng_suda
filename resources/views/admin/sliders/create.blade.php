@extends('layouts.admin')

@section('pageTitle', 'Tambah Slider')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Slider</h1>

    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        @csrf

        <div class="mb-4">
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded-lg" value="{{ old('title') }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Subjudul</label>
            <input type="text" name="subtitle" class="w-full border-gray-300 rounded-lg" value="{{ old('subtitle') }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Gambar</label>
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
            <p class="text-xs text-gray-500 mt-1">Ukuran disarankan 1600x600px</p>
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Urutan</label>
            <input type="number" name="order" class="w-full border-gray-300 rounded-lg" value="0">
        </div>

        <div class="mt-6">
            <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Simpan</button>
            <a href="{{ route('admin.sliders.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
