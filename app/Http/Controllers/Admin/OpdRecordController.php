<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DinasSector;   // OPD (punya form_schema)
use App\Models\Village;       // Desa umum (dari modul Sector->Villages)
use App\Models\OpdRecord;     // Tabel penyimpanan data OPD per desa

class OpdRecordController extends Controller
{
    /** LIST data OPD untuk satu DinasSector (bisa filter desa & tahun) */
    public function index(Request $request, DinasSector $sector)
    {
        $villageId = $request->integer('village_id');
        $tahun     = $request->integer('tahun');

        $rows = OpdRecord::query()
            ->with('village')                      // relasi ke desa utk ditampilkan
            ->where('dinas_sector_id', $sector->id)
            ->when($villageId, fn ($q) => $q->where('village_id', $villageId))
            ->when($tahun,     fn ($q) => $q->where('periode_tahun', $tahun))
            ->latest('tanggal')
            ->latest()                              // fallback created_at
            ->paginate(15)
            ->withQueryString();

        return view('admin.opd.index', [
            'sector'  => $sector,   // dipakai judul & schema ringkasan
            'rows'    => $rows,     // <-- perbaiki error Undefined $rows
            'filters' => ['village_id' => $villageId, 'tahun' => $tahun],
        ]);
    }

    /** PICK: pilih desa sebelum input data OPD (dipanggil dari tombol "Input Data") */
    public function pickVillage(Request $request, \App\Models\DinasSector $sector)
{
    $search = trim((string) $request->query('s', ''));   // ambil query ?s=

    $villages = \App\Models\Village::query()
        ->when($search !== '', function ($q) use ($search) {
            $q->where('nama', 'like', "%{$search}%")
              ->orWhere('kecamatan', 'like', "%{$search}%");
        })
        ->orderBy('kecamatan')->orderBy('nama')
        ->paginate(12)
        ->withQueryString();

    return view('admin.opd.pick_village', compact('sector','villages','search'));
}


    /** FORM input data OPD untuk desa terpilih */
    public function create(DinasSector $sector, Village $village)
    {
        return view('admin.opd.create', [
            'sector'  => $sector,
            'village' => $village,
            'schema'  => $sector->form_schema ?? [],
        ]);
    }

    /** SIMPAN data OPD (schema-driven) */
    public function store(Request $request, DinasSector $sector, Village $village)
    {
        $rules = [
            'periode_tahun' => ['nullable','integer','min:2000','max:2100'],
            'tanggal'       => ['nullable','date'],
            'status'        => ['nullable','in:draft,published'],
        ];
        foreach (($sector->form_schema ?? []) as $f) {
            $k = $f['key']; $t = $f['type'] ?? 'text';
            $r = ['nullable'];
            $r[] = $t === 'number' ? 'numeric' : 'string';
            $rules[$k] = $r;
        }
        $data = $request->validate($rules);

        $payload = [];
        foreach (($sector->form_schema ?? []) as $f) {
            $k = $f['key']; $payload[$k] = $data[$k] ?? null;
            unset($data[$k]);
        }

        OpdRecord::create([
            'dinas_sector_id' => $sector->id,
            'village_id'      => $village->id,
            'kecamatan'       => $village->kecamatan,
            'periode_tahun'   => $data['periode_tahun'] ?? now()->year,
            'tanggal'         => $data['tanggal'] ?? now()->toDateString(),
            'payload'         => $payload,
            'lampiran'        => null,
            'status'          => $data['status'] ?? 'draft',
        ]);

        return redirect()->route('admin.opd.index', $sector->slug)
            ->with('success', 'Data OPD tersimpan untuk desa '.$village->nama.'.');
    }

    /** EDIT & UPDATE (opsional, jika sudah kamu siapkan view-nya) */
    public function edit(OpdRecord $record)
    {
        $record->load(['sector','village']);
        $schema = $record->sector->form_schema ?? [];

        return view('admin.opd.edit', compact('record','schema'));
    }

    public function update(Request $request, OpdRecord $record)
    {
        $sector = $record->sector; // relasi belongsTo
        $rules = [
            'periode_tahun' => ['nullable','integer','min:2000','max:2100'],
            'tanggal'       => ['nullable','date'],
            'status'        => ['nullable','in:draft,published'],
        ];
        foreach (($sector->form_schema ?? []) as $f) {
            $k = $f['key']; $t = $f['type'] ?? 'text';
            $r = ['nullable']; $r[] = $t === 'number' ? 'numeric' : 'string';
            $rules[$k] = $r;
        }
        $data = $request->validate($rules);

        $payload = $record->payload ?? [];
        foreach (($sector->form_schema ?? []) as $f) {
            $k = $f['key']; $payload[$k] = $data[$k] ?? null;
            unset($data[$k]);
        }

        $record->update([
            'periode_tahun' => $data['periode_tahun'] ?? $record->periode_tahun,
            'tanggal'       => $data['tanggal'] ?? $record->tanggal,
            'payload'       => $payload,
            'status'        => $data['status'] ?? $record->status,
        ]);

        return back()->with('success','Data OPD diperbarui.');
    }
}
