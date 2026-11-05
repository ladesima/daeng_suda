@extends('layouts.admin')
@section('title','Pilih Desa — '.$sector->nama)
@section('pageTitle','Input OPD: '.$sector->nama)

@section('content')
<div class="max-w-5xl">

  @if(session('success'))
    <div class="mb-4 rounded border border-emerald-200 bg-emerald-50 text-emerald-700 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif

  <div class="bg-white border rounded-xl p-5">
    <div class="flex items-center justify-between gap-3 mb-4">
      <div>
        <div class="text-sm text-slate-500">Sektor Dinas</div>
        <div class="text-lg font-semibold">{{ $sector->nama }}</div>
      </div>
      <form method="get" class="flex items-center gap-2">
        <input type="text" name="q" value="{{ $search }}" placeholder="Cari desa/kecamatan..."
               class="rounded border-slate-300" />
        <button class="px-3 py-2 rounded bg-slate-800 text-white text-sm">Cari</button>
      </form>
    </div>

    <div class="border rounded overflow-hidden">
      <table class="w-full table-auto">
        <thead class="bg-slate-50 border-b">
          <tr>
            <th class="p-3 text-left text-xs uppercase">Desa/Kel</th>
            <th class="p-3 text-left text-xs uppercase">Kecamatan</th>
            <th class="p-3 text-right text-xs uppercase w-40">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y">
          @forelse($villages as $v)
            <tr>
              <td class="p-3">{{ $v->nama }}</td>
              <td class="p-3 text-slate-600">{{ $v->kecamatan ?: '—' }}</td>
              <td class="p-3 text-right">
                <a class="inline-flex items-center px-3 py-2 rounded bg-emerald-600 text-white text-sm"
                   href="{{ route('admin.opd.create', $sector).'?village_id='.$v->id }}">
                  Isi Form
                </a>
              </td>
            </tr>
          @empty
            <tr><td colspan="3" class="p-6 text-center text-slate-500">Tidak ada data desa.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">{{ $villages->links() }}</div>
  </div>
</div>
@endsection
