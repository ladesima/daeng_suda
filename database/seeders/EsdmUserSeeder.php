<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Village;
use Illuminate\Support\Facades\Hash;

class EsdmUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin SDA
        User::firstOrCreate(
            ['email' => 'sda@jeneponto.go.id'],
            [
                'name' => 'Admin SDA',
                'password' => Hash::make('password123'),
                'role' => 'admin_sda',
            ]
        );

        // 2. Pimpinan
        User::firstOrCreate(
            ['email' => 'pimpinan@jeneponto.go.id'],
            [
                'name' => 'Pimpinan',
                'password' => Hash::make('password123'),
                'role' => 'pimpinan',
            ]
        );

        // 3. Admin Desa (sample - Benteng, Bangkala)
        $bentengVillage = Village::where('nama', 'Benteng')
            ->where('kecamatan', 'Bangkala')
            ->first();

        User::firstOrCreate(
            ['email' => 'desa.benteng@jeneponto.go.id'],
            [
                'name' => 'Admin Desa Benteng',
                'password' => Hash::make('password123'),
                'role' => 'admin_desa',
                'village_id' => $bentengVillage?->id,
            ]
        );

        // 4. Admin Desa (sample - Empoang, Binamu)
        $empoangVillage = Village::where('nama', 'Empoang')
            ->where('kecamatan', 'Binamu')
            ->first();

        User::firstOrCreate(
            ['email' => 'desa.empoang@jeneponto.go.id'],
            [
                'name' => 'Admin Desa Empoang',
                'password' => Hash::make('password123'),
                'role' => 'admin_desa',
                'village_id' => $empoangVillage?->id,
            ]
        );
    }
}
