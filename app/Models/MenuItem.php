<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

class MenuItem extends Model
{
    protected $fillable = [
        'menu_id',
        'parent_id',
        'order',
        'title',
        'url',
        'route',
        'parameters',
        'target',
        'icon_class',
        'color',
    ];

    protected static function booted(): void
    {
        $clearMenuCache = function (MenuItem $menuItem): void {
            if ($menuItem->menu) {
                Cache::forget("menu.{$menuItem->menu->name}");
            }

            if ($menuItem->wasChanged('menu_id') && filled($menuItem->getOriginal('menu_id'))) {
                $oldMenu = Menu::find($menuItem->getOriginal('menu_id'));

                if ($oldMenu) {
                    Cache::forget("menu.{$oldMenu->name}");
                }
            }
        };

        static::saved($clearMenuCache);
        static::deleted($clearMenuCache);
    }

    public function menu(): BelongsTo
    {
        return $this->belongsTo(Menu::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
            ->orderBy('order')
            ->orderBy('title');
    }

    public function link(): string
    {
        if (filled($this->route) && Route::has($this->route)) {
            return route($this->route, $this->routeParameters(), false);
        }

        return $this->url ?: '#';
    }

    private function routeParameters(): array
    {
        if (blank($this->parameters)) {
            return [];
        }

        $parameters = json_decode($this->parameters, true);

        return is_array($parameters) ? $parameters : [];
    }
}
