@extends('layouts.admin')

@section('pageTitle', 'Edit Data Pegawai')
@section('pageSub', 'Memperbarui informasi pegawai yang sudah ada')

@section('content')
<div class="bg-white rounded-2xl shadow-sm">
    <div class="px-6 py-4 border-b border-slate-200">
        <h2 class="text-xl font-semibold text-slate-700">Formulir Edit Pegawai</h2>
    </div>

    <form method="POST" action="{{ route('admin.employees.update', $employee) }}" enctype="multipart/form-data" class="px-6 py-8">
        @csrf
        @method('PUT')

        <div class="space-y-6">
            {{-- NAMA --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama', $employee->nama) }}" required
                    class="block w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            </div>

            {{-- JABATAN --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Jabatan</label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $employee->jabatan) }}" required
                    class="block w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            </div>

            {{-- NIP --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $employee->nip) }}"
                    class="block w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
            </div>

            {{-- FOTO --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Foto (Opsional)</label>
                <input type="file" name="foto"
                    class="block w-full text-sm text-slate-600 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                @if($employee->foto)
                    <div class="mt-3">
                        <img src="{{ $employee->photo_url }}" alt="Foto {{ $employee->nama }}"
                            class="w-20 h-20 rounded-full object-cover border border-slate-200 shadow-2xs"
                            onerror="this.src='{{ asset('images/no-image.png') }}'">
                    </div>
                @endif
            </div>

            {{-- ATASAN --}}
            <div>
                <label class="block text-sm font-medium text-slate-600 mb-2">Atasan</label>
                <select name="atasan_id" class="block w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500">
                    <option value="">-- Tidak Ada --</option>
                    @foreach($superiors as $sup)
                        <option value="{{ $sup->id }}" {{ old('atasan_id', $employee->atasan_id) == $sup->id ? 'selected' : '' }}>
                            {{ $sup->nama }} ({{ $sup->jabatan }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- BUTTON --}}
        <div class="mt-8 pt-6 border-t border-slate-200 flex justify-end gap-4">
            <a href="{{ route('admin.employees.index') }}" class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200">Batal</a>
            <button type="submit" class="px-5 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
