<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index() { return view('admin.news.index', ['items'=>News::latest('published_at')->paginate(10)]); }
    public function create() { return view('admin.news.create'); }
    public function store(Request $r) {
        $data = $r->validate([
            'title'=>'required',
            'excerpt'=>'nullable',
            'body'=>'required',
            'category'=>'nullable',
            'published_at'=>'nullable|date',
        ]);
        News::create($data);
        return redirect()->route('admin.news.index')->with('ok','Berita dibuat');
    }
    public function edit(News $news) { return view('admin.news.edit', compact('news')); }
    public function update(Request $r, News $news) {
        $data = $r->validate([
            'title'=>'required',
            'excerpt'=>'nullable',
            'body'=>'required',
            'category'=>'nullable',
            'published_at'=>'nullable|date',
        ]);
        $news->update($data);
        return back()->with('ok','Disimpan');
    }
    public function destroy(News $news) { $news->delete(); return back()->with('ok','Dihapus'); }
    public function show(News $news) { return view('admin.news.show', compact('news')); }
}
