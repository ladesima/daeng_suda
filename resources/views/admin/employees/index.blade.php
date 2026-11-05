@extends('layouts.admin')

@section('pageTitle', 'Kelola Data Pegawai')
@section('content')

<div class="container mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Kelola Data Pegawai</h1>
                <p class="text-sm text-gray-500 mt-1">Manajemen data pegawai dan hubungan atasan</p>
            </div>
            <a href="{{ route('admin.employees.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pegawai
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 border-b">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Foto</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Jabatan</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">NIP</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase">Atasan</th>
                        <th class="px-6 py-4 text-center w-48 text-xs font-bold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($employees as $employee)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- FOTO --}}
                        <td class="px-6 py-4">
                            <img src="{{ $employee->photo_url }}" 
                                 alt="Foto {{ $employee->nama }}" 
                                 class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-2xs"
                                 onerror="this.src='{{ asset('images/no-image.png') }}'">
                        </td>

                        {{-- DATA PEGAWAI --}}
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $employee->nama }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $employee->jabatan }}</td>
                        <td class="px-6 py-4 text-gray-700">{{ $employee->nip }}</td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $employee->atasan ? $employee->atasan->nama : '-' }}
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.employees.edit', $employee->id) }}" 
                                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.employees.destroy', $employee->id) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">Belum ada data pegawai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
