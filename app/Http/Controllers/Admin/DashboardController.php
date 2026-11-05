<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Metric, Sector, News};

class DashboardController extends Controller
{
    public function index()
{
    $stats = [
        'news'      => \App\Models\News::count(),
        'articles'  => \App\Models\News::count(), // sementara pakai jumlah news juga
        'galleries' => 0, // sesuaikan kalau ada tabel galeri
        'officials' => 0, // sesuaikan kalau ada tabel pejabat
    ];

    $labels = collect(range(29,0))->map(fn($d)=>now()->subDays($d)->format('d M'));
    $visits = $labels->map(fn()=>rand(20,90));

    $charts = [
        'visitors' => ['labels'=>$labels,'data'=>$visits],
        'content'  => [
            'labels' => ['Berita','Artikel','Galeri'],
            'data'   => [$stats['news'],$stats['articles'],$stats['galleries']],
        ],
    ];

    $latestNews = \App\Models\News::latest()->take(5)->get();

    return view('admin.dashboard', compact('stats','charts','latestNews'));
}

}
