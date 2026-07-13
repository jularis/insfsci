<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashInfo extends Model
{
    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'slug',
        'order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
