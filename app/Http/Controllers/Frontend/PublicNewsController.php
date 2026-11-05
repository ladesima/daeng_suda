<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;

class PublicNewsController extends Controller
{
    public function index()
    {
        $items = News::latest('published_at')->paginate(10);
        return view('front.news.index', compact('items'));
    }

    public function show(News $news)
    {
        return view('front.news.show', compact('news'));
    }
}
