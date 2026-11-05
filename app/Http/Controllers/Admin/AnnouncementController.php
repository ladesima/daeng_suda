<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnnouncementController extends Controller
{
    public function index()
    {
        $items = Announcement::orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(12);

        return view('admin.announcements.index', compact('items'));
    }

    public function create()
    {
        $announcement = new Announcement();
        return view('admin.announcements.create', compact('announcement'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255|unique:announcements,slug',
            'body'         => 'required|string',
            'published_at' => 'nullable|date',
            'is_active'    => 'sometimes|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);

        Announcement::create($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dibuat.');
    }

    // Tidak gunakan halaman show khusus → arahkan ke edit
    public function show(Announcement $announcement)
    {
        return redirect()->route('admin.announcements.edit', $announcement);
    }

    public function edit(Announcement $announcement)
    {
        return view('admin.announcements.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255|unique:announcements,slug,' . $announcement->id,
            'body'         => 'required|string',
            'published_at' => 'nullable|date',
            'is_active'    => 'sometimes|boolean',
        ]);

        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $data['is_active'] = (bool)($data['is_active'] ?? false);

        $announcement->update($data);

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Announcement $announcement)
    {
        $announcement->delete();

        return redirect()
            ->route('admin.announcements.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
