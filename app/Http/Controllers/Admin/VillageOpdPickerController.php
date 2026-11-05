<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DinasSector;
use App\Models\Village;

class VillageOpdPickerController extends Controller
{
    public function picker(DinasSector $sector)
    {
        // tampilkan semua desa (atau filter sesuai kebutuhan)
        $villages = Village::orderBy('kecamatan')
            ->orderBy('nama')
            ->get(['id','nama','kecamatan']);

        return view('admin.villages.opd_picker', compact('sector','villages'));
    }
}
