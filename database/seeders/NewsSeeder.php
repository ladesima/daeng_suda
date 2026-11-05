<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use Illuminate\Support\Str;
use Carbon\Carbon;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['title'=>'Program Rehabilitasi Lahan','excerpt'=>'Peningkatan produktivitas sawah di Bangkala.','category'=>'Pertanian'],
            ['title'=>'Potensi Energi Surya 1.2 GW','excerpt'=>'Mendukung energi terbarukan daerah.','category'=>'Energi'],
            ['title'=>'Festival Hasil Laut 2024','excerpt'=>'Promosi hasil laut dan produk olahan.','category'=>'Perikanan'],
        ];
        foreach ($items as $it) {
            News::firstOrCreate(
                ['title'=>$it['title']],
                [
                    'excerpt'=>$it['excerpt'],
                    'body'=>Str::repeat('Konten berita. ', 30),
                    'category'=>$it['category'],
                    'published_at'=>Carbon::now()->subDays(rand(1,30)),
                ]
            );
        }
    }
}
