<?php

namespace App\Providers;

use App\Models\FlashInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['components.navigation', 'layouts.public', 'components.flash-infos'], function ($view) {
            $view->with('flashInfos', Cache::remember('flash_infos', 300, fn () => FlashInfo::where('is_active', true)
                ->whereNotNull('content')
                ->where('content', '!=', '')
                ->orderBy('order')
                ->get()));
        });
    }
}
