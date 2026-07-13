<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Menu extends Model
{
    protected $fillable = [
        'name',
    ];

    protected static function booted(): void
    {
        static::saved(fn (Menu $menu) => Cache::forget("menu.{$menu->name}"));
        static::deleted(fn (Menu $menu) => Cache::forget("menu.{$menu->name}"));
    }

    public function items(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}
