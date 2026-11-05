@extends('layouts.admin')

@section('pageTitle', 'Kelola Kepala Daerah')
@section('content')

<div class="container mx-auto px-4 py-6">

    {{-- Header --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Kepala Daerah</h1>
                <p class="text-sm text-gray-500 mt-1">Manajemen data kepala daerah aktif di sistem</p>
            </div>
            <a href="{{ route('admin.leaders.create') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition-all duration-200 hover:shadow-md">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Kepala Daerah
            </a>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full table-auto">
                <thead>
                    <tr class="bg-gray-50 border-b-2 border-gray-200">
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Foto</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Jabatan</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Visi</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase">Misi</th>
                        <th class="px-6 py-3 text-center text-xs font-bold text-gray-700 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($leaders as $leader)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <img
                                src="{{ $leader->photo_url }}"
                                alt="{{ $leader->nama }}"
                                class="w-16 h-20 object-cover rounded-lg border border-gray-200 shadow-sm"
                                onerror="this.src='{{ asset('images/no-image.png') }}'"
                            >
                        </td>
                        <td class="px-6 py-4 text-sm font-semibold text-gray-900">{{ $leader->nama }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $leader->jabatan }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">{{ $leader->visi }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 max-w-md truncate whitespace-pre-line">{{ $leader->misi }}</td>
                        <td class="px-6 py-4">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.leaders.edit', $leader) }}" 
                                   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-medium rounded-lg shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.leaders.destroy', $leader) }}" method="POST" 
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-medium rounded-lg shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                            Belum ada data kepala daerah.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection