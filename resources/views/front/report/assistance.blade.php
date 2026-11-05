@extends('layouts.app')
@section('title','Permohonan Bantuan')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

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

  <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="px-6 py-5 border-b border-slate-100">
      <h1 class="text-2xl font-extrabold text-emerald-800">Permohonan Bantuan</h1>
      <p class="text-slate-600 mt-1">Ajukan bantuan sarana/prasarana SDA (mis. pompa air, perbaikan irigasi tersier, dsb.).</p>
    </div>

    <form action="{{ route('report.assistance.store') }}" method="POST" enctype="multipart/form-data" class="p-6 grid gap-6">
      @csrf

      <div>
        <h2 class="font-semibold text-slate-800 mb-3">Identitas Pemohon</h2>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Nama Pemohon <span class="text-rose-600">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}" class="form-input" required>
          </div>
          <div>
            <label class="form-label">No. HP/WA <span class="text-rose-600">*</span></label>
            <input type="tel" name="hp" value="{{ old('hp') }}" class="form-input" required>
          </div>
          <div>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" class="form-input">
          </div>
          <div>
            <label class="form-label">Alamat Singkat</label>
            <input type="text" name="alamat" value="{{ old('alamat') }}" class="form-input">
          </div>
        </div>
      </div>

      <div>
        <h2 class="font-semibold text-slate-800 mb-3">Lokasi & Kebutuhan</h2>
        <div class="grid md:grid-cols-2 gap-4">
          <div>
            <label class="form-label">Kecamatan</label>
            <input type="text" name="kecamatan" value="{{ old('kecamatan') }}" class="form-input">
          </div>
          <div>
            <label class="form-label">Desa/Kelurahan</label>
            <input type="text" name="desa" value="{{ old('desa') }}" class="form-input">
          </div>

          <div class="md:col-span-2">
            <label class="form-label">Jenis Bantuan yang Diajukan <span class="text-rose-600">*</span></label>
            <input type="text" name="jenis" value="{{ old('jenis') }}" class="form-input" placeholder="Misal: Pompa air 3 inch" required>
          </div>

          <div>
            <label class="form-label">Latitude</label>
            <input type="text" inputmode="decimal" name="lat" value="{{ old('lat') }}" class="form-input">
          </div>
          <div>
            <label class="form-label">Longitude</label>
            <input type="text" inputmode="decimal" name="lng" value="{{ old('lng') }}" class="form-input">
          </div>

          <div>
            <label class="form-label">Tingkat Urgensi <span class="text-rose-600">*</span></label>
            <select name="urgency" class="form-input" required>
              @foreach(['Rendah','Sedang','Tinggi','Kritis'] as $s)
                <option value="{{ $s }}" @selected(old('urgency')===$s)>{{ $s }}</option>
              @endforeach
            </select>
          </div>
          <div class="md:col-span-1 flex items-end">
            <button type="button" id="btn-geo2" class="btn-ghost">Deteksi Lokasi</button>
          </div>

          <div class="md:col-span-2">
            <label class="form-label">Uraian Kebutuhan <span class="text-rose-600">*</span></label>
            <textarea name="uraian" rows="5" class="form-input" required>{{ old('uraian') }}</textarea>
          </div>

          <div class="md:col-span-2">
            <label class="form-label">Lampiran (RAB/foto/pdf, opsional)</label>
            <input type="file" name="lampiran[]" multiple accept=".jpg,.jpeg,.png,.pdf" class="block w-full text-sm file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
          </div>
        </div>
      </div>

      <div class="flex items-center gap-3 pt-2">
        <a href="{{ route('home') }}" class="btn-outline">Batal</a>
        <button type="submit" class="btn-primary">Kirim Permohonan</button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
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

  const btn2 = document.getElementById('btn-geo2');
  if (btn2) btn2.addEventListener('click', ()=>{
    if (!navigator.geolocation) return alert('Geolocation tidak didukung browser.');
    btn2.disabled = true; btn2.textContent = 'Mendeteksi…';
    navigator.geolocation.getCurrentPosition(pos=>{
      document.querySelector('input[name="lat"]').value = pos.coords.latitude.toFixed(6);
      document.querySelector('input[name="lng"]').value = pos.coords.longitude.toFixed(6);
      btn2.textContent = 'Deteksi Lokasi'; btn2.disabled = false;
    }, ()=>{ btn2.textContent='Deteksi Lokasi'; btn2.disabled=false; }, {enableHighAccuracy:true, timeout:8000});
  });
</script>
@endpush
