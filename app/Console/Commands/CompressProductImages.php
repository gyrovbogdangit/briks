<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;
use App\Services\ImageCompressor;

class CompressProductImages extends Command
{
    protected $signature = 'compress:product-images {--max=200}';
    protected $description = 'Сжать изображения товаров и сохранить в папке thumbs';

    public function handle()
    {
        $compressor = new ImageCompressor();
        $maxSize = (int) $this->option('max');

        $this->info("Начинаем сжатие изображений...");

        $count = 0;
        $products = Product::whereNotNull('images')
            ->get();
        foreach ($products as $product) {
            $this->info("Обрабатываем товар: {$product->name} (ID: {$product->id})");
            $compressedImages = [];
            foreach ((array) $product->images as $i => $path) {
                $result = $compressor->compress($path, $maxSize);
                if ($result) {
                    $this->line("  [$i]: $result");
                    $count++;
                }

                $compressedImages[] = $result;
            }

            $product->thumbs = $compressedImages;
            $product->save();
        }

        $this->info("Готово! Сжато изображений: {$count}");
    }
}
