<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DinasSector;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DinasSectorController extends Controller
{
    public function index()
    {
        // Dropdown "Tambah Desa" (tanpa pagination)
        $dinasSectors = DinasSector::orderBy('nama')
            ->get(['id', 'nama', 'slug']);

        // Tabel utama (pakai pagination + withCount jumlah desa)
        $items = DinasSector::query()
            ->select(['id', 'nama', 'slug', 'icon', 'summary', 'display_order', 'is_active'])
            ->withCount('records')                 // menghasilkan $it->villages_count di blade
            ->orderByRaw('display_order IS NULL')   // NULL diurutkan terakhir
            ->orderBy('display_order')
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.dinas_sectors.index', compact('dinasSectors', 'items'));
    }

    public function create()
    {
        return view('admin.dinas_sectors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama'           => ['required','string','max:255'],
            'slug'           => ['nullable','string','max:255','unique:dinas_sectors,slug'],
            'icon'           => ['nullable','string','max:100'],
            'summary'        => ['nullable','string','max:1000'],
            'display_order'  => ['nullable','integer'],
            'is_active'      => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['nama']);
        $data['is_active'] = (bool)($data['is_active'] ?? false);

        DinasSector::create($data);

        return redirect()
            ->route('admin.dinas_sectors.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit(DinasSector $dinasSector)
    {
        return view('admin.dinas_sectors.edit', compact('dinasSector'));
    }

    public function update(Request $request, DinasSector $dinasSector)
    {
        $data = $request->validate([
            'nama'           => ['required','string','max:255'],
            'slug'           => [
                'nullable','string','max:255',
                Rule::unique('dinas_sectors','slug')->ignore($dinasSector->id),
            ],
            'icon'           => ['nullable','string','max:100'],
            'summary'        => ['nullable','string','max:1000'],
            'display_order'  => ['nullable','integer'],
            'is_active'      => ['nullable','boolean'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['nama']);
        $data['is_active'] = (bool)($data['is_active'] ?? false);

        $dinasSector->update($data);

        return redirect()
            ->route('admin.dinas_sectors.index')
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(DinasSector $dinasSector)
    {
        $dinasSector->delete();

        return redirect()
            ->route('admin.dinas_sectors.index')
            ->with('success', 'Data berhasil dihapus.');
    }
}
