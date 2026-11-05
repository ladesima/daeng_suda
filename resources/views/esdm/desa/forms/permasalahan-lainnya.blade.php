@extends('layouts.desa')

@section('title', 'Laporan Permasalahan Lainnya')

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
      <h1 class="text-base font-bold text-slate-800 leading-tight">Laporan Permasalahan ESDM Lainnya</h1>
      <p class="text-[11px] text-slate-500">Isu migas, BBM, pertambangan rakyat, atau kejadian darurat</p>
    </div>
  </div>

  {{-- Card Form --}}
  <div class="bg-white rounded-3xl border border-slate-200/80 p-5 shadow-xs">
    <div class="flex items-center gap-3 pb-4 mb-4 border-b border-slate-100">
      <div class="w-11 h-11 rounded-2xl bg-rose-600 text-white flex items-center justify-center text-xl shadow-xs shadow-rose-600/30">
        ⚠️
      </div>
      <div>
        <h2 class="font-bold text-slate-800 text-sm">Formulir Permasalahan ESDM</h2>
        <p class="text-xs text-slate-500">Laporkan temuan masalah energi dan sumber daya mineral desa</p>
      </div>
    </div>

    <form action="{{ route('esdm.desa.report.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
      @csrf
      <input type="hidden" name="type" value="permasalahan_lainnya">

      {{-- Jenis Permasalahan --}}
      <div>
        <label for="jenis_permasalahan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Jenis Permasalahan <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="data[jenis_permasalahan]" 
          id="jenis_permasalahan" 
          value="{{ old('data.jenis_permasalahan') }}"
          placeholder="Contoh: Kelangkaan Gas LPG 3Kg / Penambangan Liar / Kabel Putus Terbakar"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
        @error('data.jenis_permasalahan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Tingkat Urgensi --}}
      <div>
        <label for="tingkat_urgensi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Tingkat Urgensi <span class="text-rose-500">*</span>
        </label>
        <select 
          name="tingkat_urgensi" 
          id="tingkat_urgensi" 
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
          <option value="" disabled {{ old('tingkat_urgensi') ? '' : 'selected' }}>-- Pilih Tingkat Urgensi --</option>
          <option value="rendah" {{ old('tingkat_urgensi') == 'rendah' ? 'selected' : '' }}>🟢 Rendah (Informasi / Perlu Pemantauan Berkala)</option>
          <option value="sedang" {{ old('tingkat_urgensi') == 'sedang' ? 'selected' : '' }}>🟡 Sedang (Mengganggu kenyamanan warga / Perlu Solusi Segera)</option>
          <option value="tinggi" {{ old('tingkat_urgensi') == 'tinggi' ? 'selected' : '' }}>🔴 Tinggi / Mendesak (Membahayakan keselamatan / Krisis pasokan)</option>
        </select>
        @error('tingkat_urgensi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Uraian Masalah --}}
      <div>
        <label for="uraian_masalah" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Uraian Masalah <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[uraian_masalah]" 
          id="uraian_masalah" 
          rows="3"
          placeholder="Jelaskan secara kronologis masalah yang terjadi..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.uraian_masalah') }}</textarea>
        @error('data.uraian_masalah')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Fakta Lapangan --}}
      <div>
        <label for="fakta_lapangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Fakta Lapangan <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[fakta_lapangan]" 
          id="fakta_lapangan" 
          rows="2"
          placeholder="Data atau temuan riil di lapangan (misal: antrean panjang warga, harga eceran mencapai Rp 35.000, atau tebing longsor akibat galian)..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.fakta_lapangan') }}</textarea>
        @error('data.fakta_lapangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Dampak Terhadap Masyarakat --}}
      <div>
        <label for="dampak_masyarakat" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Dampak Terhadap Masyarakat <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[dampak_masyarakat]" 
          id="dampak_masyarakat" 
          rows="2"
          placeholder="Bagaimana dampak langsung terhadap mata pencaharian, keselamatan, atau kesehatan warga desa..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.dampak_masyarakat') }}</textarea>
        @error('data.dampak_masyarakat')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Usulan Penyelesaian dari Desa --}}
      <div>
        <label for="usulan_penyelesaian" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Usulan Penyelesaian dari Desa <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="data[usulan_penyelesaian]" 
          id="usulan_penyelesaian" 
          rows="2"
          placeholder="Saran tindak lanjut atau rekomendasi penanganan oleh dinas terkait..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('data.usulan_penyelesaian') }}</textarea>
        @error('data.usulan_penyelesaian')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Lokasi --}}
      <div>
        <label for="lokasi" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Lokasi Kejadian / Objek <span class="text-rose-500">*</span>
        </label>
        <input 
          type="text" 
          name="lokasi" 
          id="lokasi" 
          value="{{ old('lokasi') }}"
          placeholder="Contoh: Bantaran Sungai Dusun Krajan / Pangkalan Gas RT 02"
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >
        @error('lokasi')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Keterangan Tambahan --}}
      <div>
        <label for="keterangan" class="block text-xs font-semibold text-slate-700 mb-1.5">
          Keterangan Tambahan <span class="text-rose-500">*</span>
        </label>
        <textarea 
          name="keterangan" 
          id="keterangan" 
          rows="3"
          placeholder="Catatan tambahan, pihak-pihak yang sudah dihubungi di lapangan, dll..."
          required
          class="w-full rounded-xl border border-slate-300 px-3.5 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"
        >{{ old('keterangan') }}</textarea>
        @error('keterangan')
          <p class="text-rose-600 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      {{-- Bukti Foto / Dokumen (Multiple with Alpine Preview) --}}
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
          Bukti Foto / Dokumen Pendukung
        </label>
        <div class="relative border-2 border-dashed border-slate-300 hover:border-emerald-500 rounded-2xl p-4 text-center transition bg-slate-50/60 group">
          <input 
            type="file" 
            name="attachments[]" 
            id="attachments" 
            multiple 
            accept="image/*,.pdf,.doc,.docx"
            @change="handleFiles($event)"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
          >
          <div class="flex flex-col items-center pointer-events-none">
            <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
              <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
              </svg>
            </div>
            <span class="text-xs font-semibold text-slate-700">Sentuh untuk unggah foto / bukti berkas</span>
            <span class="text-[11px] text-slate-400 mt-0.5">Dapat berupa foto objek masalah, berita acara, atau rekaman kondisi (JPG, PNG, PDF maks 5MB)</span>
          </div>
        </div>

        {{-- Preview List --}}
        <div x-show="files.length > 0" x-cloak class="mt-2.5">
          <div class="text-[11px] font-semibold text-slate-600 mb-1.5 flex items-center justify-between">
            <span>Berkas terpilih:</span>
            <span class="text-rose-600" x-text="files.length + ' berkas'"></span>
          </div>
          <div class="grid grid-cols-3 gap-2">
            <template x-for="(file, index) in files" :key="index">
              <div class="relative rounded-xl border border-slate-200 bg-white p-1.5 text-center shadow-xs overflow-hidden">
                <template x-if="file.isImage">
                  <img :src="file.url" class="w-full h-16 object-cover rounded-lg mb-1">
                </template>
                <template x-if="!file.isImage">
                  <div class="w-full h-16 bg-rose-50 rounded-lg flex items-center justify-center text-rose-600 mb-1">
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
          Kirim Laporan Permasalahan
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
