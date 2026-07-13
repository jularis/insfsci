<?php

namespace App\Models\Concerns;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasDisplayImage
{
    public function getImageUrlAttribute(): ?string
    {
        return $this->displayImageUrl($this->attributes['image'] ?? null);
    }

    protected function displayImageUrl($value): ?string
    {
        $image = trim((string) $value);

        if ($image === '' || $image === '[]') {
            return null;
        }

        $decodedImage = json_decode($image, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decodedImage)) {
            $image = $decodedImage[0] ?? '';
        }

        if ($image === '') {
            return null;
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
