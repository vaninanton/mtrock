<?php

declare(strict_types=1);

use App\Models\Callback;
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
        Schema::create('callback_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Callback::class);
            $table->foreignIdFor(Product::class);
            $table->decimal('price')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('callback_product');
    }
};
