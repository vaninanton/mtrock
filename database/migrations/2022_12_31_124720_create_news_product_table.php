<?php

declare(strict_types=1);

use App\Models\News;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(News::class)->constrained();
            $table->foreignIdFor(Product::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_product');
    }
};
