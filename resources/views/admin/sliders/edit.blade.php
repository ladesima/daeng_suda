@extends('layouts.admin')

@section('pageTitle', 'Edit Slider')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Edit Slider</h1>

    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block font-medium mb-1">Judul</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded-lg" value="{{ old('title', $slider->title) }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Subjudul</label>
            <input type="text" name="subtitle" class="w-full border-gray-300 rounded-lg" value="{{ old('subtitle', $slider->subtitle) }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Gambar Saat Ini</label>
            <img src="{{ $slider->image_url }}" class="h-40 rounded-lg border mb-2">
            <input type="file" name="image" class="w-full border-gray-300 rounded-lg">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Urutan</label>
            <input type="number" name="order" class="w-full border-gray-300 rounded-lg" value="{{ old('order', $slider->order) }}">
        </div>

        <div class="mb-4">
            <label class="block font-medium mb-1">Status</label>
            <select name="is_active" class="w-full border-gray-300 rounded-lg">
                <option value="1" {{ $slider->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$slider->is_active ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <div class="mt-6">
            <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700">Update</button>
            <a href="{{ route('admin.sliders.index') }}" class="ml-2 text-gray-600 hover:underline">Batal</a>
        </div>
    </form>
</div>
@endsection
