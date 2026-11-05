<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        // Pegawai pertama (tidak punya atasan)
        $leader = Employee::create([
            'nama' => 'Andi Saputra',
            'jabatan' => 'Kepala Dinas',
            'nip' => '19850101 202001 1 001',
            'foto' => null,
            'atasan_id' => null,
        ]);

        // Pegawai kedua (memiliki atasan)
        Employee::create([
            'nama' => 'Siti Rahmawati',
            'jabatan' => 'Sekretaris Dinas',
            'nip' => '19900315 202101 2 002',
            'foto' => null,
            'atasan_id' => $leader->id,
        ]);

        // Pegawai ketiga (juga memiliki atasan)
        Employee::create([
            'nama' => 'Budi Santoso',
            'jabatan' => 'Staf Administrasi',
            'nip' => '19950820 202201 3 003',
            'foto' => null,
            'atasan_id' => $leader->id,
        ]);
    }
}
