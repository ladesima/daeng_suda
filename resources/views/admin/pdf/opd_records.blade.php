<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data OPD — {{ $dinas->name ?? $dinas->nama ?? 'Dinas/OPD' }}</title>
  <style>
    * { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; }
    h1 { font-size: 18px; margin: 0 0 6px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; }
    th, td { border: 1px solid #ddd; padding: 6px 8px; vertical-align: top; }
    th { background:#f5f6f7; text-align:left; }
    .muted{ color:#666; }
  </style>
</head>
<body>
  <h1>Data OPD — {{ $dinas->name ?? $dinas->nama ?? '—' }}</h1>
  <div class="muted">
    Dicetak: {{ $printedAt }}
    @if(!empty($filterKec))
      • Kecamatan: <b>{{ $filterKec }}</b>
    @endif
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:110px;">Tanggal</th>
        <th style="width:200px;">Kecamatan/Desa</th>
        <th>Ringkasan</th>
        <th style="width:90px;">Status</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($records as $r)
        @php
          $tanggal = $r->tanggal ?? optional($r->created_at)->format('Y-m-d');
          $desaObj = $r->village;
          $kec     = optional($desaObj)->kecamatan ?? $r->kecamatan;
          $desa    = optional($desaObj)->nama ?? optional($desaObj)->name ?? $r->desa ?? $r->village;

          // --- RINGKASAN: ambil dari form_schema seperti di index ---
          $schemaKeys = collect($dinas->form_schema ?? [])->pluck('key')->take(3);
          $parts = [];
          foreach ($schemaKeys as $key) {
            if (isset($r->payload[$key])) {
              $val   = $r->payload[$key];
              $label = str_replace('_', ' ', $key);
              $parts[] = $label.': '.(is_numeric($val) ? number_format($val, is_float($val+0) ? 2 : 0, ',', '.') : $val);
            }
          }
          $ringkasan = $parts ? implode('  •  ', $parts) : '—';
          // ----------------------------------------------------------
          $status = strtoupper($r->status ?? 'DRAFT');
        @endphp
        <tr>
          <td>{{ $tanggal }}</td>
          <td>{{ ($kec ?: '—') }} / {{ ($desa ?: '—') }}</td>
          <td>{{ $ringkasan }}</td>
          <td>{{ $status }}</td>
        </tr>
      @empty
        <tr>
          <td colspan="4" style="text-align:center;color:#666;padding:16px;">Belum ada data.</td>
        </tr>
      @endforelse
    </tbody>
  </table>
</body>
</html>
