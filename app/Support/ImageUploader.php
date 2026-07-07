<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ImageUploader
{
    /**
     * Resize/compress an uploaded image and store it on the public disk.
     * Returns the stored path (relative to the public disk), for use with asset('storage/...').
     */
    public static function store(UploadedFile $file, string $directory, int $maxWidth = 1600): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());

        if ($image->width() > $maxWidth) {
            $image->scaleDown(width: $maxWidth);
        }

        $filename = $directory.'/'.Str::uuid().'.webp';
        $encoded = $image->toWebp(quality: 82);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }

    public static function delete(?string $path): void
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
