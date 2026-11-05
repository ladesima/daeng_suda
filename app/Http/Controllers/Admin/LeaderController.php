<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leader;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LeaderController extends Controller
{
    // Tampilkan daftar
    public function index()
    {
        $leaders = Leader::orderByDesc('id')->get();
        return view('admin.leaders.index', compact('leaders'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.leaders.create');
    }

    // Simpan data baru
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'visi'    => 'nullable|string',
            'misi'    => 'nullable|string',
            'foto'    => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('foto')) {
            $targetDir = public_path('uploads/leaders');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $validated['foto'] = 'uploads/leaders/' . $filename;
        }

        Leader::create($validated);

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Data Kepala Daerah berhasil ditambahkan.');
    }

    // Form edit
    public function edit(Leader $leader)
    {
        return view('admin.leaders.edit', compact('leader'));
    }

    // Update data
    public function update(Request $request, Leader $leader)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'visi'    => 'nullable|string',
            'misi'    => 'nullable|string',
            'foto'    => 'nullable|image|max:4096',
        ]);

        // handle foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama jika ada
            if ($leader->foto) {
                if (file_exists(public_path($leader->foto))) {
                    @unlink(public_path($leader->foto));
                } elseif (file_exists(public_path('uploads/' . $leader->foto))) {
                    @unlink(public_path('uploads/' . $leader->foto));
                }
            }

            $targetDir = public_path('uploads/leaders');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('foto');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $validated['foto'] = 'uploads/leaders/' . $filename;
        }

        $leader->update($validated);

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Data Kepala Daerah berhasil diperbarui.');
    }

    // Hapus data
    public function destroy(Leader $leader)
    {
        if ($leader->foto) {
            if (file_exists(public_path($leader->foto))) {
                @unlink(public_path($leader->foto));
            } elseif (file_exists(public_path('uploads/' . $leader->foto))) {
                @unlink(public_path('uploads/' . $leader->foto));
            }
        }
        $leader->delete();

        return redirect()->route('admin.leaders.index')
            ->with('success', 'Data Kepala Daerah berhasil dihapus.');
    }
}
