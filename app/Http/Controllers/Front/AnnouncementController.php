<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $items = Announcement::where('is_active', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(10);

        return view('front.ann.index', compact('items'));
    }

    public function show(Announcement $announcement)
    {
        // Amankan: hanya tampilkan yang aktif
        abort_unless($announcement->is_active, 404);

        return view('front.ann.show', compact('announcement'));
    }
}
