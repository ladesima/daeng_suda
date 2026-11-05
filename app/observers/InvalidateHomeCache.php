<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class InvalidateHomeCache
{
    private const KEYS = [
        'home.sliders',
        'home.metrics',
        'home.sectors.top6',
        'home.news.top3',
        'home.ann.top3',
        'home.totals',
    ];

    public function saved(): void    { $this->flushHome(); }
    public function deleted(): void  { $this->flushHome(); }
    public function restored(): void { $this->flushHome(); }

    private function flushHome(): void
    {
        foreach (self::KEYS as $key) {
            Cache::forget($key);
        }
    }
}
