<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\InvalidateHomeCache;
use App\Models\{
    Slider, Metric, Sector, News, Potential,Announcement,
    Leader, Employee,Village
};

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        foreach ([
            Slider::class, Metric::class, Sector::class, News::class, Potential::class,
            Announcement::class,Leader::class, Employee::class,village::class
        ] as $model) {
            $model::observe(InvalidateHomeCache::class);
        }
    }
}
