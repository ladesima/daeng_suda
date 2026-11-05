@extends('layouts.app')
@section('title','Riwayat Permohonan Bantuan')

@section('content')
<section class="section py-10">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-2xl md:text-3xl font-extrabold text-emerald-800">Riwayat Permohonan Bantuan</h1>
        <p class="text-slate-600 mt-1">Semua permohonan sarana/prasarana yang telah diajukan.</p>
      </div>
      <a href="{{ route('report.assistance.create') }}" class="btn-primary">Ajukan Permohonan</a>
    </div>

    <div class="mt-6 bg-white border rounded-xl overflow-hidden">
      <div class="overflow-x-auto">
        <table class="min-w-full text-sm">
          <thead class="bg-slate-50">
            <tr class="text-left">
              <th class="px-4 py-3">Kode</th>
              <th class="px-4 py-3">Pemohon</th>
              <th class="px-4 py-3">Kontak</th>
              <th class="px-4 py-3">Wilayah</th>
              <th class="px-4 py-3">Jenis Bantuan</th>
              <th class="px-4 py-3">Urgensi</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Diajukan</th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $r)
              <tr class="border-t">
                <td class="px-4 py-3 font-medium text-slate-900">{{ $r->kode }}</td>
                <td class="px-4 py-3">{{ $r->nama }}</td>
                <td class="px-4 py-3">{{ $r->hp }}</td>
                <td class="px-4 py-3">{{ $r->kecamatan ?? '-' }}{{ $r->desa ? ', '.$r->desa : '' }}</td>
                <td class="px-4 py-3">{{ $r->jenis }}</td>
                <td class="px-4 py-3">
                  <span class="inline-flex px-2 py-0.5 rounded-full text-xs
                    @class([
                      'bg-rose-50 text-rose-700 ring-1 ring-rose-200'   => $r->urgency === 'tinggi',
                      'bg-amber-50 text-amber-700 ring-1 ring-amber-200'=> $r->urgency === 'sedang',
                      'bg-emerald-50 text-emerald-700 ring-1 ring-emerald-200'=> $r->urgency === 'rendah',
                    ])">
                    {{ ucfirst($r->urgency) }}
                  </span>
                </td>
                <td class="px-4 py-3">{{ ucfirst($r->status ?? 'baru') }}</td>
                <td class="px-4 py-3">{{ optional($r->created_at)->format('d M Y H:i') }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="8" class="px-4 py-10 text-center text-slate-500">
                  Belum ada permohonan bantuan.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="p-4 border-t">
        {{ $items->links() }}
      </div>
    </div>
  </div>
</section>
@endsection
