<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('attributes')
            ->whereNotNull('category_id')
            ->get()
            ->each(function ($attribute) {
                DB::table('attribute_category')->insertOrIgnore([
                    'attribute_id' => $attribute->id,
                    'category_id' => $attribute->category_id,
                ]);
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('attributes')
            ->whereNotNull('category_id')
            ->get()
            ->each(function ($attribute) {
                DB::table('attribute_category')
                    ->where('attribute_id', $attribute->id)
                    ->where('category_id', $attribute->category_id)
                    ->delete();
            });
    }
};
