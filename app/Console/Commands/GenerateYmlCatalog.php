<?php

namespace App\Console\Commands;

use DateTime;
use DateTimeZone;
use SimpleXMLElement;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Console\Command;

class GenerateYmlCatalog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-yml-catalog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate YML catalog file for products';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting YML catalog generation...');

        try {
            // Create root element
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><yml_catalog />');
            $xml->addAttribute('date', now()->format('Y-m-d\TH:iP'));

            $shop = $xml->addChild('shop');

            // Add categories
            $this->addCategories($shop);

            // Add offers
            $this->addOffers($shop);

            // Save to file
            $dom = new \DOMDocument('1.0', 'UTF-8');
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            $dom->loadXML($xml->asXML());

            $filePath = public_path('yml_catalog.xml');
            $dom->save($filePath);

            $this->info('YML catalog generated successfully!');
            $this->info('File saved to: ' . $filePath);
        } catch (\Exception $e) {
            $this->error('Error generating YML catalog: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }

    /**
     * Add categories to XML
     */
    protected function addCategories($shop)
    {
        $categoriesElement = $shop->addChild('categories');

        $subcategories = \App\Models\Subcategory::with('category')->get();

        foreach ($subcategories as $subcategory) {
            $categoryElement = $categoriesElement->addChild('category', htmlspecialchars($subcategory->name, ENT_XML1));
            $categoryElement->addAttribute('id', $subcategory->id);

            if ($subcategory->category_id) {
                $categoryElement->addAttribute('parentId', $subcategory->category_id);
            }
        }
    }

    /**
     * Add offers (products) to XML
     */
    protected function addOffers($shop)
    {
        $offersElement = $shop->addChild('offers');

        $products = Product::where('is_active', true)
            ->with('category.productType', 'subcategory')
            ->get();

        foreach ($products as $product) {
            $offer = $offersElement->addChild('offer');
            $offer->addAttribute('id', $product->id);
            $offer->addAttribute('available', $product->is_active ? 'true' : 'false');

            // Basic info
            $offer->addChild('name', htmlspecialchars($product->name, ENT_XML1));

            // Price
            $price = $this->getProductPrice($product);
            if ($price) {
                $offer->addChild('price', $price);
                $offer->addChild('currencyId', 'RUR');
            }

            // Category
            if ($product->subcategory) {
                $offer->addChild('categoryId', $product->subcategory->id);
            }

            // Description
            if ($product->description) {
                $offer->addChild('description', htmlspecialchars(strip_tags($product->description), ENT_XML1));
            }

            // Short description
            if ($product->short_description) {
                $offer->addChild('shortDescription', htmlspecialchars(strip_tags($product->short_description), ENT_XML1));
            }

            // Image
            if (!empty($product->images) && is_array($product->images) && count($product->images) > 0) {
                $pictureUrl = asset('storage/' . $product->images[0]);
                $offer->addChild('picture', $pictureUrl);
            }

            // URL
            $url = route('products.show', [
                'productType' => $product->category->productType,
                'category' => $product->category,
                'subcategory' => $product->subcategory,
                'product' => $product
            ]);
            $offer->addChild('url', $url);

            $offer->addChild('sales_notes', 'Предоплата. Доставка по России.');
        }
    }

    /**
     * Get product price (use discount if available)
     */
    protected function getProductPrice($product)
    {
        if ($product->discount_price_per_piece) {
            return number_format($product->discount_price_per_piece, 0, '.', '');
        }

        if ($product->price_per_piece) {
            return number_format($product->price_per_piece, 0, '.', '');
        }

        if ($product->discount_price_sqm) {
            return number_format($product->discount_price_sqm, 0, '.', '');
        }

        if ($product->price_sqm) {
            return number_format($product->price_sqm, 0, '.', '');
        }

        if ($product->discount_price_m3) {
            return number_format($product->discount_price_m3, 0, '.', '');
        }

        if ($product->price_m3) {
            return number_format($product->price_m3, 0, '.', '');
        }

        return null;
    }
}
