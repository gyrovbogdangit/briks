<?php

use App\Models\Subcategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->float('price_per_piece')->nullable();
            $table->float('discount_price_per_piece')->nullable();
            $table->float('price_sqm')->nullable();
            $table->float('discount_price_sqm')->nullable();
            $table->json('images')->nullable();
            $table->longText('description')->nullable();
            $table->json('docs')->nullable();
            $table->json('docs_file_names')->nullable();
            $table->boolean('is_new')->default(true);
            $table->boolean('is_hit_of_sales')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('views')->default(0);
            $table->foreignIdFor(Subcategory::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
