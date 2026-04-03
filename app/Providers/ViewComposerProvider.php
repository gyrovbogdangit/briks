<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\City;
use App\Models\Email;
use App\Models\Page;
use App\Models\PhoneNumber;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\RecentlyViewedService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Кешируем города на сутки (86400 сек)
        View::composer('components.cities', function ($view) {
            $citiesGrouped = Cache::remember('cities_grouped', 86400, function () {
                $cities = City::orderBy('name')->get();
                return City::groupByCapitalLetter($cities);
            });
            $view->with('citiesGrouped', $citiesGrouped);
        });

        // Меню каталога (сложный запрос с вложениями) — на 1 час
        View::composer(
            ['layouts.components.catalog-menu', 'layouts.components.header', 'layouts.components.footer', 'components.hero', 'catalog'],
            function ($view) {
                $types = Cache::remember('catalog_menu_types', 3600, function () {
                    return ProductType::with([
                        'categories' => function ($query) {
                            $query->orderByRaw('ISNULL(sort_index), sort_index')
                                ->with(['subcategories' => fn($query) => $query->orderByRaw('ISNULL(sort_index), sort_index')]);
                        }
                    ])->orderByRaw('ISNULL(sort_index), sort_index')->get();
                });
                $view->with('types', $types);
            }
        );

        // Контактные данные и страницы — на 1 час
        View::composer([
            'layouts.components.header',
            'layouts.components.footer',
            'products.components.why-choose-us',
            'components.frequent-questions',
            'products.components.show.product-info'
        ], function ($view) {
            $sharedData = Cache::remember('shared_layout_data', 3600, function () {
                return [
                    'pages' => Page::orderByRaw('ISNULL(sort_index), sort_index')->get(),
                    'phoneNumbers' => PhoneNumber::get(),
                    'emails' => Email::get(),
                    'addresses' => Address::get(),
                ];
            });
            $view->with($sharedData);
        });

        // Популярные/Новые/Хиты — на 30 минут
        // Для этих блоков удобно использовать один подход
        $productBlocks = [
            'components.hot-products'     => ['key' => 'products_hot', 'scope' => fn($q) => $q->where('is_hit_of_sales', true)],
            'components.popular-products' => ['key' => 'products_popular', 'scope' => fn($q) => $q->orderBy('views', 'desc')],
            'components.new-products'     => ['key' => 'products_new', 'scope' => fn($q) => $q->where('is_new', true)],
        ];

        foreach ($productBlocks as $viewName => $config) {
            View::composer($viewName, function ($view) use ($config) {
                $products = Cache::remember($config['key'], 1800, function () use ($config) {
                    return Product::active()
                        ->with('subcategory.category.productType')
                        ->tap($config['scope'])
                        ->limit(10)
                        ->get();
                });
                $view->with(str_replace('products_', '', $config['key']) . 'Products', $products);
            });
        }

        // ВНИМАНИЕ: Recently Viewed кешировать глобально НЕЛЬЗЯ, 
        // так как это персональные данные пользователя (обычно хранятся в сессии/куках).
        View::composer('products.components.recently-watched', function ($view) {
            $view->with('recentlyViewedProducts', RecentlyViewedService::getProducts());
        });
    }
}
