<?php

declare(strict_types=1);

use App\Models\Delivery;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable()->unique();
            $table->foreignIdFor(Delivery::class)->nullable()->constrained();
            $table->decimal('delivery_price')->nullable();
            $table->string('pay_method')->nullable();
            $table->decimal('total_price')->nullable();
            $table->decimal('coupon_discount')->nullable();
            $table->boolean('separate_delivery')->nullable();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('apartment')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_country')->nullable();
            $table->string('email')->nullable();
            $table->string('comment', 1000)->nullable();
            $table->string('note', 1000)->nullable();
            $table->string('payment_link', 1000)->nullable();
            $table->ipAddress()->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
