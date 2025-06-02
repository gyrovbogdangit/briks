<?php

namespace App\Services;

use App\Models\Product;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function add(int $productId, int $quantity, string $unit = 'piece')
    {
        $sessionCart = session('cart', []);
        $recordIndex = static::array_first_key($sessionCart, function ($value) use ($productId, $unit) {
            return $value['product_id'] == $productId && $value['unit'] == $unit;
        });
        if (is_null($recordIndex)) {
            // Добавляем в конец, если такого товара с этим unit нет
            session()->put('cart', array_merge($sessionCart, [[
                'product_id' => $productId,
                'quantity' => $quantity,
                'unit' => $unit
            ]]));
            return true;
        } else {
            $sessionCart[$recordIndex]['quantity'] += $quantity;
            session(['cart' => $sessionCart]);
            return true;
        }
    }

    public static function update(int $productId, int $quantity, string $unit = 'piece')
    {
        $sessionCart = session('cart', []);

        $recordIndex = static::array_first_key($sessionCart, function ($value) use ($productId, $unit) {
            return $value['product_id'] == $productId;
        });

        if (!is_null($recordIndex)) {
            $sessionCart[$recordIndex]['quantity'] = $quantity;
            $sessionCart[$recordIndex]['unit'] = $unit;
            session(['cart' => $sessionCart]);
        } else {
            return false;
        }
    }

    public static function delete(int $productId, string $unit)
    {
        $sessionCart = session('cart', []);

        $recordIndex = static::array_first_key($sessionCart, function ($value) use ($productId, $unit) {
            return $value['product_id'] == $productId;
        });
        if (!is_null($recordIndex)) {
            session()->pull("cart.$recordIndex");
        }

        return true;
    }

    public static function get()
    {
        $sessionCart = session('cart');
        if (empty($sessionCart)) {
            return collect();
        }

        $products_ids = array_column($sessionCart, 'product_id');

        $products = Product::whereIn('id', $products_ids)
            ->active()
            ->with('category.productType', 'subcategory')
            ->get();

        $result = collect();
        foreach ($sessionCart as $item) {
            $product = $products->firstWhere('id', $item['product_id']);
            if ($product) {
                $clone = clone $product;
                $clone->quantity = $item['quantity'];
                $clone->unit = $item['unit'] ?? 'piece';
                $result->push($clone);
            }
        }
        return $result;
    }

    public static function getQuantity($productId)
    {
        $sessionCart = session('cart', []);
        return current(array_filter(
            $sessionCart,
            function ($el) use ($productId) {
                return $el['product_id'] == $productId;
            }
        ))['quantity'] ?? 0;
    }

    private static function array_first_key(array $array, callable $callback)
    {
        foreach ($array as $key => $value) {
            if ($callback($value)) {
                return $key;
            }
        }
        return null;
    }

    public static function getTotalQuantity()
    {
        $sessionCart = session('cart');
        if (empty($sessionCart)) {
            return 0;
        } else {
            return array_sum(array_column($sessionCart, 'quantity'));
        }
    }

    public static function changeUnit(int $productId, string $newUnit)
    {
        $sessionCart = session('cart', []);
        $recordIndex = static::array_first_key($sessionCart, function ($value) use ($productId) {
            return $value['product_id'] == $productId;
        });
        if (!is_null($recordIndex)) {
            $sessionCart[$recordIndex]['unit'] = $newUnit;
            session(['cart' => $sessionCart]);
        }
    }

    public static function getTotalSum()
    {
        $products = static::get();
        return $products->sum(function ($product) {
            if ($product->unit === 'sqm') {
                $price = $product->discount_price_sqm ?? $product->price_sqm;
            } else {
                $price = $product->discount_price_per_piece ?? $product->price_per_piece;
            }
            return $price * $product->quantity;
        });
    }
}
