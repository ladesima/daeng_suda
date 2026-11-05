<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

use App\Models\Sector;        // Sektor Desa
use App\Models\DinasSector;   // Sektor OPD
use App\Models\Village;       // Desa
use App\Models\OpdRecord;     // Data OPD per desa

class PublicSectorController extends Controller
{
    /**
     * Halaman gabungan: Sektor Desa + Sektor OPD
     * Route name: sectors.all  (GET /potensi)
     */
    public function indexAll(Request $request)
    {
        // ===== Sektor Desa (ikutkan jumlah desa)
        $desaSectors = Sector::query()
            ->orderBy('name')                 // ganti ke kolom lain jika perlu
            ->withCount('villages')
            ->paginate(12, ['*'], 'desa_page');

        // ===== Sektor OPD (selalu tarik semua OPD; records_count bisa 0)
        $opdTable = (new DinasSector)->getTable();

        $opdSectors = DinasSector::query()
            ->when(
                Schema::hasColumn($opdTable, 'display_order'),
                fn ($q) => $q->orderBy('display_order'),
                fn ($q) => Schema::hasColumn($opdTable, 'nama')
                        ? $q->orderBy('nama')
                        : $q->orderBy('id')
            )
            ->withCount('records')            // aman: 0 jika belum ada record
            ->paginate(12, ['*'], 'opd_page');

        return view('front.sectors.index', compact('desaSectors', 'opdSectors'));
    }

    /**
     * (Kompat) Daftar sektor desa saja (route lama /sectors),
     * tapi tetap kirim daftar OPD agar UI konsisten.
     */
    public function index()
    {
        $desaSectors = Sector::query()
            ->orderBy('name')
            ->withCount('villages')
            ->paginate(12, ['*'], 'desa_page');

        $opdTable = (new DinasSector)->getTable();

        $opdSectors = DinasSector::query()
            ->orderBy(
                Schema::hasColumn($opdTable, 'display_order') ? 'display_order' :
                (Schema::hasColumn($opdTable, 'nama') ? 'nama' : 'id')
            )
            ->withCount('records')
            ->paginate(12, ['*'], 'opd_page');

        return view('front.sectors.index', compact('desaSectors', 'opdSectors'));
    }

    /**
     * Detail sektor desa + daftar desa terkait.
     * Route model binding: {sector:slug}
     */
    public function show(Sector $sector)
    {
        $q = request('q');

        $villages = Village::query()
            ->where('sector_id', $sector->id)
            ->when($q, function ($w) use ($q) {
                $w->where(function ($s) use ($q) {
                    $s->where('nama', 'like', "%{$q}%")
                      ->orWhere('kecamatan', 'like', "%{$q}%")
                      ->orWhere('kelompok_umkm', 'like', "%{$q}%")
                      ->orWhere('kontak_person', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('front.sectors.show', compact('sector', 'villages'));
    }

    /**
     * Detail publik OPD: daftar record OPD (bisa difilter desa & tahun).
     * Route: /potensi/opd/{opd:slug}  -> name: opd.public.show
     */
    public function opdShow(DinasSector $opd)
    {
        $villageId = request('village_id');
        $tahun     = request('tahun');

        // Dropdown desa (opsional)
        $villages = Village::query()
            ->orderBy('nama')
            ->get(['id', 'nama']);

        // Query record—tahan banting meski kolom tanggal tidak ada
        $opdRecordTable = (new OpdRecord)->getTable();

        $recordsQ = OpdRecord::query()
            ->with(['village:id,nama'])
            ->where('dinas_sector_id', $opd->id)
            ->when($villageId, fn ($q) => $q->where('village_id', $villageId));

        if (Schema::hasColumn($opdRecordTable, 'tanggal')) {
            if ($tahun) {
                $recordsQ->whereYear('tanggal', $tahun);
            }
            $recordsQ->orderByDesc('tanggal');
        } else {
            // fallback: gunakan created_at bila ada; jika tidak, pakai id
            if ($tahun && Schema::hasColumn($opdRecordTable, 'created_at')) {
                $recordsQ->whereYear('created_at', $tahun);
            }
            if (Schema::hasColumn($opdRecordTable, 'created_at')) {
                $recordsQ->orderByDesc('created_at');
            } else {
                $recordsQ->orderByDesc('id');
            }
        }

        $records = $recordsQ
            ->paginate(12)
            ->withQueryString();
        // Tentukan kunci ringkas dari form_schema OPD
    $ringkasKeys = collect($records->items())
    ->flatMap(function ($r) {
        $arr = json_decode($r->ringkas ?? '', true);
        if (!is_array($arr) && isset($r->payload)) {
            $arr = is_array($r->payload) ? $r->payload : (json_decode($r->payload ?? '', true) ?: []);
        }
        return is_array($arr) ? array_keys($arr) : [];
    })
    ->unique()
    ->values();
        return view('front.sectors.opd_show', [
            'opd'       => $opd,
            'rows'      => $records,
            'villages'  => $villages,
            'villageId' => $villageId,
            'tahun'     => $tahun,
            'ringkasKeys'=> $ringkasKeys,
        ]);
     

    }
}
