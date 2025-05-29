<?php

namespace App\Services;

use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class PriceExportService
{
    public static function exportToExcel(): string
    {
        $products = Product::with(['category', 'subcategory'])->get()->map(function ($product) {
            return [
                'id' => $product->id,
                'category' => $product->category->name ?? '',
                'subcategory' => $product->subcategory->name ?? '',
                'name' => $product->name,
                'price_per_piece' => $product->price_per_piece,
                'discount_price_per_piece' => $product->discount_price_per_piece,
                'price_sqm' => $product->price_sqm,
                'discount_price_sqm' => $product->discount_price_sqm,
            ];
        });

        $headings = [
            ['ID', 'Категория', 'Подкатегория', 'Название', 'Цена за шт', 'Цена со скидкой за шт', 'Цена за м²', 'Цена со скидкой за м²']
        ];

        $data = $headings;
        foreach ($products as $row) {
            $data[] = array_values($row);
        }

        $date = date('Y-m-d_H:i');
        $tempPath = 'exports/prices_' . $date . '.xlsx';

        static::storeToExcel($data, $tempPath);

        return Storage::disk('local')->path($tempPath);
    }

    public static function storeToExcel(array $data, string $tempPath): void
    {
        Excel::store(new class($data) implements \Maatwebsite\Excel\Concerns\FromArray {
            protected $data;
            public function __construct(array $data)
            {
                $this->data = $data;
            }
            public function array(): array
            {
                return $this->data;
            }
        }, $tempPath, 'local');
    }
}
