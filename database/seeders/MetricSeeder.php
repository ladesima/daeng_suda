<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Metric;

class MetricSeeder extends Seeder
{
    public function run(): void
    {
        Metric::firstOrCreate([], ['districts'=>12, 'villages'=>113, 'sectors'=>8]);
    }
}
