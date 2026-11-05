@extends('layouts.admin')

@section('title','Tambah Sektor Baru')
@section('pageTitle','Tambah Sektor Baru')
@section('pageSub','Membuat entri sektor baru untuk ditampilkan')

@section('content')
<div class="max-w-3xl">
  @if($errors->any())
    <div class="mb-5 rounded bg-rose-50 text-rose-700 px-4 py-3">
      <div class="font-semibold mb-1">Periksa kembali isian kamu:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.sectors.store') }}" method="POST" class="space-y-6">
    @csrf

    <div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
      <h2 class="text-lg font-semibold">Formulir Tambah Sektor</h2>

      <div>
        <label class="block text-sm font-medium mb-1">Nama Sektor <span class="text-rose-600">*</span></label>
        <input type="text" name="name" class="w-full rounded border-slate-300"
               value="{{ old('name') }}" placeholder="Contoh: Pertanian" required id="js-name">
      </div>

      {{-- 🔹 Tambahan: Slug --}}
      <div>
        <label class="block text-sm font-medium mb-1">Slug (opsional)</label>
        <input type="text" name="slug" class="w-full rounded border-slate-300"
               value="{{ old('slug') }}" placeholder="otomatis dari nama jika kosong" id="js-slug">
        <p class="text-xs text-slate-500 mt-1">Dipakai untuk URL publik, misal <code>/sectors/pertanian</code>.</p>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Ikon</label>
        <input type="text" name="icon" class="w-full rounded border-slate-300"
               value="{{ old('icon') }}" placeholder="Contoh: building">
        <p class="text-xs text-slate-500 mt-1">Opsional. Contoh: <code>home</code>, <code>building</code>.</p>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Ringkasan</label>
        <textarea name="summary" rows="4" class="w-full rounded border-slate-300"
                  placeholder="Tulis penjelasan singkat tentang sektor ini...">{{ old('summary') }}</textarea>
      </div>

      <div class="grid md:grid-cols-2 gap-4">
        {{-- 🔹 Tambahan: Urutan tampil --}}
        <div>
          <label class="block text-sm font-medium mb-1">Urutan</label>
          <input type="number" name="order" min="0" class="w-full rounded border-slate-300"
                 value="{{ old('order', 0) }}">
          <p class="text-xs text-slate-500 mt-1">Semakin kecil, semakin atas.</p>
        </div>

        {{-- 🔹 Tambahan: Aktif? --}}
        <div class="flex items-center gap-2 mt-7">
          <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true))>
          <span class="text-sm">Aktif</span>
        </div>
      </div>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.sectors.index') }}" class="px-4 py-2 rounded border border-slate-300">Batal</a>
      <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Simpan</button>
    </div>
  </form>
</div>

@push('scripts')
<script>
  // auto-generate slug dari nama (kalau slug masih kosong)
  const nm = document.getElementById('js-name');
  const sl = document.getElementById('js-slug');
  if (nm && sl) {
    nm.addEventListener('input', () => {
      if (!sl.value) {
        sl.value = nm.value.toLowerCase().trim()
          .replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
      }
    });
  }
</script>
@endpush
@endsection
