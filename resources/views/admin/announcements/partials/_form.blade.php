<div class="bg-white rounded-lg shadow border border-slate-200 p-4 space-y-4">
  <div>
    <label class="block text-sm font-medium mb-1">Judul <span class="text-rose-600">*</span></label>
    <input type="text" name="title" class="w-full rounded border-slate-300"
           value="{{ old('title', $announcement->title ?? '') }}" required>
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Slug (opsional)</label>
    <input type="text" name="slug" class="w-full rounded border-slate-300"
           value="{{ old('slug', $announcement->slug ?? '') }}"
           placeholder="otomatis dari judul jika kosong">
  </div>

  <div>
    <label class="block text-sm font-medium mb-1">Isi <span class="text-rose-600">*</span></label>
    <textarea name="body" rows="8" class="w-full rounded border-slate-300" required>{{ old('body', $announcement->body ?? '') }}</textarea>
    {{-- NOTE: kalau mau WYSIWYG (TinyMCE/TipTap), tinggal ganti textarea ini --}}
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
      <label class="block text-sm font-medium mb-1">Tanggal Terbit</label>
      <input type="datetime-local" name="published_at" class="w-full rounded border-slate-300"
             value="{{ old('published_at', optional($announcement->published_at ?? null)->format('Y-m-d\TH:i')) }}">
      <p class="text-xs text-slate-500 mt-1">Boleh dikosongkan untuk draf.</p>
    </div>
    <div class="flex items-center gap-2 mt-6 sm:mt-0">
      <input type="checkbox" name="is_active" value="1"
             @checked(old('is_active', ($announcement->is_active ?? false)))>
      <span class="text-sm">Aktifkan</span>
    </div>
  </div>
</div>

<div class="flex items-center gap-2">
  <a href="{{ route('admin.announcements.index') }}" class="px-4 py-2 rounded border border-slate-300">Batal</a>
  <button type="submit" class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
    {{ $mode === 'create' ? 'Simpan' : 'Update' }}
  </button>
</div>
