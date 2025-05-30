<?php

namespace App\Helpers;

use App\Models\Category;
use App\Models\Attribute;
use App\Models\ProductType;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Collection;

class Filter
{
    public ProductType $productType;
    public Category $category;
    public Subcategory $subcategory;
    public Collection $attributes;

    public string $pageSize = '20';
    public string $sortBy = 'popular';
    public string $showProducts = 'all';
    public int $page = 1;
    public array $priceRange = [];

    private static array $availablePageSizes = [20, 60, 100];
    private static array $availableSortBy = ['popular', 'price', 'name'];
    private static array $availableShowProducts = ['all', 'new', 'hits', 'discounts'];

    public function __construct(ProductType $productType, Category $category, Subcategory $subcategory, array $requestQuery)
    {
        $this->productType = $productType;
        $this->category = $category;
        $this->subcategory = $subcategory;

        if (isset($requestQuery['page-size']) && in_array($requestQuery['page-size'], static::$availablePageSizes)) {
            $this->pageSize = $requestQuery['page-size'];
            unset($requestQuery['page-size']);
        }

        if (isset($requestQuery['show-products']) && in_array($requestQuery['show-products'], static::$availableShowProducts)) {
            $this->showProducts = $requestQuery['show-products'];
            unset($requestQuery['show-products']);
        }

        if (isset($requestQuery['sort-by']) && in_array($requestQuery['sort-by'], static::$availableSortBy)) {
            $this->sortBy = $requestQuery['sort-by'];
            unset($requestQuery['sort-by']);
        }

        if (isset($requestQuery['page']) && is_numeric($requestQuery['page']) && $requestQuery['page'] > 0) {
            $this->page = (int) $requestQuery['page'];
            unset($requestQuery['page']);
        }

        if (isset($requestQuery['min-price'], $requestQuery['max-price']) && is_numeric($requestQuery['min-price']) && is_numeric($requestQuery['max-price']) && $requestQuery['min-price'] > 0 && $requestQuery['max-price'] > 0) {
            $this->priceRange = [(int) $requestQuery['min-price'], (int) $requestQuery['max-price']];
            unset($requestQuery['min-price'], $requestQuery['max-price']);
        }

        $this->attributes = $category->attributes()
            ->whereIn('slug', array_keys($requestQuery))
            ->withWhereHas(
                'values',
                function ($query) use ($requestQuery) {
                    $query->where(function ($query) use ($requestQuery) {
                        foreach ($requestQuery as $name => $values) {
                            if (!is_array($values)) {
                                continue;
                            }

                            $query->orWhere(function ($query) use ($name, $values) {
                                $query->whereHas('attribute', function ($query) use ($name) {
                                    $query->where('slug', $name);
                                })->whereIn('slug', $values);
                            });
                        }
                    });
                }
            )->get();
        // $this->attributes = $requestQuery ? Attribute::withAttributesValuesFromQuery($requestQuery)->get() : new Collection();
    }

    public function attributeExists(string $slug): bool
    {
        return $this->attributes->contains('slug', $slug);
    }

    public function inAttributeValues(string $attributeSlug, string $valueSlug): bool
    {
        return $this->attributes->where('slug', $attributeSlug)->pluck('values')->flatten()->contains('slug', $valueSlug);
    }

    public function filtersExists(): bool
    {
        return $this->attributes->isNotEmpty();
    }

    public function queryAttributes(): array
    {
        return $this->attributes->mapWithKeys(fn($attribute) => [$attribute->slug => $attribute->values->pluck('slug')->toArray()])->toArray();
    }

    public function getQuery(): array
    {
        $query = array_merge([
            'category' => $this->category->slug,
            'page-size' => $this->pageSize,
            'show-products' => $this->showProducts,
            'page' => $this->page,
            'sort-by' => $this->sortBy,
        ], $this->queryAttributes());

        if (!empty($this->priceRange)) {
            $query['min-price'] = $this->priceRange[0];
            $query['max-price'] = $this->priceRange[1];
        }

        return $query;
    }


    public function queryWithoutAttributeValue($attributeSlug, $valueSlug): array
    {
        $query = $this->getQuery();
        if (isset($query[$attributeSlug])) {
            $query[$attributeSlug] = array_diff($query[$attributeSlug], [$valueSlug]);
            if (empty($query[$attributeSlug])) {
                unset($query[$attributeSlug]);
            }
        }
        return $query;
    }
}
