<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Encoders\JpegEncoder;
use Intervention\Image\ImageManager;
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
    public function compress(string $path, int $maxSizeKB = 200, int $maxWidth = 350, int $maxHeight = 266): ?string
    {
        if (!Storage::disk('public')->exists($path)) {
            return null;
        }

        $originalData = Storage::disk('public')->get($path);

        $image = $this->imageManager->read($originalData);
        $image->resize($maxWidth, $maxHeight, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $tmpPath = 'tmp/resized.jpg';
        Storage::disk('public')->put($tmpPath, (string) $image->encode(new JpegEncoder()));

        $resizedData = Storage::disk('public')->get($tmpPath);
        $resizedImage = $this->imageManager->read($resizedData);

        $quality = 60;
        do {
            $encoded = $resizedImage->encode(new WebpEncoder(quality: $quality), $quality);
            $sizeKB = strlen($encoded) / 1024;
            $quality -= 10;
        } while ($sizeKB > $maxSizeKB && $quality > 10);

        $compressedPath = str_contains($path, 'thumbs/') ? $path : static::getCompressedPath($path);

        Storage::disk('public')->put($compressedPath, $encoded);

        Storage::disk('public')->delete($tmpPath);

        return $compressedPath;
    }


    public static function getCompressedPath(string $path): ?string
    {
        $info = pathinfo($path);
        $filename = $info['filename'];
        return "{$info['dirname']}/thumbs/{$filename}.webp";
    }
}
