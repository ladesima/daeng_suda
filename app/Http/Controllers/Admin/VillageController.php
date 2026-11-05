<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Models\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class VillageController extends Controller
{
    /**
     * (OPSIONAL) Daftar desa untuk satu sektor.
     * Pakai ini hanya jika kamu mendefinisikan route:
     * GET admin/sectors/{sector:slug}/villages  →  admin.sectors.villages.index
     */
    public function index(Sector $sector)
    {
        $items = Village::where('sector_id', $sector->id)
            ->latest('id')
            ->paginate(12);

        return view('admin.villages.index', compact('sector', 'items'));
    }

    public function create(Sector $sector)
    {
        $village = new Village(['sector_id' => $sector->id]);
        return view('admin.villages.create', compact('sector','village'));
    }

    public function store(Request $r, Sector $sector)
    {
        $data = $r->validate([
            'nama'            => 'required|string|max:255',
            'kecamatan'       => 'nullable|string|max:255',
            'kepala_desa'     => 'nullable|string|max:255',
            'kontak_person'   => 'nullable|string|max:255',
            'luas_wilayah_ha' => 'nullable|numeric',
            'jumlah_penduduk' => 'nullable|integer',
            'kelompok_umkm'   => 'nullable|string',
            // bidang-bidang (disimpan JSON jika model Village punya casts)
            'pertanian'    => 'nullable|array',
            'perkebunan'   => 'nullable|array',
            'perikanan'    => 'nullable|array',
            'peternakan'   => 'nullable|array',
            'energi'       => 'nullable|array',
            'pertambangan' => 'nullable|array',
            'kehutanan'    => 'nullable|array',
        ]);

        // Kunci sektor dari parameter route (tidak dari input)
        $data['sector_id'] = $sector->id;

        Village::create($data);

        return $this->redirectAfter($sector, 'Desa berhasil ditambahkan.');
    }

    public function edit(Village $village)
    {
        $sector = $village->sector; // untuk judul/breadcrumb
        return view('admin.villages.edit', compact('sector','village'));
    }

    public function update(Request $r, Village $village)
    {
        $data = $r->validate([
            'nama'            => 'required|string|max:255',
            'kecamatan'       => 'nullable|string|max:255',
            'kepala_desa'     => 'nullable|string|max:255',
            'kontak_person'   => 'nullable|string|max:255',
            'luas_wilayah_ha' => 'nullable|numeric',
            'jumlah_penduduk' => 'nullable|integer',
            'kelompok_umkm'   => 'nullable|string',
            'pertanian'    => 'nullable|array',
            'perkebunan'   => 'nullable|array',
            'perikanan'    => 'nullable|array',
            'peternakan'   => 'nullable|array',
            'energi'       => 'nullable|array',
            'pertambangan' => 'nullable|array',
            'kehutanan'    => 'nullable|array',
        ]);

        // Jangan ijinkan pindah sektor via form
        unset($data['sector_id']);

        $village->update($data);

        return $this->redirectAfter($village->sector, 'Desa diperbarui.');
    }

    public function destroy(Village $village)
    {
        $sector = $village->sector;
        $village->delete();

        return $this->redirectAfter($sector, 'Desa dihapus.');
    }

    /**
     * Helper: redirect ke index desa per-sektor bila rutenya ada,
     * jika tidak, fallback ke daftar sektor.
     */
    private function redirectAfter(Sector $sector, string $message)
    {
        if (Route::has('admin.sectors.villages.index')) {
            return redirect()
                ->route('admin.sectors.villages.index', $sector)
                ->with('success', $message);
        }

        return redirect()
            ->route('admin.sectors.index')
            ->with('success', $message);
    }
}
