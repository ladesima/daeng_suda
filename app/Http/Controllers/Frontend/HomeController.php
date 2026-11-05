<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\{Metric, News, Slider, Announcement, Village, Sector};
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        // 1) Konten umum (cache 10 menit)
        $sliders = Cache::remember('home.sliders', 600, fn () =>
            Slider::where('is_active', 1)->orderBy('order')->get()
        );

        $metric = Cache::remember('home.metrics', 600, fn () =>
            Metric::first()
        );

        $news = Cache::remember('home.news.top3', 600, fn () =>
            News::latest('published_at')->take(3)->get()
        );

        $ann = Cache::remember('home.ann.top3', 600, fn () =>
            Announcement::where('is_active', 1)->latest('published_at')->take(3)->get()
        );

        // 2) Hitung jumlah desa per 6 sektor utama
        $sectors = Cache::remember('home.sectors.count', 600, function () {
            $slugs = ['pertanian','perkebunan','perikanan','energi','pertambangan','kehutanan'];
            return Sector::whereIn('slug', $slugs)
                ->withCount('villages')
                ->get(['id','name','slug']);
        });

        // 3) Agregasi nilai dari kolom JSON villages (6 kategori)
        $totalsSda = Cache::remember('home.totals_sda', 600, function () {
            $sum = function (string $col, string $jsonPath) {
                return "COALESCE(SUM(CAST(JSON_UNQUOTE(JSON_EXTRACT($col, '$jsonPath')) AS DECIMAL(15,2))),0)";
            };

            $pertanian = Village::selectRaw("
                {$sum('pertanian','$.luas_sawah_ha')}        AS luas_sawah_ha,
                {$sum('pertanian','$.luas_jagung_ha')}       AS luas_jagung_ha,
                {$sum('pertanian','$.lahan_tadah_hujan_ha')} AS lahan_tadah_hujan_ha,
                {$sum('pertanian','$.produksi_ton')}         AS produksi_ton
            ")->first();

            $perkebunan = Village::selectRaw("
                {$sum('perkebunan','$.luas_ha')}          AS luas_ha,
                {$sum('perkebunan','$.produksi_tahunan')} AS produksi_tahunan
            ")->first();

            $perikanan = Village::selectRaw("
                {$sum('perikanan','$.luas_tambak_ha')} AS luas_tambak_ha,
                {$sum('perikanan','$.produksi_ton')}   AS produksi_ton
            ")->first();

            $energi = Village::selectRaw("
                {$sum('energi','$.potensi_surya_kwp')}      AS surya_kwp,
                {$sum('energi','$.potensi_angin_kwp')}      AS angin_kwp,
                {$sum('energi','$.potensi_mikrohidro_kwp')} AS mikrohidro_kwp
            ")->first();

            $pertambangan = Village::selectRaw("
                {$sum('pertambangan','$.luas_ha')} AS luas_ha
            ")->first();

            $kehutanan = Village::selectRaw("
                {$sum('kehutanan','$.luas_hutan_ha')}         AS luas_hutan_ha,
                {$sum('kehutanan','$.luas_mangrove_ha')}      AS luas_mangrove_ha,
                {$sum('kehutanan','$.kawasan_konservasi_ha')} AS konservasi_ha
            ")->first();

            return compact('pertanian','perkebunan','perikanan','energi','pertambangan','kehutanan');
        });

        return view('front.home', [
            'sliders'       => $sliders,
            'metric'        => $metric,
            'news'          => $news,
            'announcements' => $ann,
            'sectors'       => $sectors,   // untuk badge jumlah desa per sektor
            'totalsSda'     => $totalsSda, // agregat 6 kategori
        ]);
    }
}
