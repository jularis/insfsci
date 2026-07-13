<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'slug',
        'status',
    ];

    public function getImageUrlAttribute(): string
    {
        $image = trim((string) $this->image);

        if ($image === '' || $image === '[]') {
            return asset('logo.jpg');
        }

        $decodedImage = json_decode($image, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedImage)) {
            $image = $decodedImage[0] ?? '';
        }

        if ($image === '') {
            return asset('logo.jpg');
        }

        $image = str_replace('\\', '/', $image);

        if (Str::startsWith($image, ['http://', 'https://', '/'])) {
            return $image;
        }

        if (Str::startsWith($image, 'storage/')) {
            return asset($image);
        }

        if (file_exists(public_path($image))) {
            return asset($image);
        }

        return Storage::disk('public')->url($image);
    }
}
