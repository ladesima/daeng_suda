@extends('layouts.desa')

@section('title', 'Laporan Kebutuhan Energi')

@section('content')
<div class="space-y-4">
  {{-- Header & Back Navigation --}}
  <div class="flex items-center gap-3">
    <a 
      href="{{ route('esdm.desa.dashboard') }}"
      class="w-9 h-9 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:text-emerald-700 hover:border-emerald-300 transition active:scale-95 shadow-xs"
      title="Kembali ke Dashboard"
    >
      <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"></line>
        <polyline points="12 19 5 12 12 5"></polyline>
      </svg>
    </a>
    <div>
      <h1 class="text-base font-bold text-slate-800 leading-tight">Laporan Kebutuhan Energi Masyarakat</h1>
      <p class="text-[11px] text-slate-500">Usulan alternatif energi: PLTS, biogas, pasokan gas, dll.</p>
    </div>
  </div>

  {{-- Card Form --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100">
      <div class="w-11 h-11 rounded-2xl bg-teal-600 text-white flex items-center justify-center text-xl shadow-xs shadow-teal-600/30">
        🔋
      </div>
      <div>
        <h2 class="font-bold text-slate-800 text-sm">Formulir Kebutuhan Energi</h2>
        <p class="text-xs text-slate-500">Pendataan kebutuhan diversifikasi & penyediaan energi desa</p>
      </div>
    </div>

    <form action="{{ route('esdm.desa.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <input type="hidden" name="type" value="kebutuhan_energi">

      {{-- Jenis Kebutuhan Energi --}}
      <div>
        <label for="jenis_kebutuhan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Jenis Kebutuhan Energi <span class="text-rose-500">*</span>
        </label>
        <select 
          name="data[jenis_kebutuhan]" 
          id="jenis_kebutuhan" 
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
          <option value="" disabled {{ old('data.jenis_kebutuhan') ? '' : 'selected' }}>-- Pilih Jenis Kebutuhan --</option>
          <option value="Listrik" {{ old('data.jenis_kebutuhan') == 'Listrik' ? 'selected' : '' }}>Listrik (Sambungan Baru / Genset Komunal)</option>
          <option value="Gas" {{ old('data.jenis_kebutuhan') == 'Gas' ? 'selected' : '' }}>Gas (Pangkalan LPG 3kg / Jargas)</option>
          <option value="Energi Surya" {{ old('data.jenis_kebutuhan') == 'Energi Surya' ? 'selected' : '' }}>Energi Surya / Solar Cell (PLTS Terpusat/Atap)</option>
          <option value="Biogas" {{ old('data.jenis_kebutuhan') == 'Biogas' ? 'selected' : '' }}>Biogas (Pemanfaatan Limbah Peternakan / Organik)</option>
          <option value="Lainnya" {{ old('data.jenis_kebutuhan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
        @error('data.jenis_kebutuhan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Jumlah KK / Kelompok Sasaran --}}
      <div>
        <label for="jumlah_kk" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Jumlah KK / Kelompok Sasaran <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
          <input 
            type="number" 
            name="data[jumlah_kk]" 
            id="jumlah_kk" 
            min="1"
            value="{{ old('data.jumlah_kk') }}"
            placeholder="Contoh: 25"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
          <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">KK / Kelompok</span>
        </div>
        @error('data.jumlah_kk')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kondisi Lapangan --}}
      <div>
        <label for="kondisi_lapangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Kondisi Lapangan Saat Ini <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[kondisi_lapangan]" 
          id="kondisi_lapangan" 
          rows="3"
          placeholder="Gambarkan situasi nyata di lapangan (misal: jarak kelompok rumah tangga jauh dari tiang PLN, pasokan gas 3kg langka dan harga mahal, potensi kotoran ternak melimpah)..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.kondisi_lapangan') }}</textarea>
        @error('data.kondisi_lapangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Usulan / Kebutuhan Penanganan --}}
      <div>
        <label for="usulan_penanganan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Usulan / Kebutuhan Penanganan <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[usulan_penanganan]" 
          id="usulan_penanganan" 
          rows="3"
          placeholder="Usulan solusi yang diharapkan (misal: pengadaan instalasi biogas skala rumah tangga, permohonan operasional pangkalan LPG desa, atau bantuan PLTS Komunal)..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.usulan_penanganan') }}</textarea>
        @error('data.usulan_penanganan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Lokasi --}}
      <div>
        <label for="lokasi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Lokasi <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="lokasi" 
          id="lokasi" 
          value="{{ old('lokasi') }}"
          placeholder="Contoh: Dusun Pegunungan Blok C, Desa Binaan"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
        @error('lokasi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Permasalahan (keterangan) --}}
      <div>
        <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Permasalahan / Kendala Tambahan <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="keterangan" 
          id="keterangan" 
          rows="3"
          placeholder="Catatan tambahan mengenai kendala ekonomi, akses jalan pengangkut, atau riwayat permohonan sebelumnya..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('keterangan') }}</textarea>
        @error('keterangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Dokumentasi Foto (Multiple with Alpine Preview) --}}
      <div 
        x-data="{
          files: [],
          handleFiles(event) {
            const selected = Array.from(event.target.files);
            this.files = selected.map(file => ({
              name: file.name,
              size: (file.size / 1024).toFixed(1) + ' KB',
              isImage: file.type.startsWith('image/'),
              url: file.type.startsWith('image/') ? URL.createObjectURL(file) : null
            }));
          }
        }" 
        class="space-y-2 pt-1"
      >
        <label class="block text-xs font-semibold text-slate-700">
          Dokumentasi Foto Lapangan / Potensi Energi
        </label>
        <div class="relative border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-2xl p-4 text-center transition bg-slate-50/60 group">
          <input 
            type="file" 
            name="attachments[]" 
            id="attachments" 
            multiple 
            accept="image/*,.pdf"
            @change="handleFiles($event)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
          >
          <div class="flex flex-col items-center pointer-events-none">
            <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <span class="text-xs font-semibold text-slate-700">Sentuh untuk pilih foto dokumentasi</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Dapat berupa foto rumah sasaran, kandang ternak biogas, atau lokasi usulan (JPG, PNG maks 5MB)</span>
          </div>
        </div>

        {{-- Preview List --}}
        <div x-show="files.length > 0" x-cloak class="mt-2.5">
          <div class="text-[11px] font-semibold text-slate-600 mb-1.5 flex items-center justify-between">
            <span>Foto terpilih:</span>
            <span class="text-teal-600" x-text="files.length + ' berkas'"></span>
          </div>
          <div class="grid grid-cols-3 gap-2">
            <template x-for="(file, index) in files" :key="index">
              <div class="relative rounded-xl border border-slate-200 bg-white p-1.5 text-center shadow-xs overflow-hidden">
                <template x-if="file.isImage">
                  <img :src="file.url" class="w-full h-16 object-cover rounded-lg mb-1">
                </template>
                <template x-if="!file.isImage">
                  <div class="w-full h-16 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 mb-1">
                    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                  </div>
                </template>
                <div class="text-[10px] font-medium text-slate-700 truncate" x-text="file.name"></div>
                <div class="text-[9px] text-slate-400" x-text="file.size"></div>
              </div>
            </template>
          </div>
        </div>
        @error('attachments')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
        @error('attachments.*')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Action Buttons --}}
      <div class="pt-3 border-t border-slate-100 space-y-2">
        <button 
          type="submit" 
          class="w-full py-3.5 px-4 rounded-2xl bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white font-bold text-sm shadow-md shadow-emerald-700/20 active:scale-[0.99] transition flex items-center justify-center gap-2"
        >
          <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="22" y1="2" x2="11" y2="13"></line>
            <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
          </svg>
          Kirim Usulan Kebutuhan Energi
        </button>
        <a 
          href="{{ route('esdm.desa.dashboard') }}"
          class="block w-full py-2.5 text-center text-xs font-semibold text-slate-500 hover:text-slate-700 transition"
        >
          Batalkan
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
