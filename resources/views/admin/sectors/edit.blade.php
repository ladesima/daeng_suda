@extends('layouts.admin')

@section('title','Edit Sektor')
@section('pageTitle','Edit Sektor')
@section('pageSub','Perbarui data sektor')

@section('content')
<div class="max-w-5xl">
  @if(session('success'))
    <div class="mb-5 rounded bg-emerald-50 text-emerald-800 px-4 py-3">{{ session('success') }}</div>
  @endif
  @if($errors->any())
    <div class="mb-5 rounded bg-rose-50 text-rose-700 px-4 py-3">
      <div class="font-semibold mb-1">Periksa kembali isian kamu:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
      </ul>
    </div>
  @endif

  {{-- ========= Form Sektor ========= --}}
  <form action="{{ route('admin.sectors.update', $sector) }}" method="POST" class="space-y-6">
    @csrf @method('PUT')

    <div class="rounded-2xl bg-white border border-slate-200 p-5 md:p-6 space-y-5">
      <h2 class="text-lg font-semibold">Formulir Edit Sektor</h2>

      <div>
        <label class="block text-sm font-medium mb-1">Nama Sektor <span class="text-rose-600">*</span></label>
        <input type="text" name="name" class="w-full rounded border-slate-300"
               value="{{ old('name', $sector->name) }}" required id="js-name">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Slug (opsional)</label>
        <input type="text" name="slug" class="w-full rounded border-slate-300"
               value="{{ old('slug', $sector->slug) }}" id="js-slug">
        <p class="text-xs text-slate-500 mt-1">Dipakai untuk URL publik.</p>
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Ikon</label>
        <input type="text" name="icon" class="w-full rounded border-slate-300"
               value="{{ old('icon', $sector->icon) }}" placeholder="Contoh: building">
      </div>

      <div>
        <label class="block text-sm font-medium mb-1">Ringkasan</label>
        <textarea name="summary" rows="4" class="w-full rounded border-slate-300">{{ old('summary', $sector->summary) }}</textarea>
      </div>

      <div class="grid md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium mb-1">Urutan</label>
          <input type="number" name="order" min="0" class="w-full rounded border-slate-300"
                 value="{{ old('order', $sector->order ?? 0) }}">
        </div>

        <div class="flex items-center gap-2 mt-7">
          <input type="checkbox" name="is_active" value="1"
                 @checked(old('is_active', $sector->is_active))>
          <span class="text-sm">Aktif</span>
        </div>
      </div>
    </div>

    <div class="flex items-center gap-2">
      <a href="{{ route('admin.sectors.index') }}" class="px-4 py-2 rounded border border-slate-300">Batal</a>
      <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">Update</button>
    </div>
  </form>

  {{-- ========= Panel Desa pada Sektor Ini ========= --}}
  <div class="mt-8 rounded-2xl bg-white border border-slate-200 p-5 md:p-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Desa/Kelurahan pada Sektor Ini</h2>
      <a href="{{ route('admin.sectors.villages.create', $sector) }}"
         class="px-3 py-2 rounded bg-emerald-600 text-white">+ Tambah Desa</a>
    </div>

    <div class="overflow-x-auto border rounded">
      <table class="w-full text-sm">
        <thead class="bg-slate-50">
          <tr>
            <th class="p-3 text-left">Desa/Kel</th>
            <th class="p-3 text-left">Kecamatan</th>
            <th class="p-3 text-left">Penduduk</th>
            <th class="p-3 text-right w-44">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($sector->villages as $v)
            <tr class="border-t">
              <td class="p-3">{{ $v->nama }}</td>
              <td class="p-3">{{ $v->kecamatan ?? '-' }}</td>
              <td class="p-3">{{ $v->jumlah_penduduk ? number_format($v->jumlah_penduduk) : '-' }}</td>
              <td class="p-3 text-right space-x-2">
                <a href="{{ route('admin.sectors.villages.edit', [$sector,$v]) }}"
                   class="px-3 py-1.5 rounded bg-slate-800 text-white">Edit</a>
                <form action="{{ route('admin.sectors.villages.detach', [$sector,$v]) }}"
                      method="POST" class="inline"
                      onsubmit="return confirm('Lepas desa ini dari sektor?')">
                  @csrf @method('DELETE')
                  <button class="px-3 py-1.5 rounded bg-rose-600 text-white">Lepas</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="4" class="p-4 text-center text-slate-500">Belum ada desa pada sektor ini.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Attach desa yang belum punya sektor --}}
    <form action="{{ route('admin.sectors.villages.attach', $sector) }}" method="POST" class="mt-4 flex gap-2">
      @csrf
      <select name="village_id" class="rounded border-slate-300 min-w-[260px]" required>
        <option value="">— Pilih Desa yang Belum Terhubung —</option>
        @foreach($availableVillages as $opt)
          <option value="{{ $opt->id }}">{{ $opt->nama }} @if($opt->kecamatan) (Kec. {{ $opt->kecamatan }}) @endif</option>
        @endforeach
      </select>
      <button class="px-3 py-2 rounded bg-sky-600 text-white">Tambahkan</button>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
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
