@extends('layouts.admin')

@section('pageTitle','Dashboard')
@section('pageSub','Ringkasan cepat website Anda.')

@section('content')
  {{-- Row: Stats --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
    <x-admin.stat-card title="Total Berita" :value="$stats['news']" tone="blue">
      <x-slot:icon>
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M4 6h12v12H4zM16 8h4v10a2 2 0 0 1-2 2H6" stroke="currentColor" stroke-width="2"/></svg>
      </x-slot:icon>
    </x-admin.stat-card>

    <x-admin.stat-card title="Total Artikel" :value="$stats['articles']" tone="emerald">
      <x-slot:icon>
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M4 4h10l6 6v10H4V4zm10 0v6h6" stroke="currentColor" stroke-width="2"/></svg>
      </x-slot:icon>
    </x-admin.stat-card>

    <x-admin.stat-card title="Total Galeri" :value="$stats['galleries']" tone="amber">
      <x-slot:icon>
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M4 5h16v14H4zM4 16l4-4 3 3 4-4 5 5" stroke="currentColor" stroke-width="2"/></svg>
      </x-slot:icon>
    </x-admin.stat-card>

    <x-admin.stat-card title="Jumlah Pejabat" :value="$stats['officials']" tone="rose">
      <x-slot:icon>
        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none"><path d="M16 14a4 4 0 1 0-8 0v5h8v-5zM12 4a3 3 0 1 1 0 6a3 3 0 0 1 0-6z" stroke="currentColor" stroke-width="2"/></svg>
      </x-slot:icon>
    </x-admin.stat-card>
  </div>

  {{-- Row: News + Quick Actions --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
    {{-- Berita Terbaru --}}
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
      <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold">Berita Terbaru</h3>
        <a href="{{ route('admin.news.index') }}" class="text-sm text-emerald-700 hover:underline">Lihat semua</a>
      </div>
      <ul class="divide-y divide-slate-100">
        @forelse ($latestNews as $item)
          <li class="py-3 flex items-center justify-between">
            <div class="min-w-0">
              <div class="text-sm font-medium truncate">{{ $item->title }}</div>
              <div class="text-xs text-slate-500 truncate">{{ Str::limit(strip_tags($item->content), 110) }}</div>
            </div>
            <div class="ml-3 shrink-0 text-xs text-slate-500">{{ $item->created_at->translatedFormat('d M Y') }}</div>
          </li>
        @empty
          <li class="py-8 text-center text-sm text-slate-500">Belum ada berita.</li>
        @endforelse
      </ul>
    </div>

    {{-- Aksi Cepat --}}
    <div class="space-y-3">
      <a href="{{ route('admin.news.create') }}" class="block w-full px-4 py-3 rounded-xl bg-blue-600 text-white text-center hover:opacity-90">+ Tambah Berita</a>
      <a href="{{ route('admin.news.create') }}" class="block w-full px-4 py-3 rounded-xl bg-emerald-600 text-white text-center hover:opacity-90">+ Tambah Artikel</a>
      <a href="{{ route('admin.news.create') }}" class="block w-full px-4 py-3 rounded-xl bg-amber-500 text-white text-center hover:opacity-90">+ Tambah Galeri</a>
    </div>
  </div>

  {{-- Row: Charts --}}
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-6">
    <div class="lg:col-span-2 bg-white border border-slate-200 rounded-2xl p-4">
      <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold">Kunjungan 30 Hari</h3>
        <span class="text-xs text-slate-500">Realtime</span>
      </div>
      <canvas id="visitorsChart" height="120"></canvas>
    </div>

    <div class="bg-white border border-slate-200 rounded-2xl p-4">
      <div class="flex items-center justify-between mb-3">
        <h3 class="font-semibold">Distribusi Konten</h3>
      </div>
      <canvas id="contentChart" height="120"></canvas>
    </div>
  </div>

  {{-- JS Chart --}}
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Line chart visitors
      const v = document.getElementById('visitorsChart').getContext('2d');
      new Chart(v, {
        type: 'line',
        data: {
          labels: @json($charts['visitors']['labels']),
          datasets: [{
            data: @json($charts['visitors']['data']),
            borderWidth: 2, tension: .35, fill: true, pointRadius: 0
          }]
        },
        options: { plugins:{legend:{display:false}}, scales:{x:{grid:{display:false}}} }
      });

      // Doughnut chart content
      const c = document.getElementById('contentChart').getContext('2d');
      new Chart(c, {
        type: 'doughnut',
        data: {
          labels: @json($charts['content']['labels']),
          datasets: [{ data: @json($charts['content']['data']) }]
        },
        options: { plugins:{legend:{position:'bottom'}}, cutout:'60%' }
      });
    });
  </script>
@endsection
