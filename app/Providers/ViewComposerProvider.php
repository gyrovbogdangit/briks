<?php

namespace App\Providers;

use App\Models\City;
use App\Models\Page;
use App\Models\Email;
use App\Models\Address;
use App\Models\Product;
use App\Models\PhoneNumber;
use App\Models\ProductType;
use Illuminate\Support\Facades\View;
use App\Services\RecentlyViewedService;
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
        View::composer('components.cities', function ($view) {
            $cities = City::orderBy('name')->get();
            $citiesGrouped = City::groupByCapitalLetter($cities);
            $view->with('citiesGrouped', $citiesGrouped);
        });

        View::composer(
            [
                'layouts.components.catalog-menu',
                'catalog'
            ],
            function ($view) {
                $types = ProductType
                    ::with([
                        'categories' => function ($query) {
                            $query
                                ->orderByRaw('ISNULL(sort_index), sort_index')
                                ->with(['subcategories' => fn($query) => $query->orderByRaw('ISNULL(sort_index), sort_index')]);
                        }
                    ])
                    ->orderByRaw('ISNULL(sort_index), sort_index')
                    ->get();
                $view->with('types', $types);
            }
        );

        View::composer([
            'layouts.components.header',
            'layouts.components.footer',
            'products.components.why-choose-us',
            'components.frequent-questions',
            'products.components.show.product-info'
        ], function ($view) {
            static $sharedData;

            if (!$sharedData) {
                $sharedData = [
                    'pages' => Page::orderByRaw('ISNULL(sort_index), sort_index')->get(),
                    'phoneNumbers' => PhoneNumber::get(),
                    'emails' => Email::get(),
                    'addresses' => Address::get(),
                ];
            }

            $view->with($sharedData);
        });

        View::composer('products.components.recently-watched', function ($view) {
            $recentlyViewedProducts = RecentlyViewedService::getProducts();
            $view->with('recentlyViewedProducts', $recentlyViewedProducts);
        });

        View::composer('components.hot-products', function ($view) {
            $hotProducts = Product::where('is_hit_of_sales', true)
                ->active()
                ->with('subcategory.category.productType')
                ->limit(10)
                ->get();
            $view->with('hotProducts', $hotProducts);
        });

        View::composer('components.popular-products', function ($view) {
            $popularProducts = Product::orderBy('views', 'desc')
                ->active()
                ->with('subcategory.category.productType')
                ->limit(10)
                ->get();
            $view->with('popularProducts', $popularProducts);
        });

        View::composer('components.new-products', function ($view) {
            $newProducts = Product::where('is_new', true)
                ->active()
                ->with('subcategory.category.productType')
                ->limit(10)
                ->get();
            $view->with('newProducts', $newProducts);
        });
    }
}
