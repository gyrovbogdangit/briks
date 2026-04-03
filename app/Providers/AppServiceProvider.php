<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Category;
use App\Models\City;
use App\Models\Email;
use App\Models\Page;
use App\Models\PhoneNumber;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->observers();

        Paginator::defaultView('vendor.pagination.custom');
        Model::unguard();
    }

    public function observers()
    {
        $clearCities = fn() => Cache::forget('cities_grouped');
        City::saved($clearCities);
        City::deleted($clearCities);

        $clearMenu = fn() => Cache::forget('catalog_menu_types');
        ProductType::saved($clearMenu);
        ProductType::deleted($clearMenu);
        Category::saved($clearMenu);
        Category::deleted($clearMenu);
        Subcategory::saved($clearMenu);
        Subcategory::deleted($clearMenu);

        $clearShared = fn() => Cache::forget('shared_layout_data');
        Page::saved($clearShared);
        Page::deleted($clearShared);
        PhoneNumber::saved($clearShared);
        PhoneNumber::deleted($clearShared);
        Email::saved($clearShared);
        Email::deleted($clearShared);
        Address::saved($clearShared);
        Address::deleted($clearShared);

        $clearProducts = function () {
            Cache::forget('products_hot');
            Cache::forget('products_popular');
            Cache::forget('products_new');
        };
        Product::saved($clearProducts);
        Product::deleted($clearProducts);
    }
}
