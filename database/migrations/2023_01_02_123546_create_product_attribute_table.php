<?php

declare(strict_types=1);

use App\Models\Param;
use App\Models\ParamsOption;
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
        Schema::create('params_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Param::class)->constrained()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->foreignIdFor(ParamsOption::class)->nullable()->constrained()->cascadeOnDelete();

            $table->unique(['product_id', 'param_id', 'value', 'params_option_id'], 'unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('params_product');
    }
};
