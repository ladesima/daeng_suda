@extends('layouts.app')
@section('title','Riwayat Pelaporan')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between">
      <div>
        <h1 class="text-2xl font-extrabold text-emerald-800">Riwayat Pelaporan</h1>
        <p class="text-slate-600 mt-1">Daftar seluruh laporan yang terkirim, diurutkan berdasarkan waktu.</p>
      </div>
      <a href="{{ route('report.emergency.create') }}" class="btn-primary">Buat Laporan Baru</a>
    </div>

    <div class="p-6 overflow-x-auto">
      @if(($timeline ?? collect())->count())
        <table class="min-w-full text-sm">
          <thead>
            <tr class="text-left text-slate-500 uppercase text-xs tracking-wider border-b">
              <th class="py-2 pr-4">Waktu</th>
              <th class="py-2 pr-4">Jenis</th>
              <th class="py-2 pr-4">Judul / Ringkas</th>
              <th class="py-2 pr-4">Kontak</th>
              <th class="py-2 pr-4">Status</th>
              <th class="py-2 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-slate-100">
            @foreach($timeline as $it)
              <tr class="hover:bg-slate-50">
                <td class="py-3 pr-4 text-slate-700">{{ $it['waktu']->format('d M Y, H:i') }}</td>
                <td class="py-3 pr-4">
                  <span class="px-2 py-0.5 rounded-full text-[11px] {{ $it['jenis']==='Emergency' ? 'bg-rose-100 text-rose-700' : 'bg-sky-100 text-sky-700' }}">
                    {{ $it['jenis'] }}
                  </span>
                </td>
                <td class="py-3 pr-4">{{ $it['judul'] }}</td>
                <td class="py-3 pr-4 text-slate-600">{{ $it['kontak'] }}</td>
                <td class="py-3 pr-4">
                  <span class="px-2 py-0.5 rounded-full text-[11px] bg-amber-100 text-amber-700">{{ $it['status'] ?? '-' }}</span>
                </td>
                <td class="py-3 text-right">
                  @if($it['jenis']==='Emergency')
                    <a href="{{ route('report.emergency.show',$it['id']) }}" class="text-emerald-700 hover:underline">Detail</a>
                  @else
                    <a href="{{ route('report.assistance.show',$it['id']) }}" class="text-emerald-700 hover:underline">Detail</a>
                  @endif
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="text-center text-slate-500 py-14">
          Belum ada data laporan.
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
