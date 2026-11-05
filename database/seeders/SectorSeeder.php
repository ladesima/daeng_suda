<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Sector, Potential};

class SectorSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name'=>'Pertanian','icon'=>'ph:wheat','summary'=>'Lahan sawah, jagung, komoditas pangan'],
            ['name'=>'Perkebunan','icon'=>'ph:leaf','summary'=>'Kelapa, kakao, dan tanaman perkebunan'],
            ['name'=>'Perikanan','icon'=>'ph:fish','summary'=>'Budidaya dan tangkap'],
            ['name'=>'Energi','icon'=>'ph:lightning','summary'=>'Energi terbarukan & konvensional'],
            ['name'=>'Kehutanan','icon'=>'ph:tree','summary'=>'Hutan lindung dan produksi'],
            ['name'=>'Pertambangan','icon'=>'ph:pickaxe','summary'=>'Galian C dan mineral lain'],
        ];
        foreach ($data as $s) {
            $sector = Sector::firstOrCreate(['name'=>$s['name']], $s);
            Potential::firstOrCreate([
                'sector_id'=>$sector->id, 'name'=>'Contoh Potensi', 'unit'=>'ha', 'value'=>1000, 'note'=>'Ubah di admin'
            ]);
        }
    }
}
