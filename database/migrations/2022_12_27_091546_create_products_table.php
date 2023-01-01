<?php

use App\Models\Brand;
use App\Models\Category;
use App\Models\Type;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('sku')->nullable();
            $table->foreignIdFor(Category::class)->nullable()->constrained();
            $table->foreignIdFor(Brand::class)->nullable()->constrained();
            $table->foreignIdFor(Type::class)->nullable()->constrained();
            $table->unsignedInteger('quantity')->default(0);
            $table->boolean('in_stock')->default(false);
            $table->decimal('price')->default(0);
            $table->decimal('old_price')->nullable();
            $table->string('type_prefix')->nullable();
            $table->string('model')->nullable();
            $table->string('image')->nullable();
            $table->string('short_description')->nullable();
            $table->text('description')->nullable();
            $table->boolean('flag_new')->default(false);
            $table->boolean('flag_hit')->default(false);
            $table->decimal('length')->nullable();
            $table->decimal('width')->nullable();
            $table->decimal('height')->nullable();
            $table->decimal('weight')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
