@extends('layouts.desa')

@section('title', 'Laporan PJU')

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
      <h1 class="text-base font-bold text-slate-800 leading-tight">Laporan Penerangan Jalan Umum (PJU)</h1>
      <p class="text-[11px] text-slate-500">Laporkan kondisi tiang, lampu padam, atau kebutuhan PJU</p>
    </div>
  </div>

  {{-- Card Form --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100">
      <div class="w-11 h-11 rounded-2xl bg-amber-500 text-white flex items-center justify-center text-xl shadow-xs shadow-amber-500/30">
        💡
      </div>
      <div>
        <h2 class="font-bold text-slate-800 text-sm">Formulir Laporan PJU</h2>
        <p class="text-xs text-slate-500">Isi data kondisi penerangan jalan dengan akurat</p>
      </div>
    </div>

    <form action="{{ route('esdm.desa.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <input type="hidden" name="type" value="pju">

      {{-- Jumlah Titik PJU --}}
      <div>
        <label for="jumlah_titik_pju" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Jumlah Titik PJU Eksisting <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
          <input 
            type="number" 
            name="data[jumlah_titik_pju]" 
            id="jumlah_titik_pju" 
            min="0"
            value="{{ old('data.jumlah_titik_pju') }}"
            placeholder="Contoh: 15"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
          <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
        </div>
        @error('data.jumlah_titik_pju')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kondisi --}}
      <div>
        <label for="kondisi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Kondisi PJU Saat Ini <span class="text-rose-500">*</span>
        </label>
        <select 
          name="data[kondisi]" 
          id="kondisi" 
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
          <option value="" disabled {{ old('data.kondisi') ? '' : 'selected' }}>-- Pilih Kondisi --</option>
          <option value="Baik" {{ old('data.kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
          <option value="Rusak" {{ old('data.kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak Sebagian</option>
          <option value="Tidak Berfungsi" {{ old('data.kondisi') == 'Tidak Berfungsi' ? 'selected' : '' }}>Tidak Berfungsi / Mati Total</option>
        </select>
        @error('data.kondisi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Jumlah Titik Rusak --}}
      <div>
        <label for="jumlah_rusak" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Jumlah Titik Rusak / Mati <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
          <input 
            type="number" 
            name="data[jumlah_rusak]" 
            id="jumlah_rusak" 
            min="0"
            value="{{ old('data.jumlah_rusak', 0) }}"
            placeholder="0"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
          <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
        </div>
        @error('data.jumlah_rusak')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Kebutuhan Penambahan --}}
      <div>
        <label for="kebutuhan_penambahan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Kebutuhan Penambahan Titik Baru <span class="text-rose-500">*</span>
        </label>
        <div class="relative">
          <input 
            type="number" 
            name="data[kebutuhan_penambahan]" 
            id="kebutuhan_penambahan" 
            min="0"
            value="{{ old('data.kebutuhan_penambahan', 0) }}"
            placeholder="0"
            required
            class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
          >
          <span class="absolute right-3.5 top-2.5 text-xs text-slate-400 pointer-events-none">Titik</span>
        </div>
        <p class="text-[11px] text-slate-400 mt-1">Usulan titik tiang lampu baru di wilayah desa yang masih gelap.</p>
        @error('data.kebutuhan_penambahan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Lokasi --}}
      <div>
        <label for="lokasi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Lokasi / Titik Jalan <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="lokasi" 
          id="lokasi" 
          value="{{ old('lokasi') }}"
          placeholder="Contoh: Jl. Poros Desa RT 02 / RW 01, Dusun Melati"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
        @error('lokasi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Keterangan / Permasalahan --}}
      <div>
        <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Keterangan / Permasalahan <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="keterangan" 
          id="keterangan" 
          rows="3"
          placeholder="Deskripsikan kendala PJU secara rinci (misal: bohlam pecah, kabel putus tertimpa pohon, rawan kecelakaan di malam hari)..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('keterangan') }}</textarea>
        @error('keterangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Unggah Foto (Multiple with Alpine Preview) --}}
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
          Unggah Foto Dokumentasi Lapangan
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
            <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <span class="text-xs font-semibold text-slate-700">Sentuh untuk ambil foto / pilih berkas</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Dapat memilih beberapa foto sekaligus (JPG, PNG, PDF maks 5MB)</span>
          </div>
        </div>

        {{-- Preview List --}}
        <div x-show="files.length > 0" x-cloak class="mt-2.5">
          <div class="text-[11px] font-semibold text-slate-600 mb-1.5 flex items-center justify-between">
            <span>Foto yang akan diunggah:</span>
            <span class="text-emerald-600" x-text="files.length + ' berkas'"></span>
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
          Kirim Laporan PJU
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
