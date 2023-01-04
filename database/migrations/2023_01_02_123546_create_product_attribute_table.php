<?php

use App\Models\Param;
use App\Models\ParamOption;
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
        Schema::create('param_product', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Product::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Param::class)->constrained()->cascadeOnDelete();
            $table->string('value')->nullable();
            $table->foreignIdFor(ParamOption::class)->constrained()->cascadeOnDelete()->nullable();

            $table->unique(['product_id', 'param_id', 'value', 'param_option_id'], 'unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('param_product');
    }
};
