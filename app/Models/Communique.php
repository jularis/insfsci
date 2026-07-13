<?php

namespace App\Models;

use App\Models\Concerns\HasDisplayImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Communique extends Model
{
    use HasFactory;
    use HasDisplayImage;

    protected $fillable = [
        'author_id',
        'category_id',
        'title',
        'excerpt',
        'body',
        'image',
        'fichier',
        'slug',
        'meta_description',
        'meta_keywords',
        'status',
    ];
}
