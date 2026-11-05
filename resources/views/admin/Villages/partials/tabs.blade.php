{{-- resources/views/admin/villages/partials/tabs.blade.php --}}
@php
  /**
   * Wajib dipass dari create/edit:
   * - $sector  : App\Models\Sector
   * - $village : App\Models\Village|null
   *
   * Hanya render 1 bidang sesuai sektor (tanpa tab/pilihan lain).
   * Pastikan slug sektor di DB cocok dengan kunci di $map berikut.
   */
  $map = [
    'pertanian'    => 'admin.villages.partials.bidang.pertanian',
    'perkebunan'   => 'admin.villages.partials.bidang.perkebunan',
    'perikanan'    => 'admin.villages.partials.bidang.perikanan',
    'peternakan'   => 'admin.villages.partials.bidang.peternakan',
    'energi'       => 'admin.villages.partials.bidang.energi',
    'pertambangan' => 'admin.villages.partials.bidang.pertambangan',
    'kehutanan'    => 'admin.villages.partials.bidang.kehutanan',
  ];

  // Normalisasi slug sektor: pakai slug jika ada; fallback ke name lower-kebab
  $slug = trim(strtolower($sector->slug ?? ''));
  if ($slug === '') {
      $slug = str_replace(' ', '-', strtolower($sector->name ?? ''));
  }

  // Jika slug di DB berbeda (mis. 'energi-dan-ebt'), kamu bisa map manual di sini:
  $aliases = [
    'energi-dan-ebt' => 'energi',
    'galian-c'       => 'pertambangan',
    'lingkungan-hidup' => 'kehutanan',
  ];
  if (isset($aliases[$slug])) {
      $slug = $aliases[$slug];
  }

  $partial = $map[$slug] ?? null;
@endphp

@if($partial && view()->exists($partial))
  {{-- Render hanya partial bidang yang cocok --}}
  @include($partial, ['village' => $village])
@else
  {{-- Fallback jika belum ada partial --}}
  <div class="rounded-xl border border-amber-200 bg-amber-50 text-amber-800 p-4">
    Partial form untuk sektor <b>{{ $sector->name }}</b> belum tersedia.<br>
    Buat file di: <code>resources/views/admin/villages/partials/bidang/{{ $slug }}.blade.php</code><br>
    Lalu update mapping di: <code>partials/tabs.blade.php</code>.
  </div>
@endif

{{-- (Opsional) kirim info sektor sebagai hidden untuk referensi non-kritis --}}
<input type="hidden" name="_bidang_sektor" value="{{ $slug }}">
