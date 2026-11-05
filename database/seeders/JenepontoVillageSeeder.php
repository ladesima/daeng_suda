<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sector;
use App\Models\Village;

class JenepontoVillageSeeder extends Seeder
{
    public function run(): void
    {
        $defaultSectorId = Sector::first()->id ?? 1;

        $villagesByKecamatan = [
            'Bangkala' => [
                'Benteng',
                'Bontomanai',
                'Kalimporo',
                'Lembang',
                'Lembang Lohe',
                'Mallasoro',
                'Bonto Bulaeng',
                'Bonto Karaeng',
                'Bonto Marannu',
                'Bontojaya',
                'Bontoloe',
                'Pabentengang',
                'Tombo-Tombolo',
            ],
            'Bangkala Barat' => [
                'Bonto Cini',
                'Bonto Loe',
                'Bonto Mangepe',
                'Bonto Rita',
                'Karampuang',
                'Lembanna',
                'Nipa-Nipa',
                'Pallantikang',
                'Pappalluang',
                'Barua',
            ],
            'Tamalatea' => [
                'Bontojai',
                'Bontotangnga',
                'Karelayu',
                'Manjangloe',
                'Tamalatea',
                'Turatea',
                'Bontosunggu',
                'Borongloe',
                'Bululoe',
                'Kampala',
                'Rappoala',
                'Tanrara',
            ],
            'Bontoramba' => [
                'Bontoramba',
                'Bulusibatang',
                'Bontonompo',
                'Bontotanga',
                'Kalebarembeng',
                'Kampung Beru',
                'Maero',
                'Pallantikang',
                'Pattallikang',
                'Romanglasa',
                'Sapanang',
                'Tino',
            ],
            'Binamu' => [
                'Empoang',
                'Empoang Selatan',
                'Empoang Utara',
                'Balang',
                'Balang Toa',
                'Biringkassi',
                'Monro-Monro',
                'Pabiringa',
                'Panaikang',
                'Sapanang',
                'Sidenre',
                'Tolo',
                'Bontoramba',
            ],
            'Turatea' => [
                'Bontomatene',
                'Kayuloe',
                'Kayuloe Barat',
                'Paitana',
                'Togo-Togo',
                'Bantaeng',
                'Bontokassi',
                'Jombe',
                'Lentu',
                'Mangalli',
            ],
            'Batang' => [
                'Bontosunggu',
                'Daya',
                'Kaluku',
                'Marayoka',
                'Mataere',
                'Pallantikang',
                'Tata',
                'Bungung Loe',
                'Tompo Balang',
            ],
            'Arungkeke' => [
                'Arungkeke',
                'Boronglamu',
                'Bulo-Bulo',
                'Kalumpangloe',
                'Kampung Parang',
                'Palajau',
                'Tarowang',
            ],
            'Tarowang' => [
                'Bontorappo',
                'Tarowang',
                'Bontotangnga',
                'Kayuloe',
                'Mangkiling',
                'Patikarya',
                'Tamasongo',
                'Balumbungan',
            ],
            'Kelara' => [
                'Bontolebang',
                'Bontonompo',
                'Gantarang',
                'Kelara',
                'Tolo',
                'Tolo Barat',
                'Tolo Selatan',
                'Tolo Utara',
                'Bontorannu',
                'Samataring',
            ],
            'Rumbia' => [
                'Bonto Bulaeng',
                'Bonto Manai',
                'Bonto Tangnga',
                'Kassi',
                'Loka',
                'Rumbia',
                'Tompobulu',
                'Ujung',
                'Lebang Manai',
            ],
        ];

        foreach ($villagesByKecamatan as $kecamatan => $villages) {
            foreach ($villages as $nama) {
                Village::firstOrCreate(
                    [
                        'nama' => $nama,
                        'kecamatan' => $kecamatan,
                    ],
                    [
                        'sector_id' => $defaultSectorId,
                    ]
                );
            }
        }
    }
}
