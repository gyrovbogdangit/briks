<?php

namespace App\Services;

use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;

class ImageCompressor
{
    protected ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
    }

    /**
     * Создает сжатую копию изображения и сохраняет её в public/thumbs/
     *
     * @param string $path Путь к оригинальному файлу в диске public (например: products/image.jpg)
     * @param int $maxSizeKB Максимальный размер в КБ
     * @return string|null Относительный путь до сжатого изображения в диске public или null при ошибке
     */
    public function compress(string $path, int $maxSizeKB = 200): ?string
    {
        if (!Storage::disk('public')->exists($path)) {
            return null;
        }

        $originalData = Storage::disk('public')->get($path);

        $maxWidth = 350;
        $maxHeight = 250;

        $quality = 60;
        $encoded = null;
        $sizeKB = 0;

        $image = $this->imageManager->read($originalData);

        $originalWidth = $image->width();
        $originalHeight = $image->height();

        $ratio = min($maxWidth / $originalWidth, $maxHeight / $originalHeight);

        $newWidth = (int) round($originalWidth * $ratio);
        $newHeight = (int) round($originalHeight * $ratio);

        $image->resize($newWidth, $newHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        do {
            $encoded = $image->encode(new WebpEncoder(quality: $quality));
            $sizeKB = strlen($encoded->toString()) / 1024;
            $quality -= 10;
        } while ($sizeKB > $maxSizeKB && $quality > 10);

        $compressedPath = Str::contains($path, '/thumbs')
            ? $path
            : static::getCompressedPath($path);

        Storage::disk('public')->put($compressedPath, $encoded->toString());

        return $compressedPath;
    }

    public static function getCompressedPath(string $path): ?string
    {
        $info = pathinfo($path);
        $filename = $info['filename'];
        return "{$info['dirname']}/thumbs/{$filename}.webp";
    }
}
