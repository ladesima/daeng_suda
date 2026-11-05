@extends('layouts.admin')

@section('title', 'Kelola Akun Admin Desa')
@section('pageTitle', 'Kelola Akun Admin Desa')
@section('pageSub', 'Manajemen akun desa/kelurahan untuk pelaporan modul ESDM Kabupaten Jeneponto')

@section('content')
<div class="space-y-6">
  {{-- Flash message --}}
  @if (session('success'))
    <div class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm flex items-center justify-between shadow-xs">
      <div class="flex items-center gap-2.5">
        <svg class="w-5 h-5 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span class="font-medium">{{ session('success') }}</span>
      </div>
    </div>
  @endif

  @if (session('error'))
    <div class="p-4 rounded-2xl bg-rose-50 border border-rose-200 text-rose-800 text-sm flex items-center justify-between shadow-xs">
      <div class="flex items-center gap-2.5">
        <svg class="w-5 h-5 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        <span class="font-medium">{{ session('error') }}</span>
      </div>
    </div>
  @endif

  {{-- STATS CARDS & ACTIONS --}}
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    {{-- Total Desa --}}
    <div class="bg-white rounded-2xl p-5 border border-slate-200/80 shadow-xs flex items-center gap-4">
      <div class="w-12 h-12 rounded-xl bg-slate-100 text-slate-700 flex items-center justify-center text-xl shrink-0">
        🏛️
      </div>
      <div>
        <div class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Desa / Kelurahan</div>
        <div class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalDesa }}</div>
        <div class="text-[11px] text-slate-500">11 Kecamatan se-Jeneponto</div>
      </div>
    </div>

    {{-- Desa Memiliki Akun --}}
    <div class="bg-white rounded-2xl p-5 border border-emerald-200/80 shadow-xs flex items-center gap-4">
      <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center text-xl shrink-0">
        ✅
      </div>
      <div>
        <div class="text-xs font-semibold uppercase tracking-wider text-emerald-600">Sudah Memiliki Akun</div>
        <div class="text-2xl font-bold text-emerald-700 mt-0.5">{{ $totalAkun }}</div>
        <div class="text-[11px] text-emerald-600/80">{{ round(($totalAkun / max(1, $totalDesa)) * 100) }}% desa aktif</div>
      </div>
    </div>

    {{-- Belum Memiliki Akun --}}
    <div class="bg-white rounded-2xl p-5 border border-amber-200/80 shadow-xs flex items-center gap-4">
      <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center text-xl shrink-0">
        ⏳
      </div>
      <div>
        <div class="text-xs font-semibold uppercase tracking-wider text-amber-600">Belum Punya Akun</div>
        <div class="text-2xl font-bold text-amber-700 mt-0.5">{{ $belumPunyaAkun }}</div>
        <div class="text-[11px] text-amber-600/80">Perlu dibuatkan akses</div>
      </div>
    </div>
  </div>

  {{-- TOP ACTIONS & FILTER BAR --}}
  <div class="bg-white rounded-2xl border border-slate-200/80 p-5 shadow-xs space-y-4">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 pb-4 border-b border-slate-100">
      <div>
        <h3 class="font-bold text-slate-800 text-base">Daftar Akun Desa & Kelurahan</h3>
        <p class="text-xs text-slate-500">Kelola kredensial login akun admin desa untuk input data ESDM</p>
      </div>

      <div class="flex items-center gap-2.5 w-full sm:w-auto">
        <a 
          href="{{ route('esdm.admin.desa-accounts.create') }}" 
          class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition active:scale-95 shadow-xs"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          Tambah Akun Manual
        </a>

        @if ($belumPunyaAkun > 0)
          <form 
            method="POST" 
            action="{{ route('esdm.admin.desa-accounts.generate-all') }}"
            onsubmit="return confirm('Apakah Anda ingin membuat akun otomatis untuk {{ $belumPunyaAkun }} desa yang belum memiliki akun? Password default akan disetel menjadi: password123')"
          >
            @csrf
            <button 
              type="submit" 
              class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold transition active:scale-95 shadow-xs"
              title="Buat akun untuk semua desa yang belum punya akun sekaligus"
            >
              <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v4M12 18v4M4.93 4.93l2.83 2.83M16.24 16.24l2.83 2.83M2 12h4M18 12h4M4.93 19.07l2.83-2.83M16.24 7.76l2.83-2.83"/></svg>
              Buat Otomatis ({{ $belumPunyaAkun }})
            </button>
          </form>
        @endif
      </div>
    </div>

    {{-- Filter Form --}}
    <form method="GET" action="{{ route('esdm.admin.desa-accounts.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 pt-1">
      {{-- Kecamatan --}}
      <div class="sm:col-span-4">
        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Kecamatan</label>
        <select 
          name="kecamatan" 
          class="w-full rounded-xl border border-slate-300 text-xs px-3 py-2 text-slate-700 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
        >
          <option value="">-- Semua Kecamatan --</option>
          @foreach ($kecamatans as $kec)
            <option value="{{ $kec }}" {{ $kecamatanFilter == $kec ? 'selected' : '' }}>{{ $kec }}</option>
          @endforeach
        </select>
      </div>

      {{-- Status Akun --}}
      <div class="sm:col-span-3">
        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Status Akun</label>
        <select 
          name="status" 
          class="w-full rounded-xl border border-slate-300 text-xs px-3 py-2 text-slate-700 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
        >
          <option value="">-- Semua Status --</option>
          <option value="registered" {{ $statusFilter == 'registered' ? 'selected' : '' }}>Sudah Memiliki Akun</option>
          <option value="unregistered" {{ $statusFilter == 'unregistered' ? 'selected' : '' }}>Belum Memiliki Akun</option>
        </select>
      </div>

      {{-- Search --}}
      <div class="sm:col-span-3">
        <label class="block text-[11px] font-semibold text-slate-500 uppercase tracking-wider mb-1">Cari Desa / Email</label>
        <input 
          type="text" 
          name="q" 
          value="{{ $search }}" 
          placeholder="Nama desa atau email..."
          class="w-full rounded-xl border border-slate-300 text-xs px-3 py-2 text-slate-700 placeholder:text-slate-400 focus:ring-emerald-500 focus:border-emerald-500"
        >
      </div>

      {{-- Buttons --}}
      <div class="sm:col-span-2 flex items-end gap-2">
        <button 
          type="submit" 
          class="flex-1 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold transition text-center"
        >
          Filter
        </button>
        @if ($kecamatanFilter || $statusFilter || $search)
          <a 
            href="{{ route('esdm.admin.desa-accounts.index') }}" 
            class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-semibold transition"
            title="Reset Filter"
          >
            Reset
          </a>
        @endif
      </div>
    </form>
  </div>

  {{-- TABLE --}}
  <div class="bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50/80 text-slate-600 font-semibold border-b border-slate-200/80 uppercase tracking-wider text-[11px]">
          <tr>
            <th class="py-3.5 px-4 w-12 text-center">No</th>
            <th class="py-3.5 px-4">Desa / Kelurahan</th>
            <th class="py-3.5 px-4">Kecamatan</th>
            <th class="py-3.5 px-4">Status Akun</th>
            <th class="py-3.5 px-4">Nama Akun & Email Login</th>
            <th class="py-3.5 px-4 text-center w-40">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          @forelse ($villages as $idx => $v)
            <tr class="hover:bg-slate-50/80 transition">
              <td class="py-3.5 px-4 text-center text-slate-400 font-medium">
                {{ $villages->firstItem() + $idx }}
              </td>
              <td class="py-3.5 px-4">
                <span class="font-bold text-slate-800">{{ $v->village_nama }}</span>
              </td>
              <td class="py-3.5 px-4">
                <span class="inline-flex items-center gap-1 text-slate-600">
                  <svg class="w-3.5 h-3.5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                  {{ $v->village_kecamatan }}
                </span>
              </td>
              <td class="py-3.5 px-4">
                @if ($v->user_id)
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-[11px] font-semibold border border-emerald-200/70">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                    Akun Aktif
                  </span>
                @else
                  <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-[11px] font-semibold border border-amber-200/70">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    Belum Dibuat
                  </span>
                @endif
              </td>
              <td class="py-3.5 px-4">
                @if ($v->user_id)
                  <div>
                    <div class="font-medium text-slate-800">{{ $v->user_name }}</div>
                    <div class="text-[11px] text-slate-500 font-mono flex items-center gap-1 mt-0.5">
                      <svg class="w-3 h-3 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                      {{ $v->user_email }}
                    </div>
                  </div>
                @else
                  <span class="text-slate-400 italic">Belum ada akun pengguna</span>
                @endif
              </td>
              <td class="py-3.5 px-4 text-center">
                @if ($v->user_id)
                  <div class="flex items-center justify-center gap-1.5">
                    {{-- Edit --}}
                    <a 
                      href="{{ route('esdm.admin.desa-accounts.edit', $v->user_id) }}" 
                      class="p-1.5 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 transition"
                      title="Edit Akun"
                    >
                      <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    </a>

                    {{-- Reset Password --}}
                    <form 
                      method="POST" 
                      action="{{ route('esdm.admin.desa-accounts.reset-password', $v->user_id) }}" 
                      class="inline"
                      onsubmit="return confirm('Reset password akun {{ $v->user_name }} ke password default: password123 ?')"
                    >
                      @csrf
                      <button 
                        type="submit" 
                        class="p-1.5 rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-700 transition"
                        title="Reset Password ke: password123"
                      >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                      </button>
                    </form>

                    {{-- Delete --}}
                    <form 
                      method="POST" 
                      action="{{ route('esdm.admin.desa-accounts.destroy', $v->user_id) }}" 
                      class="inline"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ $v->user_name }}?')"
                    >
                      @csrf
                      @method('DELETE')
                      <button 
                        type="submit" 
                        class="p-1.5 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 transition"
                        title="Hapus Akun"
                      >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
                      </button>
                    </form>
                  </div>
                @else
                  <a 
                    href="{{ route('esdm.admin.desa-accounts.create', ['village_id' => $v->village_id]) }}" 
                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-700 font-semibold text-[11px] transition active:scale-95 border border-emerald-200/80"
                  >
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Buat Akun
                  </a>
                @endif
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-8 text-center text-slate-400">
                Tidak ada data desa/kelurahan yang cocok dengan filter pencarian.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    {{-- Pagination --}}
    @if ($villages->hasPages())
      <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
        {{ $villages->links() }}
      </div>
    @endif
  </div>
</div>
@endsection
