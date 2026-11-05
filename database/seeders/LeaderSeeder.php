<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leader;

class LeaderSeeder extends Seeder
{
    public function run(): void
    {
        Leader::create([
            'nama' => 'Drs. H. Andi Suryana, M.Si.',
            'jabatan' => 'Bupati Kabupaten Suka Maju',
            'foto' => null,
            'visi' => 'Mewujudkan Kabupaten Suka Maju yang Sejahtera, Mandiri, dan Berdaya Saing.',
            'misi' => '1. Meningkatkan kualitas sumber daya manusia.
2. Memperkuat tata kelola pemerintahan yang bersih dan transparan.
3. Mengembangkan ekonomi daerah berbasis potensi lokal.
4. Meningkatkan pelayanan publik dan kesejahteraan masyarakat.',
        ]);
    }
}
