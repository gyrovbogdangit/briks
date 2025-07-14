<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompressProductImagesJob implements ShouldQueue
{
    public $productId;
    public $images;

    public function __construct($productId, $images)
    {
        $this->productId = $productId;
        $this->images = $images;
    }

    public function handle()
    {
        $product = Product::find($this->productId);
        if (!$product) return;
        $compressor = new \App\Services\ImageCompressor();
        $thumbs = [];
        foreach ((array) $this->images as $imagePath) {
            $compressedPath = $compressor->compress($imagePath, 200);
            $thumbs[] = $compressedPath ?: null;
        }
        $product->thumbs = $thumbs;
        $product->save();
    }
}
