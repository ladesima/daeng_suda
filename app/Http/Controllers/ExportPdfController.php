<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;   
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Sector;
use App\Models\DinasSector;
use App\Models\Village;
use App\Models\OpdRecord;


class ExportPdfController extends Controller
{
    // Export data sektor
    public function sektor()
    {
        $data = Sector::all();
        $pdf = Pdf::loadView('admin.pdf.sectors', ['data' => $data]);
        return $pdf->download('data-sektor.pdf');
    }

    // Export data dinas
    public function dinas()
    {
        $data = DinasSector::all();
        $pdf = Pdf::loadView('admin.pdf.dinas', ['data' => $data]);
        return $pdf->download('data-dinas.pdf');
    }

    // Export data village
   public function villageOne(Sector $sector, Village $village)
    {
        // Pastikan desa memang milik sektor yang diakses
        abort_unless($village->sector_id === $sector->id, 404);

        // Jika ada relasi yang mau ditampilkan, load di sini
        // $village->load(['opdRecords']);

        $data = [
            'appName'   => config('app.name', 'DAENG SUDA'),
            'sector'    => $sector,
            'village'   => $village,
            'printedAt' => now()->format('d M Y H:i'),
        ];

        $pdf = Pdf::loadView('admin.pdf.villages', $data)
                  ->setPaper('a4', 'portrait'); // 'landscape' kalau tabel lebar

        $file = Str::slug("desa-{$village->name}-{$sector->name}") . '.pdf';
        return $pdf->download($file);   // atau ->stream($file) untuk tampil di tab
    }

  public function opdByDinas(DinasSector $dinasSector, Request $request)
{
    $kec = trim((string) $request->query('kecamatan'));   // dari ?kecamatan=...

    $query = OpdRecord::query()
        ->where('dinas_sector_id', $dinasSector->id)
        ->with('village')                                  // eager load desa
        ->when($kec !== '', function ($q) use ($kec) {
            // filter LEWAT RELASI VILLAGE (kolom villages.kecamatan)
            $q->whereHas('village', function ($v) use ($kec) {
                $v->where('kecamatan', $kec);
            });
        });

    // urutkan pakai kolom yang ada di model kamu (tanggal)
    $records = $query->orderByDesc('tanggal')->orderByDesc('created_at')->get();

    $data = [
        'appName'    => config('app.name', 'DAENG SUDA'),
        'printedAt'  => now()->format('d M Y H:i'),
        'dinas'      => $dinasSector,
        'records'    => $records,
        'filterKec'  => $kec !== '' ? $kec : null,
    ];

    $pdf = Pdf::setOptions([
            'isRemoteEnabled' => false,
            'dpi'             => 96,
            'defaultFont'     => 'DejaVu Sans',
        ])
        ->loadView('admin.pdf.opd_records', $data)
        ->setPaper('a4', 'portrait');

    $suffix = $kec !== '' ? '-kec-'.Str::slug($kec) : '';
    return $pdf->download(Str::slug('opd-'.$dinasSector->name).$suffix.'.pdf');
}
}
