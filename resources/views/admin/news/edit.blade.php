@extends('layouts.admin')

{{-- Mengatur judul halaman di header --}}
@section('pageTitle', 'Edit Berita')
@section('pageSub', 'Memperbarui konten berita yang sudah ada')

@section('content')
{{-- Kontainer utama berbentuk kartu --}}
<div class="bg-white rounded-2xl shadow-sm">
    
    {{-- Header Kartu --}}
    <div class="px-6 py-4 border-b border-slate-200">
        <h2 class="text-xl font-semibold text-slate-700">Formulir Edit Berita</h2>
    </div>

    {{-- Badan Form --}}
    <form method="POST" action="{{ route('admin.news.update', $news) }}" class="px-6 py-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            {{-- Field: Judul --}}
            <div>
                <label for="title" class="block text-sm font-medium text-slate-600 mb-2">Judul Berita</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                       class="block w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition sm:text-sm"
                       required>
                @error('title')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field: Kategori --}}
            <div>
                <label for="category" class="block text-sm font-medium text-slate-600 mb-2">Kategori</label>
                <input type="text" id="category" name="category" value="{{ old('category', $news->category) }}"
                       class="block w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition sm:text-sm"
                       placeholder="Contoh: Teknologi, Pertanian">
                <p class="mt-2 text-xs text-slate-500">Opsional. Pisahkan dengan koma jika lebih dari satu.</p>
            </div>
            
            {{-- Field: Ringkasan (Excerpt) --}}
            <div>
                <label for="excerpt" class="block text-sm font-medium text-slate-600 mb-2">Ringkasan</label>
                <textarea id="excerpt" name="excerpt" rows="3"
                          class="block w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition sm:text-sm">{{ old('excerpt', $news->excerpt) }}</textarea>
                <p class="mt-2 text-xs text-slate-500">Opsional. Cuplikan singkat dari isi berita.</p>
            </div>

            {{-- Field: Isi (Body) --}}
            <div>
                <label for="body" class="block text-sm font-medium text-slate-600 mb-2">Isi Berita</label>
                <textarea id="body" name="body" rows="10"
                          class="block w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition sm:text-sm"
                          required>{{ old('body', $news->body) }}</textarea>
                @error('body')
                    <p class="mt-2 text-sm text-rose-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Field: Tanggal Terbit --}}
            <div>
                <label for="published_at" class="block text-sm font-medium text-slate-600 mb-2">Tanggal Terbit</label>
                <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', optional($news->published_at)->format('Y-m-d\TH:i')) }}"
                       class="block w-full px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition sm:text-sm">
                <p class="mt-2 text-xs text-slate-500">Opsional. Kosongkan jika ingin disimpan sebagai draf.</p>
            </div>
        </div>

        {{-- Footer Form dengan Tombol Aksi --}}
        <div class="mt-8 pt-6 border-t border-slate-200 flex justify-end items-center gap-4">
            <a href="{{ route('admin.news.index') }}"
               class="px-4 py-2 text-sm font-medium text-slate-700 bg-slate-100 hover:bg-slate-200 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-500">
                Batal
            </a>
            <button type="submit"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-lg shadow-sm transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
