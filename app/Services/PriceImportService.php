<?php

namespace App\Services;

use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\UploadedFile;

class PriceImportService
{
    public static function importFromExcel(UploadedFile $file): array
    {
        $imported = [];
        $rows = Excel::toArray([], $file)[0];
        unset($rows[0]);

        foreach ($rows as $row) {
            $id = $row[0] ?? null;
            if (!$id) continue;

            $product = Product::find($id);
            if (!$product) continue;

            $changed = false;
            if (isset($row[4]) && $product->price_per_piece != $row[4]) {
                $product->price_per_piece = $row[4];
                $changed = true;
            }

            if (isset($row[5]) && $product->discount_price_per_piece != $row[5]) {
                $product->discount_price_per_piece = $row[5];
                $changed = true;
            }

            if (isset($row[6]) && $product->price_sqm != $row[6]) {
                $product->price_sqm = $row[6];
                $changed = true;
            }

            if (isset($row[7]) && $product->discount_price_sqm != $row[7]) {
                $product->discount_price_sqm = $row[7];
                $changed = true;
            }

            if ($changed) {
                $product->save();
                $imported[] = $product->id;
            }
        }
        return $imported;
    }
}
