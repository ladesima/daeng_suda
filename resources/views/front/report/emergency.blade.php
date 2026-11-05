@extends('layouts.app')
@section('title','Laporan Kejadian Mendesak')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

  {{-- Banner sukses / error --}}
  @if(session('success'))
    <div class="mb-6 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-800 px-4 py-3">
      {{ session('success') }}
    </div>
  @endif
  @if($errors->any())
    <div class="mb-6 rounded-xl border border-rose-200 bg-rose-50 text-rose-800 px-4 py-3">
      <div class="font-semibold mb-1">Periksa kembali isian:</div>
      <ul class="list-disc list-inside text-sm">
        @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  {{-- Card --}}
  <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100">
      <h1 class="text-2xl font-extrabold text-emerald-800">Laporan Kejadian Mendesak</h1>
      <p class="text-slate-600 mt-1">
        Gunakan form ini untuk melaporkan kekeringan parah, serangan hama besar, atau pencemaran lingkungan yang
        membutuhkan intervensi cepat. Laporan akan diteruskan otomatis ke Kecamatan & OPD teknis.
      </p>
    </div>

    <form action="{{ route('report.emergency.store') }}" method="POST" enctype="multipart/form-data" class="p-6 grid gap-6">
      @csrf

      {{-- Identitas --}}
      <div>
        <h2 class="font-semibold text-slate-800 mb-3">Identitas Pelapor</h2>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Nama Pelapor <span class="text-rose-600">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-input" placeholder="Nama lengkap" required>
          </div>
          <div>
            <label class="form-label">No. HP/WA <span class="text-rose-600">*</span></label>
            <input type="tel" name="hp" value="{{ old('hp') }}" class="form-input" placeholder="08xxxx" required>
          </div>
          <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="(opsional)">
          </div>
          <div class="md:col-span-2">
            <label class="form-label">Alamat Singkat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-input" placeholder="Dusun/Jalan, patokan lokasi">
          </div>
        </div>
      </div>

      {{-- Lokasi --}}
      <div>
        <h2 class="font-semibold text-slate-800 mb-3">Lokasi Kejadian</h2>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" class="form-input" placeholder="Kecamatan">
          </div>
          <div>
            <label class="form-label">Desa/Kelurahan</label>
            <input type="text" name="desa" value="{{ old('desa') }}" class="form-input" placeholder="Desa/Kelurahan">
          </div>
          <div>
            <label class="form-label">Latitude</label>
            <input type="text" inputmode="decimal" name="lat" value="{{ old('lat') }}" class="form-input" placeholder="-5.68">
          </div>
          <div>
            <label class="form-label">Longitude</label>
            <input type="text" inputmode="decimal" name="lng" value="{{ old('lng') }}" class="form-input" placeholder="119.74">
          </div>
          <div class="md:col-span-2">
            <button type="button" id="btn-geo" class="btn-ghost">
              Deteksi Lokasi Saat Ini
            </button>
            <span class="text-xs text-slate-500 ml-2">Boleh dilewati jika tidak tersedia.</span>
          </div>
        </div>
      </div>

      {{-- Detail Kejadian --}}
      <div>
        <h2 class="font-semibold text-slate-800 mb-3">Detail Kejadian</h2>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Kategori Kejadian <span class="text-rose-600">*</span></label>
            <select name="kategori" class="form-input" required>
              <option value="" hidden>— pilih —</option>
              @foreach(['Kekeringan','Banjir','Longsor','Serangan Hama','Pencemaran','Kebakaran Hutan/Lahan','Lainnya'] as $opt)
                <option value="{{ $opt }}" @selected(old('kategori')===$opt)>{{ $opt }}</option>
              @endforeach
            </select>
          </div>
          <div>
            <label class="form-label">Tingkat Keparahan <span class="text-rose-600">*</span></label>
            <select name="severity" class="form-input" required>
              @foreach(['Rendah','Sedang','Tinggi','Kritis'] as $s)
                <option value="{{ $s }}" @selected(old('severity')===$s)>{{ $s }}</option>
              @endforeach
            </select>
          </div>
          <div class="md:col-span-2">
            <label class="form-label">Tanggal/Waktu Kejadian <span class="text-rose-600">*</span></label>
            <input type="datetime-local" name="waktu" value="{{ old('waktu') }}" class="form-input" required>
          </div>
          <div class="md:col-span-2">
            <label class="form-label">Uraian Singkat <span class="text-rose-600">*</span></label>
            <textarea name="uraian" rows="5" class="form-input" placeholder="Tuliskan ringkasan kondisi, dampak, kebutuhan mendesak…" required>{{ old('uraian') }}</textarea>
          </div>
          <div class="md:col-span-2">
            <label class="form-label">Lampiran (foto/pdf, opsional)</label>
            <input type="file" name="lampiran[]" multiple accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
            <p id="file-count" class="text-xs text-slate-500 mt-1">Tidak ada file terpilih.</p>
          </div>
        </div>
      </div>

      {{-- Action --}}
      <div class="flex items-center gap-3 pt-2">
        <a href="{{ route('home') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary">Kirim Laporan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  // util kelas kecil (sesuai style yang dipakai di projectmu)
  document.querySelectorAll('.form-input').forEach(el=>{
    el.classList.add('w-full','rounded-lg','border','border-slate-300','px-3','py-2.5','focus:outline-none','focus:ring-2','focus:ring-emerald-200','focus:border-emerald-500','bg-white');
  });
  document.querySelectorAll('.form-label').forEach(el=>{
    el.classList.add('block','text-sm','font-medium','text-slate-700','mb-1.5');
  });
  document.querySelectorAll('.btn-primary').forEach(el=>{
    el.classList.add('inline-flex','items-center','gap-2','px-4','py-2.5','rounded-lg','bg-emerald-600','text-white','hover:bg-emerald-700','shadow-sm');
  });
  document.querySelectorAll('.btn-outline').forEach(el=>{
    el.classList.add('inline-flex','items-center','gap-2','px-4','py-2.5','rounded-lg','border','border-slate-300','text-slate-700','hover:bg-slate-50');
  });
  document.querySelectorAll('.btn-ghost').forEach(el=>{
    el.classList.add('inline-flex','items-center','gap-2','px-3','py-2','rounded-lg','bg-emerald-50','text-emerald-700','hover:bg-emerald-100');
  });

  // file counter
  const fi = document.querySelector('input[type="file"][name="lampiran[]"]');
  if (fi) fi.addEventListener('change', e=>{
    const c = e.target.files?.length ?? 0;
    document.getElementById('file-count').textContent = c ? `${c} file dipilih` : 'Tidak ada file terpilih.';
  });

  // geolocation
  const btn = document.getElementById('btn-geo');
  if (btn) btn.addEventListener('click', ()=>{
    if (!navigator.geolocation) return alert('Geolocation tidak didukung browser.');
    btn.disabled = true; btn.textContent = 'Mendeteksi…';
    navigator.geolocation.getCurrentPosition(pos=>{
      document.querySelector('input[name="lat"]').value = pos.coords.latitude.toFixed(6);
      document.querySelector('input[name="lng"]').value = pos.coords.longitude.toFixed(6);
      btn.textContent = 'Deteksi Lokasi Saat Ini'; btn.disabled = false;
    }, err=>{
      alert('Gagal mendeteksi lokasi. Izinkan akses lokasi dan coba lagi.');
      btn.textContent = 'Deteksi Lokasi Saat Ini'; btn.disabled = false;
    }, {enableHighAccuracy:true, timeout:8000});
  });
</script>
@endpush
