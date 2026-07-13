<?php

use App\Models\MenuItem;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

if (! function_exists('setting')) {
    function setting(string $key, ?string $default = ''): ?string
    {
        try {
            if (! Schema::hasTable('settings')) {
                return $default;
            }

            return Cache::rememberForever("setting.{$key}", function () use ($key, $default) {
                return Setting::query()->where('key', $key)->value('value') ?? $default;
            });
        } catch (Throwable) {
            return $default;
        }
    }
}

if (! function_exists('front_menu')) {
    function front_menu(string $slug, string $view = 'menu'): string
    {
        try {
            if (! Schema::hasTable('menus') || ! Schema::hasTable('menu_items')) {
                return '';
            }

            $items = Cache::rememberForever("menu.{$slug}", function () use ($slug) {
                $menu = Menu::query()->where('name', $slug)->first();

                if (! $menu) {
                    return collect();
                }

                return MenuItem::query()
                    ->with('children')
                    ->where('menu_id', $menu->id)
                    ->whereNull('parent_id')
                    ->orderBy('order')
                    ->orderBy('title')
                    ->get();
            });

            return View::make($view, ['items' => $items])->render();
        } catch (Throwable) {
            return '';
        }
    }
}
