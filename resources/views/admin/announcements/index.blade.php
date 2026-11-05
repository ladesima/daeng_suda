@extends('layouts.admin')
@section('title','Pengumuman')

@section('content')
<div class="p-6">
  <div class="flex items-center justify-between mb-4">
    <h1 class="text-xl font-semibold">Pengumuman</h1>
    <a href="{{ route('admin.announcements.create') }}"
       class="px-4 py-2 rounded-lg bg-emerald-600 text-white hover:bg-emerald-700">Tambah</a>
  </div>

  @if(session('success'))
    <div class="mb-4 rounded bg-emerald-50 text-emerald-800 px-4 py-2">{{ session('success') }}</div>
  @endif

  <div class="bg-white rounded-lg shadow border border-slate-200 overflow-hidden">
    <table class="min-w-full text-sm">
      <thead class="bg-slate-50">
        <tr>
          <th class="px-4 py-3 text-left">Judul</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Terbit</th>
          <th class="px-4 py-3 text-right">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $a)
          <tr class="border-t">
            <td class="px-4 py-3">
              <div class="font-medium text-slate-800">{{ $a->title }}</div>
              <div class="text-slate-400 text-xs">
                Publik: /pengumuman/{{ $a->slug ?? $a->id }}
              </div>
            </td>
            <td class="px-4 py-3">
              @if($a->is_active)
                <span class="inline-flex items-center px-2 py-0.5 text-xs rounded bg-emerald-100 text-emerald-700">Aktif</span>
              @else
                <span class="inline-flex items-center px-2 py-0.5 text-xs rounded bg-slate-100 text-slate-600">Nonaktif</span>
              @endif
            </td>
            <td class="px-4 py-3">{{ optional($a->published_at)->format('d M Y H:i') ?? '-' }}</td>
            <td class="px-4 py-3 text-right space-x-2">
              <a href="{{ route('admin.announcements.edit', $a) }}"
                 class="px-3 py-1.5 rounded bg-slate-800 text-white hover:bg-slate-900">Edit</a>
              <form action="{{ route('admin.announcements.destroy', $a) }}" method="POST" class="inline"
                    onsubmit="return confirm('Hapus pengumuman ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded bg-rose-600 text-white hover:bg-rose-700">Hapus</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="4" class="px-4 py-6 text-center text-slate-500">Belum ada pengumuman.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="mt-4">{{ $items->links() }}</div>
</div>
@endsection
