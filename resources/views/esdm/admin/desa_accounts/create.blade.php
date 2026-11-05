@extends('layouts.admin')

@section('title', 'Tambah Akun Admin Desa')
@section('pageTitle', 'Tambah Akun Admin Desa')
@section('pageSub', 'Buat akun login baru untuk desa/kelurahan yang belum memiliki akun')

@section('content')
<div class="max-w-2xl">
  <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs space-y-6">
    <div class="flex items-center justify-between pb-4 border-b border-slate-100">
      <div class="flex items-center gap-3">
        <a 
          href="{{ route('esdm.admin.desa-accounts.index') }}" 
          class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition"
          title="Kembali"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        </a>
        <div>
          <h3 class="font-bold text-slate-800 text-base">Formulir Akun Desa Baru</h3>
          <p class="text-xs text-slate-500">Pilih desa dan lengkapi kredensial akses</p>
        </div>
      </div>
    </div>

    @if ($errors->any())
      <div class="p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-800 text-xs space-y-1">
        <div class="font-semibold text-rose-900">Periksa kesalahan pengisian:</div>
        <ul class="list-disc list-inside">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form 
      method="POST" 
      action="{{ route('esdm.admin.desa-accounts.store') }}" 
      class="space-y-4"
      x-data="{
        selectedVillage: '{{ old('village_id', $selectedVillageId ?? '') }}',
        updateEmailAndName(e) {
          const select = e.target;
          const text = select.options[select.selectedIndex]?.text || '';
          if (text && text.includes(' - ')) {
            const parts = text.split(' - ');
            const namaDesa = parts[0].trim();
            const namaKec = parts[1].replace('Kec. ', '').trim();
            
            const slugDesa = namaDesa.toLowerCase().replace(/[^a-z0-9]/g, '.');
            const slugKec = namaKec.toLowerCase().replace(/[^a-z0-9]/g, '.');

            if (!document.getElementById('name').value || document.getElementById('name').value.startsWith('Admin Desa')) {
              document.getElementById('name').value = 'Admin Desa ' + namaDesa;
            }
            if (!document.getElementById('email').value || document.getElementById('email').value.includes('@jeneponto.go.id')) {
              document.getElementById('email').value = `desa.${slugDesa}.${slugKec}@jeneponto.go.id`;
            }
          }
        }
      }"
    >
      @csrf

      {{-- Pilih Desa --}}
      <div>
        <label for="village_id" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Pilih Desa / Kelurahan <span class="text-rose-500">*</span>
        </label>
        <select 
          name="village_id" 
          id="village_id" 
          required
          @change="updateEmailAndName($event)"
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
        >
          <option value="" disabled {{ old('village_id', $selectedVillageId) ? '' : 'selected' }}>-- Pilih Desa / Kelurahan --</option>
          @foreach ($availableVillages as $av)
            <option 
              value="{{ $av->id }}" 
              {{ old('village_id', $selectedVillageId) == $av->id ? 'selected' : '' }}
            >
              {{ $av->nama }} - Kec. {{ $av->kecamatan }}
            </option>
          @endforeach
        </select>
        <p class="text-[11px] text-slate-400 mt-1">Hanya menampilkan desa/kelurahan yang belum memiliki akun admin desa aktif.</p>
      </div>

      {{-- Nama Akun --}}
      <div>
        <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Nama Lengkap Akun <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="name" 
          id="name" 
          required
          value="{{ old('name') }}"
          placeholder="Contoh: Admin Desa Benteng"
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500"
        >
      </div>

      {{-- Email Login --}}
      <div>
        <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Alamat Email Login <span class="text-rose-500">*</span>
        </label>
        <input 
          type="email" 
          name="email" 
          id="email" 
          required
          value="{{ old('email') }}"
          placeholder="Contoh: desa.benteng.bangkala@jeneponto.go.id"
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 font-mono"
        >
        <p class="text-[11px] text-slate-400 mt-1">Email ini akan digunakan oleh admin desa untuk login ke sistem.</p>
      </div>

      {{-- Password --}}
      <div>
        <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Password Akses <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="password" 
          id="password" 
          required
          value="{{ old('password', 'password123') }}"
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 font-mono"
        >
        <p class="text-[11px] text-slate-400 mt-1">Default standar: <code class="bg-slate-100 px-1 py-0.5 rounded text-slate-600 font-mono">password123</code>. Admin desa dapat mengubahnya nanti.</p>
      </div>

      <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
        <a 
          href="{{ route('esdm.admin.desa-accounts.index') }}" 
          class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition"
        >
          Batal
        </a>
        <button 
          type="submit" 
          class="px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold transition active:scale-95 shadow-xs"
        >
          Simpan Akun Desa
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
