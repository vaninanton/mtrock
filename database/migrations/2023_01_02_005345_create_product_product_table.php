<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_product', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignIdFor(Product::class)->constrained('products', 'id');
            $table->foreignIdFor(Product::class, 'linked_product_id')->constrained('products', 'id');
            $table->timestamps();

            $table->unique(['type', 'product_id', 'linked_product_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_product');
    }
};
