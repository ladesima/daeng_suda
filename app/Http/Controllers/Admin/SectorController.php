<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;

class SectorController extends Controller
{
    public function index()
    {
        // tampilkan count desa per sektor
        $items = Sector::withCount('villages')
            ->orderBy('order')
            ->orderBy('name')
            ->paginate(12);

        return view('admin.sectors.index', compact('items'));
    }

    public function show(Sector $sector)
    {
        // klik sektor → langsung ke daftar Desa sektor tsb.
        return redirect()->route('admin.sectors.villages.index', $sector);
    }

    // create/store/edit/update/destroy TIDAK ada
}
