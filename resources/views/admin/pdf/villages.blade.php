<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Desa - {{ $village->nama ?? $village->name ?? 'Desa' }}</title>
  <style>
    * { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
    h1 { font-size: 18px; margin: 0 0 6px; }
    h2 { font-size: 14px; margin: 12px 0 6px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 6px 8px; vertical-align: top; }
    th { background: #f5f6f7; text-align: left; }
    .muted { color: #666; }
    .w180 { width: 180px; }
    .header { display: flex; justify-content: space-between; align-items: center; }
  </style>
</head>
<body>
  <div class="header">
    <div>
     <h1>DAENG SUDA — Data Desa</h1>
      <div class="muted">Sektor: {{ $sector->name ?? '-' }} • Dicetak: {{ $printedAt ?? now()->format('d M Y H:i') }}</div>
    </div>
  </div>

  @php
    $nama       = $village->nama ?? $village->name ?? null;
    $kecamatan  = $village->kecamatan ?? null;
    $penduduk   = $village->jumlah_penduduk ?? $village->penduduk ?? null;
    $umkm       = $village->kelompok_umkm ?? $village->umkm ?? null;
    $cp         = $village->kontak_person ?? $village->cp ?? null;
    $updated    = optional($village->updated_at)->format('d M Y');
  @endphp

  <table>
    <tr><th class="w180">Desa/Kelurahan</th><td>{{ $nama ?? '—' }}</td></tr>
    <tr><th>Kecamatan</th><td>{{ $kecamatan ?? '—' }}</td></tr>
    <tr><th>Penduduk</th><td>{{ $penduduk !== null ? number_format($penduduk, 0, ',', '.') : '—' }}</td></tr>
    <tr><th>UMKM</th><td>{{ $umkm ?? '—' }}</td></tr>
    <tr><th>Contact Person</th><td>{{ $cp ?? '—' }}</td></tr>
    <tr><th>Terakhir Diubah</th><td>{{ $updated ?? '—' }}</td></tr>
  </table>

  @if(method_exists($village,'opdRecords') && $village->opdRecords()->exists())
    <h2>Data OPD</h2>
    <table>
      <thead>
        <tr>
          <th style="width:70px;">Tahun</th>
          <th>Uraian</th>
          <th style="width:120px;">Nilai</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @foreach($village->opdRecords as $r)
          <tr>
            <td>{{ $r->year }}</td>
            <td>{{ $r->title ?? '—' }}</td>
            <td>{{ $r->value !== null ? number_format($r->value, 0, ',', '.') : '—' }}</td>
            <td>{{ $r->notes ?? '—' }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endif
</body>
</html>
