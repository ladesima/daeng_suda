@extends('layouts.admin')

@section('title', 'Edit Akun Admin Desa')
@section('pageTitle', 'Edit Akun Admin Desa')
@section('pageSub', 'Perbarui data akun atau setel ulang kata sandi')

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
          <h3 class="font-bold text-slate-800 text-base">Edit Akun: {{ $user->name }}</h3>
          <p class="text-xs text-slate-500">Perbarui email, wilayah desa, atau ganti password</p>
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
      action="{{ route('esdm.admin.desa-accounts.update', $user->id) }}" 
      class="space-y-4"
    >
      @csrf
      @method('PUT')

      {{-- Pilih Desa --}}
      <div>
        <label for="village_id" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Wilayah Desa / Kelurahan <span class="text-rose-500">*</span>
        </label>
        <select 
          name="village_id" 
          id="village_id" 
          required
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 bg-white"
        >
          @foreach ($villages as $v)
            <option 
              value="{{ $v->id }}" 
              {{ old('village_id', $user->village_id) == $v->id ? 'selected' : '' }}
            >
              {{ $v->nama }} - Kec. {{ $v->kecamatan }}
            </option>
          @endforeach
        </select>
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
          value="{{ old('name', $user->name) }}"
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
          value="{{ old('email', $user->email) }}"
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 font-mono"
        >
      </div>

      {{-- Password Baru (Opsional) --}}
      <div>
        <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Kata Sandi Baru (Kosongkan jika tidak ingin mengubah)
        </label>
        <input 
          type="text" 
          name="password" 
          id="password" 
          placeholder="Ketik password baru..."
          class="w-full rounded-xl border border-slate-300 text-sm px-3.5 py-2.5 text-slate-800 focus:ring-emerald-500 focus:border-emerald-500 font-mono"
        >
        <p class="text-[11px] text-slate-400 mt-1">Biarkan kosong jika tetap menggunakan kata sandi saat ini.</p>
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
          Perbarui Akun
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
