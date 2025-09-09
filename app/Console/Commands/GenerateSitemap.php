<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    protected $urls = [];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->addMainPages();
        $this->addCustomPages();
        $this->addProductTypes();
        $this->addCategories();
        $this->addSubcategories();
        $this->addProducts();

        $sitemap = $this->buildXml($this->urls);

        file_put_contents(public_path('sitemap.xml'), $sitemap);

        $this->info('Sitemap generated successfully!');
    }

    protected function addMainPages()
    {
        $this->addUrl(route('home'));
        $this->addUrl(route('cart'));
        $this->addUrl(route('comparison'));
        $this->addUrl(route('favorites'));
    }

    protected function addCustomPages()
    {
        $pages = \App\Models\Page::all();
        foreach ($pages as $page) {
            $this->addUrl(
                route('page', ['page' => $page]),
                $page->updated_at->toAtomString()
            );
        }
    }

    protected function addProductTypes()
    {
        $types = \App\Models\ProductType::all();
        foreach ($types as $type) {
            $this->addUrl(
                route('product-types.show', ['productType' => $type]),
                $type->updated_at->toAtomString()
            );
        }
    }

    protected function addCategories()
    {
        $categories = \App\Models\Category::with('productType')->get();
        foreach ($categories as $category) {
            $this->addUrl(
                route('categories.show', ['productType' => $category->productType, 'category' => $category]),
                $category->updated_at->toAtomString()
            );
        }
    }

    protected function addSubcategories()
    {
        $subcategories = \App\Models\Subcategory::with('category.productType')->get();
        foreach ($subcategories as $sub) {
            $this->addUrl(
                route('products.index', ['productType' => $sub->category->productType, 'category' => $sub->category, 'subcategory' => $sub]),
                $sub->updated_at->toAtomString()
            );
        }
    }

    protected function addProducts()
    {
        $products = \App\Models\Product::with('subcategory.category.productType')->get();
        foreach ($products as $product) {
            $this->addUrl(
                route('products.show', [
                    'productType' => $product->subcategory->category->productType,
                    'category' => $product->subcategory->category,
                    'subcategory' => $product->subcategory,
                    'product' => $product
                ]),
                $product->updated_at->toAtomString()
            );
        }
    }

    protected function addUrl($loc, $lastmod = null, $changefreq = 'weekly', $priority = 0.8)
    {
        $this->urls[] = [
            'loc' => $loc,
            'lastmod' => $lastmod,
            'changefreq' => $changefreq,
            'priority' => $priority,
        ];
    }

    protected function buildXml($urls)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        foreach ($urls as $url) {
            $xml .= '<url>';
            $xml .= '<loc>' . $url['loc'] . '</loc>';
            if ($url['lastmod']) {
                $xml .= '<lastmod>' . $url['lastmod'] . '</lastmod>';
            }
            $xml .= '<changefreq>' . $url['changefreq'] . '</changefreq>';
            $xml .= '<priority>' . $url['priority'] . '</priority>';
            $xml .= '</url>';
        }

        $xml .= '</urlset>';

        return $xml;
    }
}
