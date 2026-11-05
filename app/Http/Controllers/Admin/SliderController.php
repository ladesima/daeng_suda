<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'required|image|max:4096',
            'order' => 'nullable|integer',
        ]);

        if ($request->hasFile('image')) {
            $targetDir = public_path('uploads/sliders');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $data['image'] = 'uploads/sliders/' . $filename;
        }

        Slider::create($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil ditambahkan');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:4096',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($slider->image) {
                if (file_exists(public_path($slider->image))) {
                    @unlink(public_path($slider->image));
                } elseif (file_exists(public_path('uploads/' . $slider->image))) {
                    @unlink(public_path('uploads/' . $slider->image));
                }
            }

            $targetDir = public_path('uploads/sliders');
            if (!file_exists($targetDir)) {
                @mkdir($targetDir, 0755, true);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension() ?: 'jpg';
            $filename = time() . '_' . Str::random(10) . '.' . $ext;
            $file->move($targetDir, $filename);
            $data['image'] = 'uploads/sliders/' . $filename;
        }

        $slider->update($data);
        return redirect()->route('admin.sliders.index')->with('success', 'Slider berhasil diperbarui');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            if (file_exists(public_path($slider->image))) {
                @unlink(public_path($slider->image));
            } elseif (file_exists(public_path('uploads/' . $slider->image))) {
                @unlink(public_path('uploads/' . $slider->image));
            }
        }
        $slider->delete();
        return back()->with('success', 'Slider berhasil dihapus');
    }
}
